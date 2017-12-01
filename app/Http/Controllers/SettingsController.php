<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Models\User;
use App\Models\Client;
use App\Models\Service;
use App\Models\Country;
use App\Models\ClientFixedFeeMapping;
use App\Models\Role;
use App\Http\Requests;
use App\Models\Settings;
use App\Models\ReminderSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Role\RoleRepositoryContract;
use App\Http\Requests\Setting\UpdateSettingOverallRequest;

class SettingsController extends Controller
{
    protected $settings;
    protected $roles;

    public function __construct(
        SettingRepositoryContract $settings,
        RoleRepositoryContract $roles
    ) {
        $this->settings = $settings;
        $this->roles = $roles;
        $this->middleware('user.is.admin', ['only' => ['index']]);
    }
    public function index()
    {
        
        
//        print_r($this->roles->allRoles());
//        
//        exit();
        $settingmenu ="settingmenu";
        $settingmenuoverall = "settingmenuoverall";
        return view('settings.index', compact('settingmenu', 'settingmenuoverall'))
        ->withSettings($this->settings->getSetting())
        ->withPermission($this->roles->allPermissions())
        ->withRoles($this->roles->allRoles());
    }

    public function updateOverall(UpdateSettingOverallRequest $request)
    {
        $this->settings->updateOverall($request);
        Session::flash('flash_message', 'Overall settings successfully updated');
        return redirect()->back();
    }

    public function permissionsUpdate(Request $request)
    {
        $this->roles->permissionsUpdate($request);
        Session::flash('flash_message', 'Role is updated');
        return redirect()->back();
    }

    public function reminders() {
        $settingmenu ="settingmenu";
        $settingmenureminderanddeadline = "settingmenureminderanddeadline";
        $reminder_settings = ReminderSettings::first();
        return view('settings.reminders', compact('settingmenu', 'settingmenureminderanddeadline'))->withReminderSettings($reminder_settings);
    }

    public function saveReminderNotification(Request $request){
        $rules = [
            'first_notification_sent_before' => 'required',
            'second_notification_sent_before' => 'required',
            'third_notification_sent_before' => 'required'
        ];

        if(!$this->validate($request, $rules)){
            $first_notification_sent_before = $request->first_notification_sent_before;
            $second_notification_sent_before = $request->second_notification_sent_before;
            $third_notification_sent_before = $request->third_notification_sent_before;
            $settings = ReminderSettings::first();
            if(!$settings){
                $input = array();
                $input['first_notification_sent_before'] = $first_notification_sent_before;
                $input['second_notification_sent_before'] = $second_notification_sent_before;
                $input['third_notification_sent_before'] = $third_notification_sent_before;
                ReminderSettings::create($input);
            }else{
                $settings->first_notification_sent_before = $first_notification_sent_before;
                $settings->second_notification_sent_before = $second_notification_sent_before;
                $settings->third_notification_sent_before = $third_notification_sent_before;
                $settings->save();
            }

            Session()->flash('flash_message', 'Value successfully saved.');

            return redirect()->route('settings.reminders');
        }
        
    }

    public function saveDeadlineNotification(Request $request){
        $rules = [
            'deadline_notification_sent_before' => 'required'
        ];
        if(!$this->validate($request, $rules)){
            $deadline_notification_sent_before = $request->deadline_notification_sent_before;

            $settings = ReminderSettings::first();
            if(!$settings){
                $input = array();
                $input['deadline_notification_sent_before'] = $deadline_notification_sent_before;
                ReminderSettings::create($input);
            }else{
                $settings->deadline_notification_sent_before = $deadline_notification_sent_before;
                $settings->save();
            }
            Session()->flash('flash_message', 'Value successfully saved.');
            return redirect()->route('settings.reminders');
        }
    }

    public function clientFixedFee(){
        $mappings = array();
        $clients = Client::where([['company_id', session('companyId')], ['client_billing', 'Pre Approved Cost']])->select('id', 'client_name')->get();
        $countries = Country::select('id', 'country_name')->get();
        $services = Service::select('id', 'servicename')->get();
        foreach ($clients as $keycl => $valuecl) {
            foreach ($countries as $keyco => $valueco) {
                foreach ($services as $keys => $values) {
                    $mapping = ClientFixedFeeMapping::where([['service_id', $values->id], ['client_id', $valuecl->id], ['country_id', $valueco->id]])->first();
                    if(!$mapping){
                        $mappings[$valuecl->id][$valueco->id][$values->id]['id'] = null;
                        $mappings[$valuecl->id][$valueco->id][$values->id]['status'] = null;
                    }else{
                        $mappings[$valuecl->id][$valueco->id][$values->id]['id'] = $mapping->id;
                        $mappings[$valuecl->id][$valueco->id][$values->id]['status'] = $mapping->status;
                    }
                }
            }
        }

        $settingmenu ="settingmenu";
        $settingmenuclientfixedfee = "settingmenuclientfixedfee";

        return view('settings.clientfixedfee', compact('settingmenu', 'settingmenuclientfixedfee'))
            ->withClients($clients)
            ->withCountries($countries)
            ->withServices($services)
            ->withMappings($mappings);   
    }

    public function saveStatus(Request $request){
        $id = $request->id;
        if($id){
            $mapping = ClientFixedFeeMapping::findOrFail($request->id);
        }else{
            $mapping = ClientFixedFeeMapping::where([['company_id', session('companyId')], ['country_id', $request->country_id], ['client_id', $request->client_id], ['service_id', $request->service_id]])->first();
        }
        

        if(!$mapping){
            $input = array();
            $input['country_id'] = $request->country_id;
            $input['company_id'] = session('companyId');
            $input['service_id'] = $request->service_id;
            $input['client_id'] = $request->client_id;
            $input['status'] = $request->status;
            ClientFixedFeeMapping::create($input);
        }else{
            $mapping->status = $request->status;
            $mapping->save();
        }
    }
}
