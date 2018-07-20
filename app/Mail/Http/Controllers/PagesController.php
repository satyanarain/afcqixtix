<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon;
use Notifynder;
use App\Models\User;
use App\Models\Settings;
use App\Http\Controllers\Controller;
//use App\Repositories\User\UserRepositoryContract;

 use App\Repositories\Setting\SettingRepositoryContract;
error_reporting(0);
class PagesController extends Controller
{
    protected $users;


    public function __construct(
      //  UserRepositoryContract $users,
        SettingRepositoryContract $settings

    ) {
        $this->users = $users;
       
    }

  public function dashboard()
    {
        $user = User::findOrFail(Auth::id());
         return $this->showDashboard();

  }

  public function showDashboard(){
         $showdashboard = "showdashboard";
         return view('pages.dashboard', compact(
            'totalTimeSpent',
            'notification_count',
            'showdashboard'
        ));
    }

    
   
}
