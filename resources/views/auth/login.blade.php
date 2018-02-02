<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
   <title>Qixtix | AFC</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('images/favicon-16x16.png')}}">
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="{{asset('css/login.css')}}" rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
     </head>
     <body class="formBac" style="height: auto;">
         <div class="container" >
             <section>               
                 <a class="hiddenanchor" id="toregister"></a>
                 <a class="hiddenanchor" id="tologin"></a>
                 <div class="row">
                     <div class="col-sm-6 col-md-4 col-md-offset-4">
                         <div class="account-wall">
                             <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                                  alt="">
                             <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                 {!! csrf_field() !!}
                                 @if(Session::has('success'))
                                 <div class="alert alert-success">{{Session::get('success')}}</div>
                                 @elseif(Session::has('fail'))
                                 <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                 @endif
                                 <p> 
                                     <label for="username" class="uname" style="float:left">User Name</label>
                                     <input id="username" name="user_name" class="form-control" required="required" type="text" placeholder="User Name" style="height:46"/>
                                 </p>
                                 <p> 
                                     <label for="password" class="youpasswd" style="float:left"> Password</label>
                                     <input id="password" name="password" class="form-control" required="required" type="password" placeholder="Password" style="height:46"/> 
                                 </p>
                                 <p class="keeplogin"> 
                                     <input type="checkbox" name="remember" id="loginkeeping" value="loginkeeping" /> 
                                     <label for="loginkeeping" style="float:left">Keep me logged in</label>
                                 </p>
                                 <p class="login button"> 
                                     <input type="submit" value="Login" class="btn btn-lg btn-primary btn-block"/> 
                                 </p>
                                 <p>
                                     <a  href="{{ url('/password/reset') }}" >Forgot Your Password?</a>
                                 </p>
                             </form>
                         </div>
                     </div>
             </section>
         </div>
     </body>
</html>