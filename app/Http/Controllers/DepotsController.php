<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Depot;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Depot\UpdateDepotRequest;
use App\Http\Requests\Depot\StoreDepotRequest;
use App\Repositories\Depot\DepotRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\activityLog;
use App\Traits\checkPermission;
//use Illuminate\Support\Facades\Validator;
class DepotsController extends Controller
{
    use activityLog;
    use checkPermission;
    protected $depots;
    public function __construct(
        DepotRepositoryContract $depots
    ) {
        $this->depots = $depots;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!$this->checkActionPermission('depots','view'))
            return redirect()->route('401');
      $depot = DB::table('depots')->select('*','depots.id as id','depots.name as name','services.name as service_name','depots.created_at as created_at','depots.updated_at as updated_at')
      ->leftjoin('users','users.id','depots.user_id')
      ->leftjoin('services','depots.service_id','services.id')
      ->orderBy('depots.id','desc')->get();
      return view('depots.index')->withDepots($depot);
   
    }
    public function create()
    {
        if(!$this->checkActionPermission('depots','create'))
            return redirect()->route('401');
     //$depot = Depot::findOrFail();
     return view('depots.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Depot $depot
     * @return Response
     */
    public function store(StoreDepotRequest $depotRequest)
    {
        if(!$this->checkActionPermission('depots','create'))
            return redirect()->route('401');
        $version_id = $this->getCurrentVersion();
        $depotRequest->request->add(['flag'=> 'a','version_id'=>$version_id]);
        $getInsertedId = $this->depots->create($depotRequest);
        return redirect()->route('depots.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
       if(!$this->checkActionPermission('depots','view'))
            return redirect()->route('401');
      $depot = DB::table('depots')->select('*','depots.id as id','depots.name as name','services.name as service_name','depots.created_at as created_at','depots.updated_at as updated_at')
      ->leftjoin('users','users.id','depots.user_id')
      ->leftjoin('services','depots.service_id','services.id')
       ->where('depots.id',$id)       
      ->orderBy('depots.id','desc')->first();
    return view('depots.show')->withDepot($depot);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(!$this->checkActionPermission('depots','edit'))
            return redirect()->route('401');
     $depot = DB::table('depots')->select('*','depots.name as name','services.name as service_name','depots.created_at as created_at','depots.updated_at as updated_at','depots.id as id')
      ->leftjoin('users','users.id','depots.user_id')
      ->leftjoin('services','depots.service_id','services.id')
       ->where('depots.id',$id)       
      ->orderBy('depots.id','desc')->first();
      return view('depots.edit')->withDepot($depot);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateDepotRequest $request)
    {
        if(!$this->checkActionPermission('depots','edit'))
            return redirect()->route('401');
      $name = $request->name;
      $depot_id = $request->depot_id;
      $sql=Depot::where([['name',$name],['id','!=',$id]])->first();
      $depot_id=Depot::where([['depot_id',$depot_id],['id','!=',$id]])->first();
       if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Depot name has already been taken.']);
      } else if($depot_id>0){
       return redirect()->back()->withErrors(['Depot ID has already been taken.']);
     } else {
     
        $request->request->add(['flag'=> 'u']);
         $this->depots->update($id, $request);
        return redirect()->route('depots.index');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
 }
