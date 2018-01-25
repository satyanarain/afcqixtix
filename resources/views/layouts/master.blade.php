<?php

$segments_var = '';
$segments_var = Request::segments();

$segments_var[0];
$segments_var[1];
$testerere= Config::get('app.locales');
$testerere[0];
App::setLocale($testerere[0]);
Config::get('app.timezone');
$dem_menu= pagePermissionView($result);
$array_menu= explode(',', $dem_menu);
if($segments_var[2]=='edit')
{
  unset($segments_var[1]); 
  
}










?>




@if(is_numeric(end($segments_var)) && empty($segments_var[2]) && $segments_var[0]=='users')
@include('layouts.app')
@else
@if($segments_var[1]=='previous')

@include('layouts.app')
@else

@if($segments_var[2]=='edit')

@if(in_array($segments_var[0],$array_menu) && in_array($segments_var[2],$array_menu))
@include('layouts.app')
@else
@include('errors.404')
@endif


@else


@if($segments_var!='' && $segments_var[1]!='')
@if(in_array($segments_var[0],$array_menu) && in_array($segments_var[1],$array_menu))
@include('layouts.app')
@else
@include('errors.404')
@endif
@else
@include('layouts.app')
@endif


@endif
@endif
@endif