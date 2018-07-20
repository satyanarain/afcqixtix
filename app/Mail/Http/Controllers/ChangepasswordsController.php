<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Gate;
use Carbon;
use Datatables;
use Notifynder;
use DB;
use Excel;
use Schema;
use Response;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PHPZen\LaravelRbac\Traits\Rbac;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\ChangePassword\UpdateChangePasswordRequest;
use App\Repositories\Role\RoleRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Redirec;
class ChangepasswordsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct()
    {
        $this->middleware('auth');
    }
 public function create() {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('changepasswords.create')->withUser($user);
    }

    public function store(UpdateChangePasswordRequest $request) {
        $user = Auth::user();
        $password = Auth::user()->password;

        if (!Hash::check($request->currentpassword, $password)) {
            Session::flash('fail', "Your old password does not match!.");
            return redirect()->back();
        } else {
            $request->password;
            $user->password = Hash::make($request->password);
            $user->save();
            //request()->session()->flash('success', 'Password changed!');
            Session::flash('success', "Password changed!.");
            return redirect()->back();
        }
    }

}
