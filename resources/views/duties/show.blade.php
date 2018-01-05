@extends('layouts.master')
@section('header')
<h1>{{--headingBold()--}}
Duty Management
</h1>
{{BreadCrumb()}}
@stop
@section('content')
@include('partials.dutiesheader')
@stop
  