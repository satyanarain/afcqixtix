@extends('layouts.master')

@section('heading')
<ol class="breadcrumb">
    <li><a href="{{route('showdashboard', \Auth::id())}}">Home</a></li>
    <li class="current">Profiles</li>  
     <li class="current"><a href="{{ route('users.index')}}">User</a></li>
     <li class="current">Edit</li>  
</ol>

<div class="well well-sm">
 @lang('user.titles.edit')
 <div class="mondaory-field-new">     Fields marked (<span class="required"></span>) are mandatory</div>
</div>
@stop

@section('content')


{!! Form::model($user, [
        'method' => 'PATCH',
        'route' => ['users.update', $user->id],
        'files'=>true,
        'enctype' => 'multipart/form-data'
        ]) !!}

@include('users.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

{!! Form::close() !!}

@stop