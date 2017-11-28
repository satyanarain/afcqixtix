@extends('layouts.master')
@section('heading')
<ol class="breadcrumb">
    <li><a href="{{route('showdashboard', \Auth::id())}}">Home</a></li>
    <li class="current">Profiles</li>  
    <li class="current"><a href="{{ route('users.index')}}">User</a></li>
    <li class="current">Create</li>  
</ol>
<div class="well well-sm">
    @lang('user.titles.create')<br/> <div class="mondaory-field-new">     Fields marked (<span class="required"></span>) are mandatory</div>
</div>
@stop

@section('content')
{!! Form::open([
        'route' => 'users.store',
        'files'=>true,
        'enctype' => 'multipart/form-data'

        ]) !!}
@include('users.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

{!! Form::close() !!}

@stop