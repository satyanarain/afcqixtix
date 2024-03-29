@extends('layouts.master')
@section('header')
<h1>Manage Roster</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{route('roasters.index')}}">Rosters</a></li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">Create New Roster</h3>
            </div>
        <?php $permission_status = checkPermission('roasters','create');
            if($permission_status){?>
          {!! Form::open([
                'route' => 'roasters.getfiltereddata',
                'class'=>'form-horizontal',
                ]) !!}
          <div class="box-body">
            <div class="col-xs-12">
                <div class="form-group ">
                    <div class="col-sm-4">
                        @php $depots=displayList('depots','name');@endphp
                        {!! Form::label('depot_id', Lang::get('Depot*'), ['class' => 'control-label']) !!}
                        {!! Form::select('depot_id', $depots,null,
                        ['id'=>'depot_id','data-column'=>0,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Depot','required'=>'required']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('from_date', Lang::get('From'), ['class' => 'control-label']) !!}
                        {!! Form::text('from_date', null, ['class' => 'form-control multiple_date']) !!}
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('to_date', Lang::get('To'), ['class' => 'control-label']) !!}
                        {!! Form::text('to_date', null, ['class' => 'form-control multiple_date']) !!}
                    </div>
                    <div class="col-sm-4">
                        @php $shifts=displayList('shifts','shift');@endphp
                        {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'control-label']) !!}
                        {!! Form::select('shift_id', $shifts,null,
                        ['id'=>'shift_id','data-column'=>0,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Shift']) !!}
                    </div>
                    <div class="col-sm-4" style="margin-top: 28px;">
                        {!! Form::label('', Lang::get(''), ['class' => 'control-label']) !!}
                        {!! Form::submit('View Roster');!!}
                    </div>

                </div>
            </div>
          </div>
          {{ Form::close() }}
        <?php }?>
          <div class="box-body"></div>
            <!-- /.box-header -->

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
