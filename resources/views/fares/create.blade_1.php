@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')

<section class="content">
          <!-- Notifications -->
          <div class="row">
                      <div class="col-md-12">
                      <div class="callout callout-info">
                         {{headingMain()}}
                      </div>
                  </div>
              </div>


          <!-- Content -->
            <div id="webui">
          
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-default">
            <div class="box-header with-border">
            <h3 class="box-title">
                        </h3>
                          <div class="box-tools pull-right">
                        <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                    </div>
             </div><!-- /.box-header -->

            <div class="box-body">
           <form id="create-form" class="form-horizontal" method="post" action="https://demo.snipeitapp.com/hardware" autocomplete="off" role="form" enctype="multipart/form-data">

  
  <!-- Warranty -->
<div class="form-group ">
    
       {!! Form::label('service_id', Lang::get('Service'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        <div class="input-group col-md-3" style="padding-left: 0px;">
              {!! Form::select('service_id',$services,isset($fares->service_id) ? $fares->service_id : selected,['class' => 'form-control','required' => 'required','onchange'=>'findDuty(this.value)','placeholder'=>"Select Service"]) !!}
     
            <span class="input-group-addon">月数</span>
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
            
        </div>
    </div>
</div>  
 
  <div class="form-group ">
    <label for="status_id" class="col-md-3 control-label">test2</label>
    <div class="col-md-7 col-sm-12 required">
        <select class="select2 status_id" style="width:100%" id="status_select_id" name="status_id"><option value="" selected="selected">选择状态</option><option value="1">Ready to Deploy</option><option value="9">1122.3333.40</option><option value="8">In solution</option><option value="7">Lost/Stolen</option><option value="6">Broken - Not Fixable 5+5555</option><option value="5">Out for Repair</option><option value="4">Out for Diagnostics</option><option value="3">Archived</option><option value="2">Pending</option><option value="10">xxx</option></select>
        
    </div>
</div>

<div class="form-group ">
    <label for="notes" class="col-md-3 control-label">test123</label>
    <div class="col-md-7 col-sm-12">
        <input class="col-md-6 form-control" id="notes" name="notes">
        
    </div>
</div>
</div>
</div>
</div>
</div>

</section>



<div class="row">
    <div class="col-xs-12">
   
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{headingMain()}}</h3>
              <a href="{{ route('fares.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>
           </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'fares.store',
                'files'=>true,
                'enctype' => 'multipart/form-data'
                 ]) !!}
                @include('fares.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

