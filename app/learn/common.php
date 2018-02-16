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