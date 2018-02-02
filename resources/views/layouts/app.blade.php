<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" ng-app="AFC">
         <head>
        @if(Session::has('download.in.the.next.request'))
        <meta http-equiv="refresh" content="5;url={{ Session::get('download.in.the.next.request') }}">
        @endif
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
         <title>Qixtix | AFC</title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('images/favicon-16x16.png')}}">
        <script src="{{ asset(elixir('js/jquery-2.2.3.min.js')) }}"></script>
        <link rel="stylesheet" href="{{ asset(elixir('css/bootstrap.min.css')) }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset(elixir('css/skins/_all-skins.min.css')) }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset(elixir('plugins/iCheck/flat/blue.css')) }}">
        <!-- Morris chart -->
        <link rel="stylesheet" href="{{ asset(elixir('plugins/morris/morris.css')) }}">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{{ asset(elixir('plugins/jvectormap/jquery-jvectormap-1.2.2.css')) }}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{ asset(elixir('plugins/datepicker/datepicker3.css')) }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset(elixir('plugins/daterangepicker/daterangepicker.css')) }}">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{ asset(elixir('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')) }}">
        <script src="{{ URL::asset('plugins/chartjs/Chart.min.js') }}"></script>

        <link rel="stylesheet" href="{{URL::asset('plugins/datatables/dataTables.bootstrap.css')}}">
         <link rel="stylesheet" href="{{URL::asset('css/AdminLTE.min.css')}}">
      <link rel="stylesheet" href="{{URL::asset('css/custom.css')}}">
      <script src="{{ asset('js/custom.js') }}"></script>
    <script>    
     
 window.Laravel = <?php echo json_encode([

            'csrfToken' => csrf_token(),
            ]); 
?>
</script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
     <div id="map1">
     <div id="map">
     <div class="loading_bar">
	<div></div>
	<div></div>
	<div></div>
	<div></div>
	<div></div>
	<div></div>
	<div></div>
	<div></div>
     </div>
    
 </div>
 </div>

  
<div class="wrapper">
    <header class="main-header">   
             
            <!-- Logo -->
            <a href="index2.html" class="logo">
             
                <span class="logo-lg"><b>Qixtix(AFC)</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo \URL::to('') . '/img/user3-128x128.jpg' ?>" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo \URL::to('') . '/img/user4-128x128.jpg' ?>" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                                page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-red"></i> 5 new members joined
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-red"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                      @if(Auth::user()->image_path)

                      {{Html::image('/images/photo/'.Auth::user()->image_path,'',array('class'=>"user-image"))}}
                       @else
                           <img src="<?php echo \URL::to('') . '/img/user2-160x160.jpg'?>" class="user-image">
                      @endif
                         <span class="hidden-xs">{{{ isset(Auth::user()->salutation) ? Auth::user()->salutation : '' }}} {{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}}!</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                  {{  dispalyImage('/images/photo/',Auth::user()->image_path,'img-circle',$alt='')}}
                                    
                                    <p>
                                       {{{ isset(Auth::user()->salutation) ? Auth::user()->salutation : '' }}} {{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}}!
                                        <small>Member since {{ date('F jS, Y', strtotime(Auth::user()->created_at))}}</small>
                                    </p>
                                </li>

                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ url('/users/'.Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                       <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"><span class="glyphicon glyphicon-log-out"></span> Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
   <aside class="main-sidebar">
     <section class="sidebar">
           <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active treeview">
                       <a href="{{route('dashboard')}}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    
                    @php $pem=menuDisplayByUser($result, 'users','view'); @endphp
                    @if($pem=='true')
                  <li @if($segments_var[0]=='users') class="treeview active" @else class="treeview" @endif>
                        <a href="#">
                            <i class="fa fa-user"></i> <span>Profiles</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul @if($segments_var[0]=='users' || $segments_var[0]=='changepasswords') class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
                            <li @if($segments_var[0]=='users') class="active" @endif><a href="{{route('users.index')}}">
                                    <i class="fa fa-users"></i> @lang('menu.users.user') 
                                </a></li>
                            <li @if($segments_var[0]=='changepasswords') class="active" @endif><a href="{{route('changepasswords.create')}}">
                                    <i class="fa fa-key"></i> @lang('menu.users.changepassword') 
                                </a></li>   
                         </ul>
                    </li>
                    @endif
                    
                  <li @if($segments_var[0]=='depots') class="treeview active" @else class="treeview" @endif>
                        <a href="#">
                            <i class="fa fa-bus"></i> <span>Manage Masters</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        @php
$array= array('depots','bus_types','services','vehicles','shifts','stops','routes','duties','targets','trips','fares','concession_fare_slabs'
,'concessions','trip_cancellation_reasons','inspector_remarks','payout_reasons','denominations','pass_types','crew_details','')
                       @endphp
                        <ul @if(in_array($segments_var[0],$array)) class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
                            <li @if($segments_var[0]=='depots') class="active" @endif><a href="{{route('depots.index')}}">
                                    <i class="fa fa-bus"></i> @lang('menu.depots.title') 
                             </a>
                           </li>
                            <li @if($segments_var[0]=='bus_types') class="active" @endif><a href="{{route('bus_types.index')}}">
                                    <i class="fa fa-bus"></i> @lang('menu.bus_types.title') 
                            </a>
                           </li>
                            <li @if($segments_var[0]=='services') class="active" @endif><a href="{{route('services.index')}}">
                                    <i class="fa fa-briefcase"></i> @lang('menu.services.title') 
                            </a>
                            </li>
                            <li @if($segments_var[0]=='vehicles') class="active" @endif><a href="{{route('vehicles.index')}}">
                                    <i class="fa fa-bus"></i> @lang('menu.vehicles.title') 
                            </a>
                            </li>
                            <li @if($segments_var[0]=='shifts') class="active" @endif><a href="{{route('shifts.index')}}">
                                    <i class="fa fa-calendar"></i> @lang('menu.shifts.title') 
                            </a>
                            <li @if($segments_var[0]=='stops') class="active" @endif><a href="{{route('stops.index')}}">
                                    <i class="fa fa-bus"></i> @lang('menu.stops.title') 
                            </a>
                            <li @if($segments_var[0]=='routes') class="active" @endif><a href="{{route('routes.index')}}">
                                    <i class="fa fa-map-marker"></i> @lang('menu.routes.title') 
                            </a>
                             </li>
                            <li @if($segments_var[0]=='duties') class="active" @endif><a href="{{route('duties.index')}}">
                                    <i class="fa fa-file"></i> @lang('menu.duties.title') 
                            </a>
                            </li>
                            
                            <li @if($segments_var[0]=='targets') class="active" @endif><a href="{{route('targets.index')}}">
                                    <i class="fa fa-bullseye"></i> @lang('menu.targets.title') 
                            </a>
                                 
                            <li @if($segments_var[0]=='fares') class="active" @endif><a href="{{route('fares.index')}}">
                                    <i class="fa fa-inr"></i> @lang('menu.fares.title') </a>
                           </li>
                           <li @if($segments_var[0]=='concession_fare_slabs') class="active" @endif><a href="{{route('concession_fare_slabs.index')}}">
                                    <i class="fa fa-inr"></i> @lang('menu.concession_fare_slabs.title') </a>
                           </li>
                           <li @if($segments_var[0]=='concessions') class="active" @endif><a href="{{route('concessions.index')}}">
                                    <i class="fa fa-inr"></i> @lang('menu.concessions.title') </a>
                           </li>
                           <li @if($segments_var[0]=='trip_cancellation_reasons') class="active" @endif><a href="{{route('trip_cancellation_reasons.index')}}">
                                    <i class="fa fa-inr"></i> @lang('menu.trip_cancellation_reason.title') </a>
                           </li>
                           <li @if($segments_var[0]=='inspector_remarks') class="active" @endif><a href="{{route('inspector_remarks.index')}}">
                                    <i class="fa fa-user"></i> @lang('menu.inspector_remarks.title') </a>
                           </li>
                           
                           <li @if($segments_var[0]=='fa fa-money') class="active" @endif><a href="{{route('payout_reasons.index')}}">
                                    <i class="fa fa-cc-mastercard"></i> @lang('menu.payout_reasons.title') </a>
                           </li>
                           <li @if($segments_var[0]=='denominations') class="active" @endif><a href="{{route('denominations.index')}}">
                                    <i class="fa fa-plus"></i> @lang('menu.denominations.title') </a>
                           </li>
                           <li @if($segments_var[0]=='pass_types') class="active" @endif><a href="{{route('pass_types.index')}}">
                                    <i class="fa fa-lock"></i> @lang('menu.pass_types.title') </a>
                           </li>
                           <li @if($segments_var[0]=='crew_details') class="active" @endif><a href="{{route('crew_details.index')}}">
                                    <i class="fa fa-eye"></i> @lang('menu.crew_details.title') </a>
                           </li>
                             
                         </ul>
                    </li>
               @php $pem=menuDisplayByUser($result, 'permissions','view'); @endphp
                    @if($pem=='true')
                     <li  @if($segments_var[0]=='roles' || $segments_var[0]=='permissions' || $segments_var[0]=='settings') class="treeview active" @else class="treeview" @endif>
                        <a href="#">
                            <i class="fa fa-cog" aria-hidden="true"></i> <span>@lang('menu.settings.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul @if($segments_var[0]=='roles' || $segments_var[0]=='permissions' || $segments_var[0]=='settings') class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
                         <li @if($segments_var[0]=='permissions') class="active" @endif><a href="{{route('permissions.index')}}"><i class="fa fa-key"></i>@lang('menu.settings.permissions')</a>
                            </li>
                         </ul>
                    </li>
                    @endif
                   
                    </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Page Content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('header')
                </section>
                <section class="content">
                    
                    @if($errors->any())
                    <ul class="list-group"> 
                        @foreach($errors->all() as $error)
                        <li class="list-group-item alert alert-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    @yield('content')
                </section>
            </div>
   </section>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.7
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://opiant.in">Opiant Tech Solutions Pvt. Ltd.</a>.</strong> All rights
    reserved.
</footer>
</div>


<!-- jQuery UI 1.11.4 -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="{{ asset(elixir('plugins/jQuery/jquery-2.2.3.min.js')) }}"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset(elixir('js/bootstrap.min.js')) }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset(elixir('plugins/morris/morris.min.js')) }}"></script>
<!-- Sparkline -->
<script src="{{ asset(elixir('plugins/sparkline/jquery.sparkline.min.js')) }}"></script>
<!-- jvectormap -->
<script src="{{ asset(elixir('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')) }}"></script>
<script src="{{ asset(elixir('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')) }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset(elixir('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')) }}"></script>
<!-- Slimscroll -->
<script src="{{ asset(elixir('plugins/slimScroll/jquery.slimscroll.min.js')) }}"></script>
<!-- FastClick -->
<script src="{{ asset(elixir('plugins/fastclick/fastclick.js')) }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset(elixir('js/app.min.js')) }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset(elixir('js/pages/dashboard2.js')) }}"></script>
<script src="{{ asset(elixir('plugins/datatables/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(elixir('plugins/datatables/dataTables.bootstrap.min.js')) }}"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="{{ asset(elixir('js/demo.js')) }}"></script>


<script>
    
 $('body').on('focus',".multiple_date", function(){
         $(this).datepicker({
              dateFormat: 'dd-mm-yy',
              changeYear: true
          });
      }); 
  $('#map1').append('<div style="" id="map"><div class="loading_bar"></div></div>');
$(window).on('load', function(){
  setTimeout(removeLoader, 200); //wait for page load PLUS two seconds.
});
function removeLoader(){
    $( "#map" ).fadeOut(100, function() {
      // fadeOut complete. Remove the loading div
      $( "#map" ).remove(); //makes page more lightweight 
      $( "#map1" ).hide(); //makes page more lightweight 
  });  
}  
</script>

@stack('scripts')
</body>
</html>
