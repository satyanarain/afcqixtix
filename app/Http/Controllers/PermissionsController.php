<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Permission;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\activityLog;
class PermissionsController extends Controller
{


    public function index() {
         $users = DB::table('permissions')->select('*','permissions.id as id')
               ->leftjoin('users','permissions.user_id','users.id')
                ->orderBy('permissions.id','desc')
               ->get();
      
          return view('permissions.index', compact('users'));
    }
    public function show() {
         $users = DB::table('permissions')->select('*','permissions.id as id')
               // ->leftjoin('users','permissions.user_id','users.id')
                ->orderBy('permissions.id','desc')
               ->get();
          return view('permissions.show', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
       
         return view('permissions.create');
    }
//
//    public function saveMenuAll(Request $request) {
//         $userid = $request->user_id;
//        $checkid = Permission::where('user_id', $userid)->first();
//        $checkid->user_id;
//        $checkid->id;
//        if ($checkid->id != '') {
//            $permission = Permission::find($checkid->id);
//            $permission->users = implode(',', $request->users);
//            $permission->changepasswords = implode(',', $request->changepasswords);
//            $permission->permissions = implode(',', $request->permissions);
//            $permission->depots = implode(',', $request->depots);
//            $permission->bus_types = implode(',', $request->bus_types);
//            $permission->services = implode(',', $request->services);
//            $permission->vehicles = implode(',', $request->vehicles);
//            $permission->shifts = implode(',', $request->shifts);
//            $permission->stops = implode(',', $request->stops);
//            $permission->routes = implode(',', $request->routes);
//            $permission->duties = implode(',', $request->duties);
//            $permission->targets = implode(',', $request->targets);
//            $permission->fares = implode(',', $request->fares);
//            $permission->concession_fare_slabs = implode(',', $request->concession_fare_slabs);
//            $permission->concessions = implode(',', $request->concessions);
//            $permission->trip_cancellation_reasons = implode(',', $request->trip_cancellation_reasons);
//            $permission->inspector_remarks = implode(',', $request->inspector_remarks);
//            $permission->payout_reasons = implode(',', $request->payout_reasons);
//            $permission->denominations = implode(',', $request->denominations);
//            $permission->pass_types = implode(',', $request->pass_types);
//            $permission->crew_details = implode(',', $request->crew_details);
//            $permission->ETM_details = implode(',', $request->ETM_details);
//            
//            $permission->save();
//            echo "Menu Updated Successfully!";
//            exit();
//        } else {
//            $input = $request->all();
//            $input['users'] = implode(',', $request->users);
//             $input['changepasswords'] = implode(',', $request->changepasswords);
//            $input['permissions'] = implode(',', $request->permissions);
//            $input['depots'] = implode(',', $request->depots);;
//            $input['bus_types'] = implode(',', $request->bus_types);
//            $input['services'] = implode(',', $request->services);
//            $input['vehicles'] = implode(',', $request->vehicles);
//            $input['shifts'] = implode(',', $request->shifts);
//            $input['stops'] = implode(',', $request->stops);
//            $input['routes'] = implode(',', $request->routes);
//            $input['duties'] = implode(',', $request->duties);
//            $input['targets'] = implode(',', $request->targets);
//            $input['fares'] = implode(',', $request->fares);
//            $input['concession_fare_slabs'] = implode(',', $request->concession_fare_slabs);
//            $input['concessions'] = implode(',', $request->concessions);
//            $input['trip_cancellation_reasons'] = implode(',', $request->trip_cancellation_reasons);
//            $input['inspector_remarks'] = implode(',', $request->inspector_remarks);
//            $input['payout_reasons'] = implode(',', $request->payout_reasons);
//            $input['denominations'] = implode(',', $request->denominations);
//            $input['pass_types'] = implode(',', $request->pass_types);
//            $input['crew_details'] = implode(',', $request->crew_details);
//            $permission->ETM_details = implode(',', $request->ETM_details);
//            
//            Permission::create($input);
//            echo "Menu Created Successfully!";
//            exit();
//        }
//    }

    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
    {
       
            $input= $request->all();
            $user_id=  Auth::id();
            $input['user_id'] = $user_id;
            $input['users'] = implode(',', $request->users);
            $input['changepasswords'] = implode(',', $request->changepasswords);
            $input['permissions'] = implode(',', $request->permissions);
            $input['depots'] = implode(',', $request->depots);
            $input['bus_types'] = implode(',', $request->bus_types);
            $input['services'] = implode(',', $request->services);
            $input['vehicles'] = implode(',', $request->vehicles);
            $input['shifts'] = implode(',', $request->shifts);
            $input['stops'] = implode(',', $request->stops);
            $input['routes'] = implode(',', $request->routes);
            $input['duties'] = implode(',', $request->duties);
            $input['targets'] = implode(',', $request->targets);
            $input['trips'] = implode(',', $request->trips);
            $input['fares'] = implode(',', $request->fares);
            $input['concession_fare_slabs'] = implode(',', $request->concession_fare_slabs);
            $input['concessions'] = implode(',', $request->concessions);
            $input['trip_cancellation_reasons'] = implode(',', $request->trip_cancellation_reasons);
            $input['inspector_remarks'] = implode(',', $request->inspector_remarks);
            $input['payout_reasons'] = implode(',', $request->payout_reasons);
            $input['denominations'] = implode(',', $request->denominations);
            $input['pass_types'] = implode(',', $request->pass_types);
            $input['crew'] = implode(',', $request->crew);
            $input['ETM_details'] = implode(',', $request->ETM_details);
           $roles= Permission::create($input);
           Session::flash('flash_message', "Role Created Successfully."); //Snippet in Master.blade.php
         return redirect()->route('permissions.index');
      }       
  
     public function update($id, Request $request)
    {
    $role=$request->role;
    $sql=Permission::where([['role',$role],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Role has already been taken.']);
      } else { 
            $permission = Permission::findorFail($id);
            $user_id=  Auth::id();
            $input = $request->all();
            $input['user_id'] = $user_id;
            $input['users'] = implode(',', $request->users);
            $input['changepasswords'] = implode(',', $request->changepasswords);
            $input['permissions'] = implode(',', $request->permissions);
            $input['depots'] = implode(',', $request->depots);
            $input['bus_types'] = implode(',', $request->bus_types);
            $input['services'] = implode(',', $request->services);
            $input['vehicles'] = implode(',', $request->vehicles);
            $input['shifts'] = implode(',', $request->shifts);
            $input['stops'] = implode(',', $request->stops);
            $input['routes'] = implode(',', $request->routes);
            $input['duties'] = implode(',', $request->duties);
            $input['targets'] = implode(',', $request->targets);
            $input['trips'] = implode(',', $request->trips);
            $input['fares'] = implode(',', $request->fares);
            $input['concession_fare_slabs'] = implode(',', $request->concession_fare_slabs);
            $input['concessions'] = implode(',', $request->concessions);
            $input['trip_cancellation_reasons'] = implode(',', $request->trip_cancellation_reasons);
            $input['inspector_remarks'] = implode(',', $request->inspector_remarks);
            $input['payout_reasons'] = implode(',', $request->payout_reasons);
            $input['denominations'] = implode(',', $request->denominations);
            $input['pass_types'] = implode(',', $request->pass_types);
            $input['crew'] = implode(',', $request->crew);
            $input['ETM_details'] = implode(',', $request->ETM_details);
            $permission->fill($input)->save();
           Session::flash('flash_message', "Role Updated Successfully."); 
        return redirect()->route('permissions.index');
    }
    }
     public function edit($id)
    {
     
         $permissions = DB::table('permissions')->select('*','permissions.id as id')
               ->leftjoin('users','permissions.user_id','users.id')
               ->where('permissions.id',$id)
               ->orderBy('permissions.id','desc')->first();
           return view('permissions.edit')->withPermissions($permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission) {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully!');
    }

}