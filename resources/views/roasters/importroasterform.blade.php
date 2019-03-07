@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">Create New Roasters</h3>
            </div>
        <?php $permission_status = checkPermission('roasters','create');
            if($permission_status){?>
          {!! Form::open([
                'route' => 'roasters.generateRoasterTemplate',
                'class'=>'form-horizontal',
                 'method' => 'post',
                 'enctype'=>'multipart/form-data'
                ]) !!}
          <div class="box-body">
            <div class="col-xs-12">
                <div class="form-group ">
                    
                    <div class="col-md-3">
                        {!! Form::label('from_date', Lang::get('From*'), ['class' => 'control-label']) !!}
                        {!! Form::text('from_date', '', ['class' => 'form-control multiple_date1','required' => 'required']) !!}
                    </div>
                    <input type="hidden" readonly="readonly" name="form_name" value="download_template">
                    <div class="col-md-3">
                        {!! Form::label('to_date', Lang::get('To*'), ['class' => 'control-label']) !!}
                        {!! Form::text('to_date', '', ['class' => 'form-control multiple_date1','required' => 'required']) !!}
                    </div>
                    <div class="col-sm-3" style="margin-top: 28px;">
                        {!! Form::label('', Lang::get(''), ['class' => 'control-label']) !!}
                        {!! Form::submit('Download Template');!!}
                    </div>
                </div>
            </div>
          </div>
          {{ Form::close() }}
          {!! Form::open([
                'route' => 'roasters.generateRoasterTemplate',
                'class'=>'form-horizontal',
                 'method' => 'post',
                 'enctype'=>'multipart/form-data'
                ]) !!}
          
                <div class="box-body">
                    <?php 
                    if($error){?>
                    <div class="col-xs-12"><div class="col-sm-12 no-padding"><?=$error?></div></div>
            <?php   }
                    ?>
                  <div class="col-xs-12">
                      <div class="form-group ">
                          <div class="col-sm-3">
                            @php $depots=displayList('depots','name');@endphp
                            {!! Form::label('depot_id', Lang::get('Depot*'), ['class' => 'control-label']) !!}
                            {!! Form::select('depot_id', $depots,null,
                            ['id'=>'depot_id','data-column'=>0,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Depot','required' => 'required']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('roaster_template', Lang::get('Roaster Excel*'), ['class' => 'control-label']) !!}
                            {!! Form::file('roaster_template',['class' => 'form-control','required' => 'required']) !!}
                        </div>
                        <input type="hidden" readonly="readonly" name="form_name" value="upload_template">
                        <div class="col-sm-3" style="margin-top: 28px;">
                            {!! Form::label('', Lang::get(''), ['class' => 'control-label']) !!}
                            {!! Form::submit('Upload Roaster');!!}
                        </div>
                      </div>
                  </div>
                </div>
          {{ Form::close() }}
        <?php }?>
          
                
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
<div class="modal fade" id="view_detail" role="dialog"></div>
@stop
@push('scripts')
<script type="text/javascript" language="javascript" >
$(document).ready(function() {
    var token = window.Laravel.csrfToken;
    //alert(token);
    //var dat = $("#filter-waybill").serialize();
    //alert(dat);
    
    
    
});
</script>
@endpush