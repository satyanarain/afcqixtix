<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @if(Session::has('download.in.the.next.request'))
  <meta http-equiv="refresh" content="5;url={{ Session::get('download.in.the.next.request') }}">
  @endif
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Qixtix | AFC</title>
  <link rel="icon" type="image/png" sizes="16x16" href="{{url('images/favicon-16x16.png')}}">
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
  <link rel="stylesheet" src="https://cdn.datatables.net/buttons/1.5.1/css/buttons.jqueryui.min.css">
  <!--<link rel="stylesheet" src="https://cdn.datatables.net/1.10.16/css/dataTables.jqueryui.min.css">-->
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css" />
  <link rel="stylesheet" href="{{URL::asset('plugins/datatables/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{URL::asset('css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('css/custom.css')}}">
  <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
  
  <script>    
    window.Laravel = <?php
    echo json_encode([
      'csrfToken' => csrf_token(),
    ]);
    ?>
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div id="map1">
    <div id="map">
      <div class="loading_bar">
       {{ HTML::image('images/bus_loader.gif', 'alt text', array('class' => 'css-class')) }}
     </div>    
   </div>
 </div>

 <?php $segments_var = Request::segments();?>  
 <div class="wrapper" >
  <header class="main-header">   
    <!-- Logo -->
    <a href="/dashboard" class="logo" style="text-align: left;">
      <img src="<?php echo \URL::to('')?>/images/qt-logo.png" style="height: 30px; float: left;margin-top: 10px;">
      <span class="logo-lg" style="float: left;margin-left: 8px;">QixTix | AFCS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div style="width: 82%;float: left;text-align: center; color: #fff;font-size: 20px;padding-top: 10px;">Automated Fare Collection System</div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             @if(Auth::user()->image_path)
             {{Html::image('/images/photo/'.Auth::user()->image_path,'',array('class'=>"user-image img-circle",'style'=>"height:auto;width:20px;"))}}
             @else
             <img src="<?php echo \URL::to('') . '/img/user2-160x160.jpg' ?>" class="user-image">
             @endif
             <span class="hidden-xs">{{{ isset(Auth::user()->salutation) ? Auth::user()->salutation : '' }}} {{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}}!</span>
             <b class="caret"></b>
           </a>
           <ul class="dropdown-menu" style="width:50%">
            <li>
             <ul class="menu" style="overflow: hidden;">
              <li>
                <a href="{{ url('/users/'.Auth::user()->id) }}">
                  <span class="glyphicon glyphicon-user text-green"></span>Profile
                </a>
              </li>

              <li>
                <a href="{{ url('/changepasswords/create/') }}">
                  <i class="fa fa-exchange text-yellow"></i>Change Password
                </a>
              </li>
              <li>
                <a href="{{ url('/logout') }}">
                  <i class="fa fa-sign-out text-warning"></i>Logout
                </a>
              </li>
            </ul>

          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
</header>

<aside class="main-sidebar">
 <section class="sidebar">
   <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li @if($segments_var[0]=='dashboard') class="treeview active" @else class="treeview" @endif>
     <a href="{{route('dashboard')}}">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>



  <li @if($segments_var[0]=='depots') class="treeview active" @else class="treeview" @endif>
    <a href="#">
      <i class="fa fa-bus"></i> <span>Manage Masters</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    @php
    $array= array('depots','bus_types','services','vehicles','shifts','stops','routes','route_master','duties','targets','trips','fares','concession_fare_slabs'
    ,'concessions','trip_cancellation_reasons','inspector_remarks','payout_reasons','denominations','pass_types','crew','etm_details')
    @endphp
    <ul @if(in_array($segments_var[0],$array)) class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>

      @if(menuPermission('depots')==1)
      <li @if($segments_var[0]=='depots') class="active" @endif><a href="{{route('depots.index')}}">
        <i class="depot-icon"></i> @lang('menu.depots.title')
      </a>
    </li>
    @endif
    @if(menuPermission('bus_types')==1)
    <li @if($segments_var[0]=='bus_types') class="active" @endif><a href="{{route('bus_types.index')}}">
      <i class="fa fa-bus"></i> @lang('menu.bus_types.title') 
    </a>
  </li>
  @endif


  @if(menuPermission('shifts')==1)
  <li @if($segments_var[0]=='shifts') class="active" @endif><a href="{{route('shifts.index')}}">
    <i class="fa fa-calendar"></i> @lang('menu.shifts.title') 
  </a>
</li>
@endif
@if(menuPermission('stops')==1)
<li @if($segments_var[0]=='stops') class="active" @endif><a href="{{route('stops.index')}}">
  <i class="stop-icon"></i> @lang('menu.stops.title') 
</a>
</li>
@endif
@if(menuPermission('routes')==1)
<li @if($segments_var[0]=='route_master') class="active" @endif><a href="{{route('route_master.index')}}">
  <i class="fa fa-map-marker"></i> @lang('menu.routes.title') 
</a>
</li>
@endif
@if(menuPermission('trip_cancellation_reasons')==1)
<li @if($segments_var[0]=='trip_cancellation_reasons') class="active" @endif><a href="{{route('trip_cancellation_reasons.index')}}">
  <i class="fa fa-inr"></i> @lang('menu.trip_cancellation_reason.title') </a>
</li>
@endif
@if(menuPermission('inspector_remarks')==1)
<li @if($segments_var[0]=='inspector_remarks') class="active" @endif><a href="{{route('inspector_remarks.index')}}">
  <i class="fa fa-user"></i>Inspector Remarks </a>
</li>
@endif
@if(menuPermission('payout_reasons')==1)
<li @if($segments_var[0]=='payout_reasons') class="active" @endif><a href="{{route('payout_reasons.index')}}">
  <i class="fa fa-cc-mastercard"></i>Payout Options </a>
</li>
@endif
@if(menuPermission('denominations')==1)
<li @if($segments_var[0]=='denominations') class="active" @endif><a href="{{route('denominations.index')}}">
  <i class="denominations-icon"></i> @lang('menu.denominations.title') </a>
</li>
@endif
@php $pem=menuDisplayByUser($result, 'etm_details','view'); @endphp
@if($pem=='true')
<li @if($segments_var[0]=='etm_details') class="active" @endif><a href="{{route('etm_details.index')}}"><i class="fa fa-calculator"></i>ETM Details</a>
</li>
@endif
</ul>
</li>

<!--Start Inventories left menu details-->  
@php 
$pem=menuDisplayByUser($result, 'centerstocks','view'); 
@endphp
@if($pem=='true')
<li @if($segments_var[1]=='centerstock' || $segments_var[1]=='depotstock' || $segments_var[1]=='crewstock' || $segments_var[1]=='returncrewstock') class="treeview active" @else class="treeview" @endif>
  <a href="#">
    <i class="fa fa-user"></i> <span>@lang('Manage Inventories')</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul @if($segments_var[1]=='centerstock' || $segments_var[1]=='depotstock' || $segments_var[1]=='crewstock') class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
    <li @if($segments_var[1]=='returncrewstock') class="active treeview" @endif>
      <a href="#"><i class="fa fa-edit"></i>Assign Inventory</a>
      <ul @if(($segments_var[1]=='centerstock' || $segments_var[1]=='depotstock' || $segments_var[1]=='crewstock') && $segments_var[2]!='summary') class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
        <li @if($segments_var[1]=='centerstock') class="active" @endif><a href="{{route('inventory.centerstock.index')}}"><i class="fa fa-edit"></i>Central Stock</a></li>
        <li @if($segments_var[1]=='depotstock') class="active" @endif><a href="{{route('inventory.depotstock.index')}}"><i class="fa fa-edit"></i>Depot Stock</a></li>
        <li @if($segments_var[1]=='crewstock') class="active" @endif><a href="{{route('inventory.crewstock.index')}}"><i class="fa fa-edit"></i>Crew Stock</a></li>
        <li @if($segments_var[1]=='returncrewstock') class="active" @endif><a href="{{route('inventory.returncrewstock.index')}}"><i class="fa fa-edit"></i>Return Crew Stock</a></li>
      </ul>
    </li>

    <li @if($segments_var[2]=='summary') class="active treeview" @endif>
      <a href="#"><i class="fa fa-list"></i>Inventory Summary</a>
      <ul @if(($segments_var[1]=='centerstock' || $segments_var[1]=='depotstock' || $segments_var[1]=='crewstock') && $segments_var[2]=='summary') class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
        <li @if($segments_var[1]=='centerstock' && $segments_var[2]=='summary') class="active" @endif><a href="{{route('inventory.centerstock.summary')}}"><i class="fa fa-edit"></i>Central Stock</a></li>
        <li @if($segments_var[1]=='depotstock') class="active" @endif><a href="{{route('inventory.depotstock.summary')}}"><i class="fa fa-edit"></i>Depot Stock</a></li>
        <li @if($segments_var[1]=='crewstock') class="active" @endif><a href="{{route('inventory.crewstock.summary')}}"><i class="fa fa-edit"></i>Crew Stock</a></li>
      </ul>
    </li>
  </ul>
</li>
@endif
<!-- End Inventories menu details -->
@php $pem=menuDisplayByUser($result, 'waybills','view'); @endphp
@if($pem=='true')
<li  @if($segments_var[0]=='waybills') class="treeview active" @else class="treeview" @endif>
  <a href="#">
    <i class="fa fa-cog" aria-hidden="true"></i> <span>Waybill Management</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul @if($segments_var[0]=='waybills') class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
    <li @if($segments_var[0]=='waybills' && !$segments_var[1]) class="active" @endif><a href="{{route('waybills.index')}}"><i class="fa fa-key"></i>Abstract</a></li>
    <li @if($segments_var[0]=='waybills' && $segments_var[1]=='cash_collection') class="active" @endif><a href="{{route('waybills.cash_collection')}}"><i class="fa fa-key"></i>Cash Collection</a></li>
    <!--                            <li @if($segments_var[1]=='auditlist') class="active" @endif><a href="{{route('waybills.auditlist')}}"><i class="fa fa-key"></i>Audit</a></li>-->
  </ul>
</li>
@endif   

@php $pem=menuDisplayByUser($result, 'users','view'); @endphp
@if($pem=='true')
<li @if($segments_var[0]=='users') class="treeview active" @else class="treeview" @endif>
  <a href="{{route('users.index')}}">
    <i class="fa fa-users"></i> <span>Manage Users</span>
  </a>
</li>
@endif



@php $pem=menuDisplayByUser($result, 'centerstocks','view'); @endphp
@if($pem=='true')
<li  @if($segments_var[0]=='notification') class="treeview active" @else class="treeview" @endif>
  <a href="#">
    <i class="fa fa-bell" aria-hidden="true"></i> <span>Manage Notifications</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul @if($segments_var[1]=='inventory') class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
    <li @if($segments_var[1]=='inventory') class="active" @endif><a href="{{route('notification.inventory.index')}}"><i class="fa fa-edit"></i>@lang('Inventory')</a>
    </li>                      
  </ul>
</li>
@endif

<!--manage reports-->
                    
<li @if($segments_var[0]=='etm_reports' || $segments_var[0]=='ppt_reports' || $segments_var[0]=='revenue_reports') class="treeview active" @else class="treeview" @endif>
  <a href="#">
      <i class="fa fa-book"></i> <span>Manage Reports</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
      </span>
  </a>
@php
$array= array('etm', 'revenue', 'ppt')
@endphp
<ul @if(in_array($segments_var[1],$array)) class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
<?php //print_r($segments_var);die;?>
    @if(menuPermission('etm_reports')==1)
        <li @if($segments_var[1]=='etm') class="treeview active" @else class="treeview" @endif>
            <a href="#">
              <i class="fa fa-calculator"></i> <span>ETM Reports</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
            <ul @if(in_array($segments_var[0],$array)) class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>

                <li @if($segments_var[2]=='audit_status') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.etm.audit_status.index')}}">
                        <i class="fa fa-circle-o text-green"></i> Audit Status
                    </a>
                </li>
                <li @if($segments_var[2]=='activity_log') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.etm.activity_log.index')}}">
                        <i class="fa fa-circle-o text-green"></i> ETM Activity Log
                    </a>
                </li>
                <li @if($segments_var[2]=='issue_details') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.etm.issue_details.index')}}">
                        <i class="fa fa-circle-o text-green"></i> ETM Issue
                    </a>
                </li>
                <li @if($segments_var[2]=='not_sync') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.etm.not_sync.index')}}">
                        <i class="fa fa-circle-o text-green"></i> ETM Not Sync
                    </a>
                </li>
                <li @if($segments_var[2]=='pending_activity_log') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.etm.pending_activity_log.index')}}">
                        <i class="fa fa-circle-o text-green"></i> ETM Pending Activity Log
                    </a>
                </li>
                <li @if($segments_var[2]=='passes_validated_details') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.etm.passes_validated_details.index')}}">
                        <i class="fa fa-circle-o text-green"></i> Passes Validated
                    </a>
                </li>
                <li @if($segments_var[2]=='penalty_ticket_details') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.etm.penalty_ticket_details.index')}}">
                        <i class="fa fa-circle-o text-green"></i> Penalty Ticket
                    </a>
                </li>
                <li @if($segments_var[2]=='trip_cancellation') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.etm.trip_cancellation.index')}}">
                        <i class="fa fa-circle-o text-green"></i> Trip Cancellation
                    </a>
                </li>
                <li @if($segments_var[2]=='route_change') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o text-green"></i> Route Change
                    </a>
                </li>
                <li @if($segments_var[2]=='sam_data') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o text-green"></i> SAM Data
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(menuPermission('ppt_reports')==1)
        <li @if($segments_var[1]=='ppt') class="treeview active" @else class="treeview" @endif>
            <a href="#">
              <i class="fa fa-ticket"></i> <span>PPT Reports</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
            <ul @if(in_array($segments_var[0],$array)) class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
                <li @if($segments_var[2]=='consumption') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.ppt.consumption.index')}}">
                        <i class="fa fa-circle-o text-yellow"></i> Consumption Of PPT
                    </a>
                </li>
                <li @if($segments_var[2]=='crew_stock') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.ppt.crew_stock.index')}}">
                        <i class="fa fa-circle-o text-yellow"></i> Crew Stock
                    </a>
                </li>                
                <li @if($segments_var[2]=='denomination_wise_stock_ledger') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.ppt.denomination_wise_stock_ledger.index')}}">
                        <i class="fa fa-circle-o text-yellow"></i> Denom-wise Stock Ledger
                    </a>
                </li>
                <li @if($segments_var[2]=='depot_stock') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.ppt.depot_stock.index')}}">
                        <i class="fa fa-circle-o text-yellow"></i> Depot Stock
                    </a>
                </li>
                <li @if($segments_var[2]=='issues_to_crew') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.ppt.issues_to_crew.index')}}">
                        <i class="fa fa-circle-o text-yellow"></i> Issues To Crew
                    </a>
                </li>
                <li @if($segments_var[2]=='receipt_from_main_office') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.ppt.receipt_from_main_office.index')}}">
                        <i class="fa fa-circle-o text-yellow"></i> Receipts From Main Office
                    </a>
                </li>
                <li @if($segments_var[2]=='returned_by_conductor') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.ppt.returned_by_conductor.index')}}">
                        <i class="fa fa-circle-o text-yellow"></i> Returned By Conductor
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(menuPermission('revenue_reports')==1)
        <li @if($segments_var[1]=='revenue') class="treeview active" @else class="treeview" @endif>
            <a href="#">
              <i class="fa fa-inr"></i> <span>Revenue Reports</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul @if(in_array($segments_var[0],$array)) class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
                
                <li @if($segments_var[2]=='depot_wise_collection') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.revenue.depot_wise_collection.index')}}">
                        <i class="fa fa-circle-o color-cyan"></i> Depot wise Revenue Collection
                    </a>
                </li>
                <li @if($segments_var[2]=='route_wise_collection') class="treeview active" @else class="treeview" @endif>
                    <a href="{{route('reports.revenue.route_wise_collection.index')}}">
                        <i class="fa fa-circle-o color-cyan"></i> Route wise Revenue Collection
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Crew wise Revenue Collection
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Trip wise Revenue Collection
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Daily Revenue Collection Statement
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Date wise Revenue Collection
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Revenue EPKM
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Vehicle wise Collection
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Payout
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Passenger Profiling Bus Stop wise
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Pass Sold
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Passenger Profiling Route wise
                    </a>
                </li>
                 <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Concession Ticket Collection
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Passesnger Profiling Origin-Dest Stop wise
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> ETM wise Transaction Count 
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Bus wise Earning
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Date wise BOT Share Details
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Conductor wise Earning
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Shift Details Earning
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Conductor Ledger
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Route wise Summary
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Schedule wise EPKM
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Conductor wise Income Compared To Target Income
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Comparative Statement for Last Year
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Print Error Details
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Date wise Denominations Report
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Route wise Denominations Report
                    </a>
                </li>
                <li @if($segments_var[0]=='audit_statuses') class="treeview active" @else class="treeview" @endif>
                    <a href="#">
                        <i class="fa fa-circle-o color-cyan"></i> Cash Collection Report
                    </a>
                </li>
            </ul>
        </li>
    @endif
</ul>
</li>
                
@php $pem=menuDisplayByUser($result, 'centerstocks','view'); @endphp
@if($pem=='true')
<li  @if($segments_var[1]=='health_status' || $segments_var[0]=='tripsheet') class="treeview active" @else class="treeview" @endif>
  <a href="#">
    <i class="fa fa-calculator" aria-hidden="true"></i> <span>ETM</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul @if($segments_var[1]=='health_status') class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
    <li @if($segments_var[1]=='health_status') class="active" @endif><a href="{{url('etm/health_status')}}"><i class="fa fa-medkit"></i>Health Status</a>
    </li>   
    <li @if($segments_var[0]=='tripsheet') class="active" @endif><a href="{{route('tripsheet')}}"><i class="fa fa-tripadvisor"></i>Trip Sheet</a>
    </li>                    
  </ul>
</li>
@endif

<li @if($segments_var[0]=='versions') class="treeview active" @else class="treeview" @endif>
 <a href="{{route('versions.index')}}">
   <i class="version-icon"></i><span>Version Control</span>
 </a>
</li>
@php $pem=menuDisplayByUser($result, 'permissions','view'); @endphp
@if($pem=='true')
<li  @if($segments_var[0]=='roles' || $segments_var[0]=='permissions' || $segments_var[0]=='settings') class="treeview active" @else class="treeview" @endif>
  <a href="#">
    <i class="fa fa-cog" aria-hidden="true"></i> <span>Settings</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul @if($segments_var[0]=='changepasswords' || $segments_var[0]=='permissions' || $segments_var[0]=='settings') class="treeview-menu active" style="display:block" @else class="treeview-menu" @endif>
   <li @if($segments_var[0]=='roles' || $segments_var[0]=='permissions') class="active" @endif><a href="{{route('permissions.index')}}"><i class="fa fa-key"></i>Roles and Permissions</a></li>
   <li @if($segments_var[0]=='settings') class="active" @endif><a href="{{route('settings.index')}}"><i class="fa fa-cog"></i>Configuration Settings</a></li>     
   <li @if($segments_var[0]=='changepasswords') class="active" @endif><a href="{{route('changepasswords.create')}}"><i class="fa fa-key"></i>Change Password</a></li>   



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
    <ul class="list-group" id='error_message_red'> 
      @foreach($errors->all() as $error)
      <li class="list-group-item alert alert-danger">{{ $error }}</li>
      @endforeach
    </ul>
    @endif
    @yield('content')
    <div class="modal fade" id="common_details" role="dialog">
      <div class="modal-dialog">
>>>>>>> ed82988103c3dff4600205a7096cf42d5a4cdce4
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header-view" >
            <!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
            <h4 class="viewdetails_details"><span class="fa fa-plus"></span>&nbsp;Add New</h4>
          </div>
          <div class="modal-body-view">
           <div class="alert-new-success" id="add_new_data" style="display:none;"></div>
           <div class="list-group-item alert alert-danger" id="add_new_data_danger" style="display:none;"></div>
           <table class="table table-responsive.view">
            <tr>       
              <td>Name</td>
              <td class="table_normal">
                <input name="name" id="name" class="form-control">
                <input name="field_name" id="field_name" class="form-control" type="hidden">
                <input name="table_name" id="table_name" class="form-control" type="hidden">
                <input name="placeholder" id="placeholder" class="form-control" type="hidden">
              </td>
            </tr>
          </table>  
          <div class="modal-footer">
           <div  class="btn btn-success pull-left" onclick="AddNew()">Add New</div><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
         </div>
       </div>
     </div>

   </div>
 </div>

 @include('partials.depot_addnew')
</section>
</div>
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.3.7
  </div>
  <strong>Copyright &copy; 2014-2018 <a href="http://opiant.in">Opiant Tech Solutions Pvt. Ltd.</a>.</strong> All rights
  reserved.
</footer>
</div>


<!-- jQuery UI 1.11.4 -->
@stack('healthstatusscripts')
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
<!--<script src="{{ asset(elixir('js/pages/dashboard2.js')) }}"></script>-->

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="{{ asset(elixir('js/demo.js')) }}"></script>
<script src="{{ asset(elixir('js/jQueryRotate.js')) }}"></script>

<script src="{{ asset(elixir('plugins/datatables/dataTables.bootstrap.min.js')) }}"></script>

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">-->


<link rel="stylesheet" href="{{ asset('css/buttons.dataTables.min.css') }}">
<style type="text/css" class="init"></style>
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
<!--<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>-->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script type="text/javascript">

  $('body').on('focus',".multiple_date", function(){
   $(this).datepicker({
    dateFormat: 'dd-mm-yy',
    startView: "year", 
    changeYear: true,
    yearRange: "-80Y:-0Y",
    minDate: "-80Y",
    maxDate: "-0Y"
  });
 }); 
  $('body').on('focus',".multiple_date1", function(){
   $(this).datepicker({
    dateFormat: 'dd-mm-yy',
    startView: "year", 
    changeYear: true,

    minDate: 0,

  });
 }); 

 //$(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii', minDate:new Date()});
 $('.form_datetime').datetimepicker({
        //language:  'fr',
        format: 'dd-mm-yyyy hh:ii',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        startDate:new Date()
      });
 $('.form_date').datetimepicker({
        //language:  'fr',
        format: 'dd-mm-yyyy',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
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
function numvalidate(e) 
{
  var key;
  var keychar;
  if (window.event)
    key = window.event.keyCode;
  else if (e)
    key = e.which;
  else
    return true;
  keychar = String.fromCharCode(key);
  keychar = keychar.toLowerCase();
    // control keys
    if ((key == null) || (key == 0) || (key == 8) || (key == 9)
      || (key == 13) || (key == 27))
      return true;
    else if (!(("1234567890").indexOf(keychar) > -1)) {
      return false;
    }
  } 
</script>
@stack('scripts')
@include('partials.table_script_order')
</body>
</html>
