@extends('layouts.master')
@section('header')
<h1>Role and Permission Management {{--headingBold()--}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
<script>
   function Validate()
   {
   $(".myCheckBoxClass:checked").length;
   var checked = $("#ceckboxes_checked :checkbox:checked").length;
    if(checked==0)
    {
     alert("Please add permission")
     return false
    } 
    
   }
 </script>   
<div class="col-md-12">
    <div class="callout callout-info">
        Create Role
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <h3 class="box-title">
                </h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body" id="ceckboxes_checked">
                {!! Form::open([
                'route' => 'permissions.store',
                'files'=>true,
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'enctype' => 'multipart/form-data',
                'id' => 'form1','onsubmit' => 'return Validate()']) !!}
                @include('permissions.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])
            {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

