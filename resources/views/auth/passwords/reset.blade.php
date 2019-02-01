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
    <style>
            @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,900');
            .full_height{position:relative;display:inline-block;width:100%;height:100%;}
            .login_center{transform: translate(0%, -50%);top:50%; left:0%; position: absolute;width: 810px; }

            .login_center .form-h1{ color: #FFFFFF; font-size:50px; margin: 0px 0px 10px 0px !important; }
            .login_center .account-wall{backgound:#FFF !important; box-shadow:0px 0px 50px #000; border-radius:30px; padding:30px; display: inline-block;width:468px;}

            .login_center .form-header{margin:10px 0px 30px 0px;}
            .login_center .logo{float: left; border-right:4px solid #323232; margin-right:20px; padding-right:15px;}
            .login_center .logo img{width:70px; height:auto;}
            .login_center .form-title{font-size: 43px;color: #367fa9;font-family: 'Roboto', sans-serif;font-weight: bold;text-align: left;margin-top:11px;}

            .login_center .account-wall .form-horizontal p{ margin-bottom:15px;}
            .login_center .account-wall .form-horizontal p label{ max-width: auto !important;width:86px; padding-top:7px; text-align: left;font-family: 'Roboto', sans-serif; font-size:15px; font-weight:500;}
            .login_center .account-wall .form-horizontal p input{width:290px !important; }
            .login_center .account-wall p .btn-primary{background:#323232 !important; border:0px !important; margin-left:86px; width:290px;}

            @media (max-width:992px){ 
            .login_center{transform: translate(-50%, -50%);top:50%; left:50%; position: absolute;width: 810px; }
            .login_center .form-h1{font-size:40px;}
            }

            @media (max-width:640px){.login_center .form-h1{font-size:30px;} }

            @media (max-width:470px){
                    .login_center{width: 340px; }
                    .login_center .account-wall{ padding:20px; width:340px;} 
                    .login_center .form-h1{ line-height:38px;}
                    .login_center .account-wall .form-horizontal p input{width:184px !important; }
            }
            @media (max-height:480px){
                    .full_height{height:470px;}
            }
		
	</style>
     </head>
<body class="formBac full_height">
<div class="container">
    <section>  
    <div class="login_center">
        <div class="col-xs-12 col-sm-12 col-md-12"><h1 class="form-h1">Automated Fare Collection System</h1></div>
        <div class="account-wall">
            <div class="form-header col-xs-12 col-sm-12 col-md-12">
                    <div class="logo"><img src="{{asset('images/logo.png')}}" alt=""></div>
                    <h2>Reset Password</h2>
            </div>
            <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    </section>
</div>
</body>
</html>
