<?php

namespace App\Http\Controllers\Inventory;

use DB;
use Validator;
use App\Models\Crew;
use App\Models\Depot;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Models\Inventory\CenterStock;
use App\Models\Inventory\ReturnCrewStock;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Inventory\ReturnCrewStock\StoreReturnCrewStockRequest;
use App\Http\Requests\Inventory\ReturnCrewStock\UpdateReturnCrewStockRequest;
use App\Repositories\Inventory\ReturnCrewStock\ReturnCrewStockRepositoryContract;

class ReturnCrewStockController extends ApiController
{
    use checkPermission;

    protected $crewstock;

    public function __construct(ReturnCrewStockRepositoryContract $crewstock)
    {
        $this->crewstock = $crewstock;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->checkActionPermission('crewstocks','view'))
            return redirect()->route('401');

        $stocks = $this->crewstock->getAllReturnCrewStock();

        return view('inventory.returncrewstock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->checkActionPermission('crewstocks','create'))
            return redirect()->route('401');
        $items_data = DB::table("inv_items_master")->select('id','name','description')->where("status", "=", '1')->get();
        $paperticket = DB::table("denominations")->select('id','description','denomination_master_id')->where("denomination_master_id", "=", '1')->get();
        $depots = Depot::orderBy('name', 'asc')->pluck('name', 'id');
        $crews = Crew::orderBy('crew_name', 'asc')->pluck('crew_name', 'id');
        $series = CenterStock::where('series', '!=', '')->orderBy('series', 'asc')->distinct('series')->pluck('series', 'series');
        return view('inventory.returncrewstock.create',compact('items_data','paperticket', 'depots', 'series', 'crews'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnCrewStockRequest $request)
    {
        $stock = $this->crewstock->create($request);

        return redirect()->route('inventory.returncrewstock.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->checkActionPermission('crewstocks','edit'))
            return redirect()->route('401');
        $items_data = DB::table("inv_items_master")->select('id','name','description')->where("status", "=", '1')->get();
        $paperticket = DB::table("denominations")->select('id','description','denomination_master_id')->where("denomination_master_id", "=", '1')->get();
        $depots = Depot::orderBy('name', 'asc')->pluck('name', 'id');
        $stock = ReturnCrewStock::whereId($id)->first();
        $series = CenterStock::where('series', '!=', '')->orderBy('series', 'asc')->distinct('series')->pluck('series', 'series');
        return view('inventory.crewstock.edit',compact('items_data','paperticket', 'depots', 'stock', 'series'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnCrewStockRequest $request, $id)
    {
        //return response()->json($request->all());
        $stock = $this->crewstock->update($id, $request);

        return redirect()->route('inventory.crewstock.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSeries(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'denom_id' => 'required',
            'items_id' => 'required',
            'depot_id' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'data'=>$validator->errors()]);
        }

        $denom_id = $request->denom_id;
        $items_id = $request->items_id;
        $depot_id = $request->depot_id;

        $series = DB::table('inv_centerstock_depotstock')->where([['depot_id', $depot_id], ['denom_id', $denom_id], ['items_id', $items_id]])->distinct('series')->orderBy('series', 'asc')->select('series')->get();

        return response()->json(['status'=>'Ok', 'data'=>$series]);
    }

    public function getStartSequence(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'denom_id' => 'required',
            'items_id' => 'required',
            'series' => 'required',
            'depot_id' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'errorCode'=>'VALIDATION', 'data'=>$validator->errors()]);
        }

        $denom_id = $request->denom_id;
        $items_id = $request->items_id;
        $series = $request->series;
        $depot_id = $request->depot_id;
        $startSequence = "";

        $stock = DB::table('inv_centerstock_depotstock')->where([['depot_id', $depot_id], ['denom_id', $denom_id], ['items_id', $items_id], ['series', $series]])->first();

        if($stock)
        {
            $quantity = $stock->qty;

            if($quantity > 0)
            {
                $CrewStock = ReturnCrewStock::where([['depot_id', $depot_id], ['denom_id', $denom_id], ['items_id', $items_id], ['series', $series]])->orderBy('id', 'desc')->first();

                if($CrewStock)
                {
                    $startSequence = $CrewStock->end_sequence + 1;
                }else{  
                    $startSequence = $stock->start_sequence;
                }
            }else{
                return response()->json(['status'=>'Error', 'errorCode'=>'NO_STOCK', 'data'=>'No stock available. Please contact to admin.']);
            }
        }else {
            return response()->json(['status'=>'Error', 'errorCode'=>'NO_STOCK', 'data'=>'No stock available. Please contact to admin.']);
        }

        return response()->json(['status'=>'Ok', 'data'=>['start_sequence'=>$startSequence]]);
    }


    public function validateEndSequence(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'denom_id' => 'required',
            'items_id' => 'required',
            'series' => 'required',
            'end_sequence' => 'required',
            'depot_id' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'errorCode'=>'VALIDATION', 'data'=>$validator->errors()]);
        }

        $denom_id = $request->denom_id;
        $items_id = $request->items_id;
        $series = $request->series;
        $end_sequence = $request->end_sequence;
        $depot_id = $request->depot_id;

        $stock = DB::table('inv_centerstock_depotstock')->where([['depot_id', $depot_id], ['denom_id', $request->denom_id], ['items_id', $request->items_id], ['series', $request->series]])->first();
        //return response()->json($stock);
        if($stock)
        {
            if($end_sequence <= $stock->end_sequence)
            {
                return response()->json(['status'=>'Ok', 'data'=>'Sequence is available!']);
            }else{
                return response()->json(['status'=>'Error', 'errorCode'=>'NO_SERIES', 'data'=>'End sequence is beyond the stock end sequence. Please contact to admin.']);
            }
        }else{
            return response()->json(['status'=>'Error', 'errorCode'=>'NO_STOCK', 'data'=>'No stock available. Please contact to admin.']);
        }
    }

    public function validateQuantity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required',
            'items_id' => 'required',
            'depot_id' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'errorCode'=>'VALIDATION', 'data'=>$validator->errors()]);
        }

        $quantity = $request->quantity;
        $items_id = $request->items_id;
        $depot_id = $request->depot_id;

        $stock = DB::table('inv_centerstock_depotstock')->where([['items_id', $items_id], ['depot_id', $depot_id]])->first();

        if($stock)
        {
            if($quantity <= $stock->qty)
            {
                return response()->json(['status'=>'Ok', 'data'=>'Quantity is available!']);
            }else{
                return response()->json(['status'=>'Error', 'errorCode'=>'NO_STOCK', 'data'=>'Stock is below the required quantity. Please contact to admin.']);
            }
        }else{
            return response()->json(['status'=>'Error', 'errorCode'=>'NO_STOCK', 'data'=>'No stock available. Please contact to admin.']);
        }
    }


    public function getRemainingStock($crewId)
    {
        $remainings = DB::table('inv_crew_total_stock')
                          ->join('inv_items_master', 'inv_items_master.id', '=', 'inv_crew_total_stock.items_id')
                          ->select('inv_crew_total_stock.qty', 'inv_crew_total_stock.series', 'inv_crew_total_stock.start_sequence', 'inv_crew_total_stock.end_sequence', 'inv_items_master.description')
                          ->where('inv_crew_total_stock.crew_id', $crewId)
                          ->orderBy('inv_crew_total_stock.items_id')
                          ->get();

        if(!count($remainings))
        {
            return $this->errorResponse('Crew not found.', 404);
        }else{
            return $this->showAll($remainings);
        }
    }
}
