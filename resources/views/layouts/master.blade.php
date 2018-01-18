<?php
$segments_var = '';
$segments_var = Request::segments();

$segments_var[0];
$segments_var[1];
$testerere= Config::get('app.locales');
$testerere[0];
App::setLocale($testerere[0]);
$dem_menu= pagePermissionView($result);
$array_menu= explode(',', $dem_menu);
if($segments_var[2]=='edit')
{
  unset($segments_var[1]); 
  
}

?>
@if($segments_var!='' && $segments_var[1]!='')
@if(count(array_intersect($segments_var, $array_menu))==count($segments_var))
@include('layouts.app')
@else
@include('errors.404')
@endif
@else
@include('layouts.app')
@endif