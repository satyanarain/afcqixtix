<div id="b" style="position:absolute; top:50px"><i class="fa fa-bus" style="font-size:48px;color:red"></i></div>-->
<script type="text/javascript">
$(document).ready(function() {
    
    function beeLeft() {
        $("#b").animate({left: "-=300"}, 1500, "swing", beeRight);
    }
    function beeRight() {
        $("#b").animate({left: "+=300"}, 1500, "swing", beeLeft);
    }
    
    beeRight();
    
});

 $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password'=>'required'
        ]);
     $user = new User;
     $user->name=$request->get('name');
     $user->email=$request->get('email');
     $user->password=$request->get('password');
    $user->verification_token = md5(uniqid('KP'));
    $user->save();
    $activation_link = route('user.activate', ['email' => $user->email, 'verification_token' => urlencode($user->verification_token)]);
    Mail::send('users.email.welcome', ['name' => $user->name, 'activation_link' => $activation_link], function ($message) use($user,$activation_link)
       {
          $message->to($user->email, $user->name)->subject('Welcome to Expertphp.in!');    
        });
        
        
        
$g_allow_signup = ON; //allows the users to sign up for a new account
$g_enable_email_notification = ON; //enables the email messages
$g_phpMailer_method = PHPMAILER_METHOD_MAIL;
$g_smtp_host = 'mail.opiant.online';
$g_smtp_username = 'info@opiant.online'; //replace it with your gmail address
$g_smtp_password = 'Password@123'; //replace it with your gmail password
$g_webmaster_email      = 'info@opiant.online';
$g_from_email           = 'info@opiant.online';
# $g_email_receive_own	= OFF;
# $g_email_send_using_cronjob = OFF;
 'trip_cancellation_reason_category_master_id' => 'required|unique:trip_cancellation_reasons,trip_cancellation_reason_category_master_id'
 
 <div class="form-group ">
    {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-5 required">
        @php $depots=displayList('depots','name');@endphp
       <span id="denomination_masters"> {!! Form::select('depot_id', $depots,isset($crew_details->depot_id) ? $crew_details->depot_id : selected,
        ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Depot','required' => 'required']) !!}</span>
    </div>
    <div class="col-md-1 col-sm-1 text-left">
        <div class="btn btn-sm btn-default" onclick="AddNewShow('depots', 'denomination_master_id', 'Select Denomination Type')">New</div> 
    </div>
</div>

 $name = $requestData->name;
      $sql=Depot::where([['name',$name],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Name has already been taken.']);
      } else {
          
      }
       'class'=>'form-horizontal',
      
      @include('partials.form_header')
      
      
      
      <div class="form-group">
        {!! Form::label('name', Lang::get('Depot Name'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('name', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>



<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required')) }}
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div> 


<?php $this->userHistory($value->user_name,$value->created_at,$value->updated_at) ; ?>