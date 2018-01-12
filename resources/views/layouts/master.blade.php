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

//print_r($array_menu);

//print_r($segments_var);

$result = array_intersect($segments_var, $array_menu);
 count($result);

/*
 if(count(array_intersect($segments_var, $array_menu))==count($segments_var))
{  
    echo "blade" ;
     
} else {
 echo "error" ;
}
*/

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