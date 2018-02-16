<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use App\Models\User;
use Schema;
use Response;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreatePassword\UpdateCreatePasswordRequest;
use Request;
use Hash;
class CreatePasswordsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
 public function index() {
    return view('create_passwords.index');
    }
      public function show($id) {
        $users=  User::findorFail($id);
      return view('create_passwords.index',compact('users'));
    }
  //public function store(UpdateCreatePasswordRequest $request) {
    
    public function store(UpdateCreatePasswordRequest $request) {
        $user = User::findorFail($request->id);
        $password = Hash::make($request->password);
        $where['id'] = $request->id;
        $update = ['password' => $password];
        DB::table('users')->where($where)->update($update);
        Session::flash('flash_message', "Password created. Please login to continue:");
        return redirect('/login');
    }
    
}
