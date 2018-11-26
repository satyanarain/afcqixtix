<?php

namespace App\Http\Controllers\Inventory;

use DB;
use Validator;
use App\Models\Depot;
use App\Models\DepotStock;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\DepotStock\StoreDepotStockRequest;
use App\Http\Requests\Inventory\DepotStock\UpdateDepotStockRequest;
use App\Repositories\Inventory\DepotStock\DepotStockRepositoryContract;

class DepotstockController extends Controller
{
    use checkPermission;

    protected $depotstock;

    public function __construct(DepotStockRepositoryContract $depotstock)
    {
        $this->depotstock = $depotstock;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->checkActionPermission('depotstocks','view'))
            return redirect()->route('401');

        $stocks = $this->depotstock->getAllDepotStock();

        return view('inventory.depotstock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->checkActionPermission('depotstocks','create'))
            return redirect()->route('401');
        $items_data = DB::table("inv_items_master")->select('id','name','description')->where("status", "=", '1')->get();
        $paperticket = DB::table("denominations")->select('id','description','denomination_master_id')->where("denomination_master_id", "=", '1')->get();
        $depots = Depot::orderBy('name', 'asc')->pluck('name', 'id');
        $series = CenterStock::where('series', '!=', '')->orderBy('series', 'asc')->distinct('series')->pluck('series', 'series');
        return view('inventory.depotstock.create',compact('items_data','paperticket', 'depots', 'series'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepotStockRequest $request)
    {
        //return response()->json($request->all());
        $stock = $this->depotstock->create($request);

        return redirect()->route('inventory.depotstock.index');
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
        if(!$this->checkActionPermission('depotstocks','edit'))
            return redirect()->route('401');
        $items_data = DB::table("inv_items_master")->select('id','name','description')->where("status", "=", '1')->get();
        $paperticket = DB::table("denominations")->select('id','description','denomination_master_id')->where("denomination_master_id", "=", '1')->get();
        $depots = Depot::orderBy('name', 'asc')->pluck('name', 'id');
        $stock = DepotStock::whereId($id)->first();
        $series = CenterStock::where('series', '!=', '')->orderBy('series', 'asc')->distinct('series')->pluck('series', 'series');
        return view('inventory.depotstock.edit',compact('items_data','paperticket', 'depots', 'stock', 'series'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepotStockRequest $request, $id)
    {
        //return response()->json($request->all());
        $stock = $this->depotstock->update($id, $request);

        return redirect()->route('inventory.depotstock.index');
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
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'data'=>$validator->errors()]);
        }

        $denom_id = $request->denom_id;
        $items_id = $request->items_id;

        $series = CenterStock::where([['denom_id', $denom_id], ['items_id', $items_id]])->distinct('series')->orderBy('series', 'asc')->select('series')->get();

        return response()->json(['status'=>'Ok', 'data'=>$series]);
    }

    public function getStartSequence(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'denom_id' => 'required',
            'items_id' => 'required',
            'series' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'errorCode'=>'VALIDATION', 'data'=>$validator->errors()]);
        }

        $denom_id = $request->denom_id;
        $items_id = $request->items_id;
        $series = $request->series;
        $startSequence = "";

        $stocks = CenterStock::where([['denom_id', $denom_id], ['items_id', $items_id], ['series', $series]])->orderBy('id', 'asc')->get();

        $stockCount = count($stocks);

        if($stockCount > 0)
        {
            foreach ($stocks as $key => $stock) 
            {
                $quantity = $stock->quantity;

                if($quantity > 0)
                {
                    $depotstock = DepotStock::where([['denom_id', $denom_id], ['items_id', $items_id], ['series', $series]])->orderBy('id', 'desc')->first();

                    if($depotstock)
                    {
                        $startSequence = $depotstock->end_sequence + 1;
                    }else{  
                        $startSequence = $stock->start_sequence;
                    }
                }

                if(++$key === $stockCount && $quantity < 0)
                {
                    return response()->json(['status'=>'Error', 'errorCode'=>'NO_STOCK', 'data'=>'No stock available. Please contact to admin.']);
                }
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
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'errorCode'=>'VALIDATION', 'data'=>$validator->errors()]);
        }

        $denom_id = $request->denom_id;
        $items_id = $request->items_id;
        $series = $request->series;
        $end_sequence = $request->end_sequence;

        $stock = DB::table('inv_itemsquantity_stock')->where([['denom_id', $request->denom_id], ['items_id', $request->items_id], ['series', $request->series]])->first();
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
            'items_id' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'errorCode'=>'VALIDATION', 'data'=>$validator->errors()]);
        }

        $quantity = $request->quantity;
        $items_id = $request->items_id;

        $stock = DB::table('inv_itemsquantity_stock')->where('items_id', $request->items_id)->first();

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

    public function summary()
    {
        $summary = DB::table('inv_centerstock_depotstock')
                    ->select('items_id', 'qty', 'depot_id', 'denom_id', 'series')
                    ->get();
        foreach ($summary as $key => $value) 
        {
            $value->item = DB::table('inv_items_master')
                            ->where('id', $value->items_id)
                            ->first()
                            ->name;
            $value->depot = DB::table('depots')
                            ->where('id', $value->depot_id)
                            ->first()
                            ->name;

            if($value->denom_id)
            {
                $value->denom = DB::table('denominations')
                            ->where('id', $value->denom_id)
                            ->first()
                            ->description;
            }
        }
        return view('inventory.depotstock.summary', compact('summary'));
    }
}
