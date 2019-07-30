<?php

namespace App\Repositories\Roaster;
use App\Models\Roaster;
use App\Models\RoasterOnDuty;
use App\Models\RoasterOffDuty;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RoasterCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;
class RoasterRepository implements RoasterRepositoryContract {
      use FormatDates;
      use activityLog;
  public function find($id) {
        return Roaster::join('waybills', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllRoasters() {
        return Roaster::all();
    }

    public function create($requestData) {
       //echo '<pre>';print_r($requestData->all());die;
       foreach($requestData->roaster as $key1=>$row)
       {
            $input = array();
            $input['depot_id'] = $requestData->depot_id;
            $input['dated_on'] = date('Y-m-d',$key1);
            foreach($row['on-duty'] as $key2=>$crews){
                $input['shift_id'] = $key2;
                //$input['crews_on_duty'] = implode(',',$crews);
                //$input['crews_off_duty'] = implode(',',$row['off-duty']);
                $input['created_by'] = Auth::id();
                $input['created_at'] = date('Y-m-d H:i:s');
                $input['updated_at'] = date('Y-m-d H:i:s');
               // echo '<pre>';print_r($input);
                $roaster = Roaster::create($input);
                foreach($crews as $crew){
                    RoasterOnDuty::create(array('roaster_id'=>$roaster->id,'crew_id'=>$crew));
                }

            }
            foreach($row['off-duty'] as $crew){
                $input = array();
                $input['depot_id'] = $requestData->depot_id;
                $input['dated_on'] = date('Y-m-d',$key1);
                $input['created_by'] = Auth::id();
                $input['created_at'] = date('Y-m-d H:i:s');
                $input['updated_at'] = date('Y-m-d H:i:s');
                $input['crew_id'] = $crew;
                RoasterOffDuty::create($input);
            }

            //echo '<pre>';print_r($input);

       }
       Session::flash('flash_message', "Roster Created Successfully.");
       return $crew_detail;
    }

    public function update($id, $requestData) {
       //$this->createLog('App\Models\Roaster','App\Models\RoasterLog',$id);
       $crew_detail = RoasterOnDuty::where('roaster_id',$id)->delete();
       foreach($requestData['roaster'] as $crew){
            RoasterOnDuty::create(array('roaster_id'=>$id,'crew_id'=>$crew));
        }
       Session::flash('flash_message', "Roster Updated Successfully.");
       return $crew_detail;
    }


}
