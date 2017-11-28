<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    @if(Session::has('download.in.the.next.request'))
        <meta http-equiv="refresh" content="5;url={{ Session::get('download.in.the.next.request') }}">
    @endif
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('images/favicon-16x16.png')}}">

    
    
  <link rel="stylesheet" href="{{ asset(elixir('css/bootstrap.min.css')) }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset(elixir('css/AdminLTE.min.css')) }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
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
    @yield('custom_css')
    @yield('custom_js')
 </head>
<body>

    <div class="progress_custummain_div_client">
        <div class="progress_custum"></div>
    </div>

    <div id="">
    
	  <div id="">
	    <header class="navbar-fixed-top " role="banner">	
          <div class="navbar navbar-default nav_custom">
	
          	<div class="header">
              <a href="#menu"><span></span></a>
            </div>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-bell"><span id="notifycount"></span></i>
                    </a>

                    <ul class="dropdown-menu notification-dropdown" role="menu">
                        <div class="notification-heading">
                            <h4 class="menu-title">Notifications</h4>
                            <h4 class="menu-title pull-right">
                                <a href="{{route('notifications.markall')}}">Mark all as read</a>
                                <i class="fa fa-arrow-circle-o-right"></i>
                            </h4>
                        </div>
                        <li class="divider"></li>
                        <div class="notifications-wrapper">                         
                            <span id="notification-item"></span>
                        </div> 
                    </ul>
                </li>

        
         <!--NOTIFICATIONS END-->
  <div class="kipg-select-company">
                    <div class="kipg-select-company-text" style="padding: 5px;">
                      @if(Auth::user()->image_path)
                      {{ Html::image('images/Media/'.Auth::user()->image_path, Auth::user()->image_path, ['class'=>'use-profile-image']) }}
                      @else
                      {{ Html::image('images/Media/default_icon2.jpg', '', ['class'=>'use-profile-image']) }}
                      @endif
                  </div>
                  <div class="kipg-select-company-text">
                      <h3 style="margin-top: 17px;font-size: 15px;color:#fff;">Welcome, {{{ isset(Auth::user()->salutation) ? Auth::user()->salutation : '' }}} {{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}}!</h3>
                  </div>
<!--chat section//////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- end chat-->
 <div class="logout">
                      <a href="{{ url('/logout') }}" class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                  </div>
              </div>
         @if(Entrust::hasRole('administrator') || Entrust::hasRole('group_admin'))
              <div class="kipg-select-company">
                <div class="kipg-select-company-text">
                  <h3 style="margin-top: 17px;font-size:15px;color:#fff;">Change Company
                  </h3>
              </div>
              <div class="kipg-dropdown">
                  <select class="form-control" id="current_company">
                  </select>
              </div>
          </div>
          @endif

      </div>  
</header>

<nav id="menu" class="menu_bg">
<div class="list-group panel">
    <p class=" list-group-item" title=""><img src="{{url('images/kerda.png')}}" alt="" style="width:100%;"></p>
  <a href="{{route('showdashboard', \Auth::id())}}" class="list-group-item childlist   @if ($showdashboard=="showdashboard"){{'menu_active'}} @endif ">
                <i class="glyphicon glyphicon-dashboard  "></i> 
                @lang('menu.dashboard') 
            </a>
           <a href="{{route('users.show', \Auth::id())}}"class="list-group-item childlist @if ($userprofile=="userprofile"){{'menu_active'}} @endif ">
                <i class="glyphicon glyphicon-user"></i> 
                @lang('menu.profile') 
            </a>
     <script>
  $(document).ready(function() {
    function close_accordion_section() {
        $('.accordion .accordion-section-title').removeClass('active');
        $('.accordion .accordion-section-content').slideUp(300).removeClass('open');
    }
 
    $('.accordion-section-title').click(function(e) {
        // Grab current anchor value
        var currentAttrValue = $(this).attr('href');
 
        if($(e.target).is('.active')) {
            close_accordion_section();
        }else {
            close_accordion_section();
 
            // Add active class to section title
            $(this).addClass('active');
            // Open up the hidden content panel
            $('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
        }
 
        e.preventDefault();
    });
  
  $('a').on('click', function(e) {
  $(this).find('[class*="angle"]').toggleClass('fa-angle-right fa-angle-down');
}); 
});
 </script>
<div class="accordion">
<!--import section-->
@if(Entrust::hasRole('administrator') || Entrust::hasRole('group_admin'))  
<div class="accordion-section">
<a 
<?php if ($importmainmenu=="importmainmenu")
{?>
class="accordion-section-title active"
<?php } else {?>
class="accordion-section-title" 
<?php } ?> href="#accordion-1">

 <i class="fa fa-download" aria-hidden="true"></i>

<i class="fa fa-angle-right pull-right"></i>
@lang('menu.import.title')
</a>

<div id="accordion-1"  syle="margin-left:10px;"
<?php if ($importmainmenu=="importmainmenu")
{?>
class="accordion-section-content open" style="display:block";
<?php } else{?>
class="accordion-section-content" style="display:none";
<?php } ?>
>
<a href="{{ route('import.clients.form')}}" class="list-group-item childlist @if ($importclients_sub=='importclients_sub')
{{'menu_active'}} @endif "> 
<span style="margin-left:20px;">  
<span class="fa fa-building-o"></span>
 @lang('menu.import.client')
 </span>
</a>
<a href="{{ route('import.trademarks.form')}}" class="list-group-item childlist @if ($importtrademark_sub=='importtrademark_sub')
{{'menu_active'}} @endif ">
<span style="margin-left:20px;">  
<i class="fa fa-trademark" aria-hidden="true"></i>
@lang('menu.import.trademark')
</span>
</a>
<a href="{{ route('import.geographicalindications.form')}}" class="list-group-item childlist @if ($importgeographicalindication_sub=='importgeographicalindication_sub')
{{'menu_active'}} @endif ">
<span style="margin-left:20px;">  
<i class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></i> Geographical Indication
</span>
</a>

<a href="{{ route('import.domainnames.form')}}" class="list-group-item childlist @if ($importdomainnames_sub=='importdomainnames_sub')
{{'menu_active'}} @endif ">
<span style="margin-left:20px;">  
<i class="glyphicon glyphicon-sound-dolby" aria-hidden="true"></i> Domian Names

</span>
</a>

<a href="{{ route('import.customrecordals.form')}}" class="list-group-item childlist @if ($importcustomrecordals_sub=='importcustomrecordals_sub')
{{'menu_active'}} @endif ">
<span style="margin-left:20px;">  
<i class="glyphicon glyphicon-record" aria-hidden="true"></i> Custom Recordals
</span>
</a>

<a href="{{ route('import.copyrights.form')}}" class="list-group-item childlist @if ($importcopyrights_sub=='importcopyrights_sub')
{{'menu_active'}} @endif ">
<span style="margin-left:20px;">  
<i class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></i> Copyright

</span>
</a>
</div>
</div>
@endif

@if(Entrust::hasRole('administrator') || Entrust::hasRole('group_admin') || Entrust::hasRole('kipg_general_user') || Entrust::hasRole('client_user') || Entrust::hasRole('associate_user') )

<a href="{{route('globalsearches.index')}}" 
class="list-group-item childlist @if($globalsearchmenu=="globalsearchmenu"){{'menu_active'}} @endif">
 <i class="fa fa-search" aria-hidden="true"></i>
 Global Search
</a>
@endif
@if(Entrust::hasRole('administrator') || Entrust::hasRole('group_admin') || Entrust::hasRole('kipg_general_user') )
<a href="{{route('eventbudget.index')}}" class="list-group-item childlist @if($budget=="budget"){{'menu_active'}} @endif ">
    <i class="glyphicon glyphicon-tag"></i> 
    @lang('menu.event-budget.title') 
</a>
@endif

@if(Entrust::hasRole('administrator') || Entrust::hasRole('group_admin') )
<a href="{{route('rating_and_reviews.index')}}" class="list-group-item childlist @if($rating=="rating"){{'menu_active'}} @endif " data-parent="#MainMenu">
    <i class="glyphicon glyphicon-star"></i> 
    @lang('menu.rating_and_reviews.title') 
</a>
@endif

@if(Entrust::hasRole('client_user') )
<a href="#" class="list-group-item childlist @if($rating=="rating"){{'menu_active'}} @endif " data-parent="#MainMenu">
    <i class="glyphicon glyphicon-star"></i> 
    Reporting 
</a>
<a href="#" class="list-group-item childlist @if($rating=="rating"){{'menu_active'}} @endif " data-parent="#MainMenu">
    <i class="glyphicon glyphicon-star"></i> 
    Deadlines 
</a>
@endif


<!--start accordian5-->
@if(Entrust::hasRole('associate_user'))
<div class="accordion-section">
<a  href="#accordion-5"
<?php if ($kipgagreedfeemenu=="kipgagreedfeemenu")
{?>
class="accordion-section-title active"
<?php } else {?>
class="accordion-section-title" 
<?php } ?>
>
<i class="fa fa-angle-right pull-right @if ($kipgagreedfeemenu=='kipgagreedfeemenu')
{{'main_active'}} @endif"></i>
<i class="fa fa-usd"></i> </span>KIPG Agreed Fee</a>


<div id="accordion-5" 
<?php if ($kipgagreedfeemenu=="kipgagreedfeemenu")
{?>
class="accordion-section-content open" style="display:block";
<?php } else{?>
class="accordion-section-content" style="display:none";
<?php } ?>
>
<a href="{{route('costcentertrademarks.index')}}"  class="list-group-item childlist @if ($kipgagreedfeemenutrademark == "kipgagreedfeemenutrademark"){{'menu_active'}} @endif ">
    <span style="margin-left:20px;">
        <span class="fa fa-trademark"></span> 
        @lang('menu.admin.costcenter.trademark')
    </span>      
</a>    
        
<a href="{{route('costcenter.patents.index')}}" class="list-group-item childlist @if ($kipgagreedfeemenupatent=="kipgagreedfeemenupatent"){{'menu_active'}} @endif">
    <span style="margin-left:20px;">
  <i class="fa fa-wpforms" aria-hidden="true"></i>
   Patents
</span>  </a>  
   <a href="{{route('costcenter.gis.index')}}" class="list-group-item childlist @if ($kipgagreedfeemenugi=="kipgagreedfeemenugi"){{'menu_active'}} @endif">
   <span style="margin-left:20px;">
  <i class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></i>
 Geographical Indications</span>  </a>  
  <a href="{{route('costcenter.domainnames.index')}}" class="list-group-item childlist @if ($kipgagreedfeemenudomainname=="kipgagreedfeemenudomainname"){{'menu_active'}} @endif">
  <span style="margin-left:20px;">
  <i class="glyphicon glyphicon-sound-dolby" aria-hidden="true"></i> Domain Names </span> </a>
  
<a href="{{route('costcenter.customrecordals.index')}}" class="list-group-item childlist @if ($kipgagreedfeemenucustomrecordal=="kipgagreedfeemenucustomrecordal"){{'menu_active'}} @endif">
  <span style="margin-left:20px;">
  <i class="glyphicon glyphicon-record" aria-hidden="true"></i>
Custom Recordals </span> </a>

<a href="{{route('costcenter.copyrights.index')}}" class="list-group-item childlist @if ($kipgagreedfeemenucopyright=="kipgagreedfeemenucopyright"){{'menu_active'}} @endif">
  <span style="margin-left:20px;">
  <span class="glyphicon glyphicon-copyright-mark"></span>
Copyright</span> </a>


<a href="{{ route('costcenter.industrialdesigns.index')}}" class="list-group-item childlist @if ($kipgagreedfeemenuid=="kipgagreedfeemenuid"){{'menu_active'}} @endif">
  <span style="margin-left:20px;">
   <span class="glyphicon glyphicon-ban-circle"></span>
Industrial Designs</span> </a>
   
</div>
</div>
@endif

<!--end accordian5-->
{{--
@if(Entrust::hasRole('associate_user'))
<a href="#costcenter" class=" list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="fa fa-usd" aria-hidden="true"></i>
</i>  KIPG Agreed Fee </i>
</a>
<div class="collapse" id="costcenter">
    <a href="{{route('costcentertrademarks.index')}}" class="list-group-item childlist"><i class="fa fa-trademark" aria-hidden="true"></i> @lang('menu.costcenter.trademark')</a>
    <a href="{{route('costcenter.patents.index')}}" class="list-group-item childlist"> <i class="fa fa-wpforms" aria-hidden="true"></i> @lang('menu.costcenter.patent')</a>
    <a href="{{route('costcenter.gis.index')}}" class="list-group-item childlist"><i class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></i> @lang('menu.costcenter.gi')</a>
    <a href="{{route('costcenter.domainnames.index')}}" class="list-group-item childlist"><i class="glyphicon glyphicon-sound-dolby" aria-hidden="true"></i> @lang('menu.costcenter.domainname')</a>
    <a href="{{route('costcenter.customrecordals.index')}}" class="list-group-item childlist"><i class="glyphicon glyphicon-record" aria-hidden="true"></i> @lang('menu.costcenter.customrecordal')</a> 
    <a href="{{route('costcenter.copyrights.index')}}" class="list-group-item childlist"><i class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></i> @lang('menu.costcenter.copyright')</a>
    <a href="{{route('costcenter.industrialdesigns.index')}}" class="list-group-item childlist"><i class="glyphicon glyphicon-ban-circle" aria-hidden="true"></i> Industrial Design</a>              
</div>
@endif
--}}
@if(Entrust::hasRole('administrator') || Entrust::hasRole('group_admin'))
 <a href="{{route('clientfixedfees')}}" class="list-group-item childlist @if ($fixfee=="fixfee"){{'menu_active'}} @endif">
 <i class="fa fa-calculator" aria-hidden="true"></i>
 Client Fixed Fee 
</a>
@endif


@if(Entrust::hasRole('administrator') || Entrust::hasRole('group_admin'))
<a href="{{ route('calendar')}}" class=" list-group-item @if($calendar_menu=="calendar_menu"){{'menu_active'}} @endif"" data-parent="#MainMenu">
    <i class="glyphicon glyphicon-calendar"></i> 
    @lang('menu.calendar.title') 
</a>
@endif
<!--start accordian4-->
@if(Entrust::hasRole('administrator') || Entrust::hasRole('group_admin'))
<div class="accordion-section">
<a  href="#accordion-4"
<?php if ($costcentermenu=="costcentermenu")
{?>
class="accordion-section-title active"
<?php } else {?>
class="accordion-section-title" 
<?php } ?>
>
<i class="fa fa-angle-right pull-right @if ($costcentermenu=='costcentermenu')
{{'main_active'}} @endif"></i>
<i class="fa fa-usd"></i> </span>@lang('menu.admin.costcenter.title')</a>

<div id="accordion-4" 
<?php if ($costcentermenu=="costcentermenu")
{?>
class="accordion-section-content open" style="display:block";
<?php } else{?>
class="accordion-section-content" style="display:none";
<?php } ?>
>
           
<a href="{{route('admin.costcentertrademarks.index')}}"  class="list-group-item childlist @if ($costcentermenutrademark == "costcentermenutrademark"){{'menu_active'}} @endif ">
    <span style="margin-left:20px;">
		  <span class="fa fa-trademark"></span> 
      @lang('menu.admin.costcenter.trademark')</span>		   
</a>  
	      
<a href="{{route('admin.costcenter.patents.index')}}" class="list-group-item childlist @if ($costcentermenupatent=="costcentermenupatent"){{'menu_active'}} @endif">
	  <span style="margin-left:20px;">
	<i class="fa fa-wpforms" aria-hidden="true"></i>
	 Patents
</span>	 </a>  
  
	   
	 <a href="{{route('admin.costcenter.gis.index')}}" class="list-group-item childlist @if ($costcentermenugi=="costcentermenugi"){{'menu_active'}} @endif">
	 <span style="margin-left:20px;">
	<i class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></i>  
   Geographical Indications</span>  </a>  
      
	<a href="{{route('admin.costcenter.domainnames.index')}}" class="list-group-item childlist @if ($costcentermenudomainname=="costcentermenudomainname"){{'menu_active'}} @endif">
	<span style="margin-left:20px;">
	<i class="glyphicon glyphicon-sound-dolby" aria-hidden="true"></i> Domain Names </span> </a>
  
<a href="{{route('admin.costcenter.customrecordals.index')}}" class="list-group-item childlist @if ($costcentermenucustomrecordal=="costcentermenucustomrecordal"){{'menu_active'}} @endif">
	<span style="margin-left:20px;">
	<i class="glyphicon glyphicon-record" aria-hidden="true"></i>
Custom Recordals </span> </a>

<a href="{{route('admin.costcenter.copyrights.index')}}" class="list-group-item childlist @if ($costcentermenucopyright=="costcentermenucopyright"){{'menu_active'}} @endif">
	<span style="margin-left:20px;">
	<span class="glyphicon glyphicon-copyright-mark"></span>
Copyright</span> </a>

<a href="{{ route('admin.costcenter.industrialdesigns.index')}}" class="list-group-item childlist @if ($costcentermenuid=="costcentermenuid"){{'menu_active'}} @endif">
	<span style="margin-left:20px;">
	 <span class="glyphicon glyphicon-ban-circle"></span>
Industrial Designs</span> </a>
   
<a href="{{ route('admin.costcenter.madridapplication.index')}}" class="list-group-item childlist @if ($costcentermenumadridapplication=="costcentermenumadridapplication"){{'menu_active'}} @endif">
	<span style="margin-left:20px;">
	<i class="fa fa-calculator" aria-hidden="true"></i>
 Madrid Application</span> </a>
   
 
<a href="{{route('admin.costcenter.pctinternationalapplication.index')}}" class="list-group-item childlist @if ($costcentermenupctinternationalapplication=="costcentermenupctinternationalapplication"){{'menu_active'}} @endif">
	<span style="margin-left:20px;">
	<i class="fa fa-calculator" aria-hidden="true"></i>
 PCT International Application</a> 
</div>
</div>
@endif

<!--end accordian4-->
@if(Entrust::hasRole('administrator') || Entrust::hasRole('group_admin'))
<div class="accordion-section">
<a  href="#accordion-6"
<?php if ($profilemenu=="profilemenu")
{?>
class="accordion-section-title active"
<?php } else {?>
class="accordion-section-title" 
<?php } ?>
>
<i class="fa fa-angle-right pull-right @if ($profilemenu=='profilemenu')
{{'main_active'}} @endif"></i>
<i class="glyphicon glyphicon-th-large"></i> 
</span>@lang('menu.profiles.title') </a>
<div id="accordion-6" 
<?php if ($profilemenu=="profilemenu")
{?>
class="accordion-section-content open" style="display:block";
<?php } else{?>
class="accordion-section-content" style="display:none";
<?php } ?>
>
   

<a href="{{route('users.index')}}" class="list-group-item childlist  @if ($profilemenuusers=="profilemenuusers"){{'menu_active'}} @endif ">
<span style="margin-left:20px;">
<span class="glyphicon glyphicon-user"></span>
@lang('menu.settings.users')
</span> 
</a>
<a href="{{route('clients.index')}}" class="list-group-item childlist @if ($profilemenuclients=="profilemenuclients"){{'menu_active'}} @endif">
<span style="margin-left:20px;">
<i class="fa fa-building-o" aria-hidden="true"></i>
 @lang('menu.settings.clients')</span></a>

<a href="{{route('associates.index')}}" class="list-group-item childlist @if ($profilemenuassociates=="profilemenuassociates"){{'menu_active'}} @endif " >
<span style="margin-left:20px;">
<span class="glyphicon glyphicon-font"></span>
@lang('menu.settings.associates')</span>
</a>

</div>
</div>

@endif
<!--end accordian6-->
<!--start accordian3-->
<!--start accordian3-->
<!--start accordian3-->
<!--start accordian3-->
<!--start accordian3-->
<!--start accordian3-->
@if(Entrust::hasRole('administrator') || Entrust::hasRole('group_admin'))
<div class="accordion-section">
<a  href="#accordion-3"
<?php if ($settingmenu=="settingmenu")
{?>
class="accordion-section-title active"
<?php } else {?>
class="accordion-section-title" 
<?php } ?>
>
<i class="fa fa-angle-right pull-right @if ($settingmenu=='settingmenu')
{{'main_active'}} @endif"></i>
<i class="glyphicon glyphicon-cog"></i> </span> @lang('menu.settings.title')</a>

<div id="accordion-3" 
<?php if ($settingmenu=="settingmenu")
{?>
class="accordion-section-content open" style="display:block";
<?php } else{?>
class="accordion-section-content" style="display:none";
<?php } ?>
>
<a href="{{route('settings.reminders')}}"  class="list-group-item childlist @if ($settingmenureminderanddeadline=="settingmenureminderanddeadline"){{'menu_active'}} @endif ">
    <span style="margin-left:20px;">
		<span class="glyphicon glyphicon-scale"></span> 
Reminders and Deadlines</span>		   
</a>
	 <a href="{{ route('settings.index')}}" class="list-group-item childlist @if ($settingmenuoverall=="settingmenuoverall"){{'menu_active'}} @endif">
	  <span style="margin-left:20px;">
	<i class="fa fa-cogs" aria-hidden="true"></i>
	 @lang('menu.settings.overall')</a>  
</span>	 
   <a href="{{ route('roles.index')}}" class="list-group-item childlist @if ($settingmenuroles=="settingmenuroles"){{'menu_active'}} @endif">
	 <span style="margin-left:20px;">
	<i class="fa fa-rub" aria-hidden="true"></i>  
   @lang('menu.settings.roles')</a>  
     </span>    
 <a href="{{ route('settings.clientfixedfee')}}" class="list-group-item childlist @if ($settingmenuclientfixedfee=="settingmenuclientfixedfee"){{'menu_active'}} @endif">
	<span style="margin-left:20px;">
	<i class="fa fa-calculator" aria-hidden="true"></i>
Client Fixed Fee</a>
 </span>  
</div>
</div>
@endif

<!--end accordian3-->
<!--end accordian3-->
<!--end accordian3-->
<!--end accordian3-->
<!--end accordian3-->
<!--end accordian3-->

<!--start accordian8-->
@if(Entrust::hasRole('accountant'))
<div class="accordion-section">
<a  href="#accordion-8"
<?php if ($accountantmenu=="accountantmenu")
{?>
class="accordion-section-title active"
<?php } else {?>
class="accordion-section-title" 
<?php } ?>
>
<i class="fa fa-angle-right pull-right @if ($accountantmenu=='accountantmenu')
{{'main_active'}} @endif"></i>
<i class="glyphicon glyphicon-briefcase"></i> </span> Finance And Accounting </a>

<div id="accordion-8" 
<?php if ($accountantmenu=="accountantmenu")
{?>
class="accordion-section-content open" style="display:block";
<?php } else{?>
class="accordion-section-content" style="display:none";
<?php } ?>
>

<a href="{{route('financeandaccounting.clients.invoices.index')}}"  class="list-group-item childlist @if ($accountantmenuclientinvoice=="accountantmenuclientinvoice"){{'menu_active'}} @endif ">
    <span style="margin-left:20px;">
    <span class="fa fa-building-o"></span> 
Client Invoices</span>       
</a>

<a href="{{route('financeandaccounting.clients.remittances.index')}}"  class="list-group-item childlist @if ($accountantmenuclientremittance=="accountantmenuclientremittance"){{'menu_active'}} @endif ">
    <span style="margin-left:20px;">
    <span class="fa fa-building-o"></span> 
Client Remittance</span>       
</a>
     
     
<a href="{{ route('financeandaccounting.associates.invoices.index')}}" class="list-group-item childlist @if ($accountantmenuassociateinvoice=="accountantmenuassociateinvoice"){{'menu_active'}} @endif">
    <span style="margin-left:20px;">
  <i class="glyphicon glyphicon-font" aria-hidden="true"></i>
   Associate Invoices</span>
</a>

<a href="{{ route('financeandaccounting.associates.payments.index')}}" class="list-group-item childlist @if ($accountantmenuassociatepayment=="accountantmenuassociatepayment"){{'menu_active'}} @endif">
    <span style="margin-left:20px;">
  <i class="glyphicon glyphicon-font" aria-hidden="true"></i>
   Associate Payments</span>
</a>   
  
</div>
</div>
@endif
<!--end accordian8-->
</div><!--end .accordion-->

</div>
</nav>
<!-- Page Content -->
<section id="inner-page" style="border:0px solid red">
<div  id="page-content-wrapper" style="padding:0px;margin-bootom:50px;">
  <div class="container-fluid" style="padding: 0px;">
    <div class="row">
	 <div class="detail-form admin-panel panel-body">
      <div class="col-lg-12" style="margin-bottom: 46px;">          
        <h1 style="margin-top: 64px;">@yield('heading')</h1>
        @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
          @endforeach
      </div>

      @endif

      @yield('content')
  </div>
  </div>
</div>
</div>

@if(Session::has('flash_message_warning'))
<div class="notification-warning navbar-fixed-bottom ">
  <div class="notification-icon ion-close-circled"></div>
  <div class="notification-text">
    <span>{{ Session::get('flash_message_warning') }} </span>
</div>
</div>
@endif
@if(Session::has('flash_message'))
<div class="notification-success navbar-fixed-bottom ">
  <div class="notification-icon ion-checkmark-round"></div>
  <div class="notification-text">
    <span>{{ Session::get('flash_message') }} </span>
</div>
</div>
@endif        
</div>

</section></div>

<div class="footer-b"> 
© 2017 k-erda | All rights reserved. Designed and Developed by <a href="http://opiant.in/" target="_blank"><span  class="footer_text">Opiant Tech Solutions Pvt. Ltd.</span></a> 

</div>
<!--end chat////////////////////////////////////////////////////////////////////-->

<!-- Bootstrap Core JavaScript -->

<!--<script src="/js/app.js"></script>-->

<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset(elixir('plugins/jQuery/jquery-2.2.3.min.js')) }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset(elixir('js/bootstrap.min.js')) }}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset(elixir('plugins/morris/morris.min.js')) }}"></script>
<!-- Sparkline -->
<script src="{{ asset(elixir('plugins/sparkline/jquery.sparkline.min.js')) }}"></script>
<!-- jvectormap -->
<script src="{{ asset(elixir('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')) }}"></script>
<script src="{{ asset(elixir('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')) }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset(elixir('plugins/jQuery/jquery-2.2.3.min.js')) }}plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset(elixir('plugins/daterangepicker/daterangepicker.js')) }}"></script>
<!-- datepicker -->
<script src="{{ asset(elixir('plugins/datepicker/bootstrap-datepicker.js')) }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset(elixir('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')) }}"></script>
<!-- Slimscroll -->
<script src="{{ asset(elixir('plugins/slimScroll/jquery.slimscroll.min.js')) }}"></script>
<!-- FastClick -->
<script src="{{ asset(elixir('plugins/fastclick/fastclick.js')) }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset(elixir('js/app.min.js')) }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset(elixir('js/pages/dashboard.js')) }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset(elixir('js/demo.js')) }}"></script>

@stack('scripts')

</body>

</html>


      
      
  
