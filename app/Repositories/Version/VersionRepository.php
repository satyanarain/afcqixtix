<?php

namespace App\Repositories\Version;
use App\Models\Version;
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
use App\Traits\FormatDates;
use App\Traits\activityLog;

class VersionRepository implements VersionRepositoryContract {
    use activityLog;
    use FormatDates;
    public function find($id) {
        return Version::first();
    }

    public function getAllVersions() {
        return Version::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $user_id=Auth::id();
        $input['downloading_wef']= $this->insertDate($requestData->downloading_wef);
        $input['created_by']=$user_id;
        $input['version_status'] = 'o';
        $version = Version::create($input);
        Session::flash('flash_message', "Version $depot->id Created Successfully."); //Snippet in Master.blade.php
        return $version;
    }

    public function update($id, $requestData) {
//        /$this->createLog('App\Models\Version',$id);
        $version = Version::findorFail($id);
        $input = $requestData->all();
        //$stop = $requestData->stop;
        $version_id = $requestData->version_id;

        $sql_id=Version::where([['id',$version_id],['id','!=',$id]])->first();
        $user_id=Auth::id();
        $input['created_by']=$user_id;
        $version->fill($input)->save();
        Session::flash('flash_message', "Version $version->id Updated Successfully.");
        return $depot;
    }
}
