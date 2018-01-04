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
    
      /* 
      Logic for showing the intermediate screen
      if user is having access in more than one countries then show the intermediate screen other wise show the dash board directly
      */

      $user = User::findOrFail(Auth::id());

      $group_company_ids = $user->group_company_id;

      $group_company_ids = explode(',', $group_company_ids);

      if(count($group_company_ids)> 1){
          //echo "More than one";dfdfdfdfhhh
          return $this->showCompanySelectPage();
      }else{
          $user = User::findOrFail(Auth::id());
          session(['companyId' => $user->group_company_id]);
          return $this->showDashboard();
      }  
  }

  public function showDashboard(){
         $showdashboard = "showdashboard";
         return view('pages.dashboard', compact(
            'totalTimeSpent',
            'notification_count',
            'showdashboard'
        ));
    }

    public function showCompanySelectPage(){
       $user = User::findOrFail(Auth::id());
        //echo json_encode($user);exit();
        $companies = $user->group_company_id;
        //echo json_encode($compnaies);exit();
        $companies = explode(',', $companies);
        return view('pages.select_company')
                  ->withGroupCompanies(GroupCompany::whereIn('id', $companies)->pluck('name', 'id'));
    }
}
