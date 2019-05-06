<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Notification;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\UpdateNotificationRequest;
use App\Http\Requests\Notification\StoreNotificationRequest;
use App\Repositories\Notification\NotificationRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\activityLog;
use App\Traits\checkPermission;
//use Illuminate\Support\Facades\Validator;
class NotificationsController extends Controller
{
    use activityLog;
    use checkPermission;
    protected $notifications;
    public function __construct(
        NotificationRepositoryContract $notifications
    ) {
        $this->notifications = $notifications;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!$this->checkActionPermission('notifications','view'))
            return redirect()->route('401');
        $notifications = DB::table('notifications')->select('*','notifications.id as id','notifications.email as email','notifications.name as name')
                ->leftjoin('users','users.id','notifications.user_id')
                ->leftjoin('notifications_type_master','notifications_type_master.id','notifications.notification_type')
                ->orderBy('notifications.id','desc')
                ->get();
        //echo '<pre>';print_r($notifications);die;
        return view('notifications.index')->withNotifications($notifications);
   
    }
    public function create()
    {
        if(!$this->checkActionPermission('notifications','create'))
            return redirect()->route('401');
        //$depot = Notification::findOrFail();
        return view('notifications.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Notification $depot
     * @return Response
     */
    public function store(StoreNotificationRequest $notificationRequest)
    {
        if(!$this->checkActionPermission('notifications','create'))
            return redirect()->route('401');
        $getInsertedId = $this->notifications->create($notificationRequest);
        return redirect()->route('notifications.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if(!$this->checkActionPermission('notifications','view'))
             return redirect()->route('401');
       $depot = DB::table('notifications')->select('*','notifications.id as id','notifications.email as email','notifications.name as name')
       ->leftjoin('users','users.id','notifications.user_id')
       ->leftjoin('notifications_type_master','notifications_type_master.id','notifications.notification_type')
        ->where('notifications.id',$id)       
       ->orderBy('notifications.id','desc')->first();
     return view('notifications.show')->withNotification($depot);
      }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(!$this->checkActionPermission('notifications','edit'))
            return redirect()->route('401');
        $notification = DB::table('notifications')->select('*','notifications.id as id','notifications.email as email','notifications.name as name')
            ->leftjoin('users','users.id','notifications.user_id')
            ->leftjoin('notifications_type_master','notifications_type_master.id','notifications.notification_type')
            ->where('notifications.id',$id)       
            ->orderBy('notifications.id','desc')->first();
        //echo '<pre>';print_r($depot);die;
        return view('notifications.edit')->withNotification($notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateNotificationRequest $request)
    {
        if(!$this->checkActionPermission('notifications','edit'))
            return redirect()->route('401');
        //$name = $request->name;
        //$notification_id = $id;
        //echo '<pre>';print_r($request->all());die;
        $this->notifications->update($id, $request);
        return redirect()->route('notifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    
    public function getAllUsersEmail(Request $request){
        $keyword = $request->keyword;
        //DB::enableQueryLog();
        $emails = DB::table('users')->select('email')
                ->orderBy('email','asc')
                ->where('email','like','%'.$keyword.'%')       
                ->get();
        //dd(DB::getQueryLog());
        $html = '';
        if($emails)
        {   
            $html.='<ul id="country-list">';
            foreach($emails as $email){
                $html.='<li onClick="selectEmail(\''.$email->email.'\')">'.$email->email.'</li>';
            }
            $html.='</ul>';
        }
        echo $html;
    }
 }
