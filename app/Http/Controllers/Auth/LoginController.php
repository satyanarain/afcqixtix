<?php
namespace App\Http\Controllers\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Chatter;
use Illuminate\Http\Respons;
//use \Carbon\Carbon; 
use Auth;
use DB;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
     public function login(Request $request)
    {
    $this->validate($request, ['email' => 'required|email', 'password' => 'required']);
    $email=$request['email'];
    echo "<pre>";
 
   $test= Auth::attempt(['email' => $request['email'], 'password' => $request['password']]);
   
      if(!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
        return redirect()->back()->with('fail', 'Either username or password is incorrect!');
        }else
        { 

         $sql = DB::table('users')->select('*')->where('email','=',$email)->first();
          $id=$sql->id;
         $name=$sql->name;
         $seen = date('Y:m:d H:i:s');
         DB::update("update users set logged_user = 1 where email = ?", [$email]);
//
//        $sql = DB::table('chatters')->select('*')->where('user_id','=',$id)->first();
//
//       if(count($sql)==0)
//       {
//         $chatter= Chatter::create(['user_id'=>$id,'name'=>$name,'seen'=>$seen]);
//         $chatter->save();
//       }
          return redirect('/dashboard');
         }

   }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
