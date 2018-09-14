@php 
    $segment = Request::segments();
    $routes=displayList('route_master','route_name')
@endphp
@if($segment[4]==="edit")
<div class="form-group">
        {!! Form::label('route_id', Lang::get('Route'), ['class' => 'col-md-3 control-label']) !!}
             <div class="col-md-7 col-sm-12 required">
        {!! Form::select('route_id',$routes,isset($duties->route_id) ? $duties->route_id : selected,['class' => 'col-md-6 form-control','required' => 'required']) !!}

</div>
</div>
@endif
<div class="form-group">
        {!! Form::label('duty_number', Lang::get('Duty Number'), ['class' => 'col-md-3 control-label']) !!}
             <div class="col-md-7 col-sm-12 required">
        {!! Form::text('duty_number', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('description', Lang::get('Description'), ['class' => 'col-md-3 control-label']) !!}
             <div class="col-md-7 col-sm-12 required">
        {!! Form::textarea('description', null, ['class' => 'col-md-6 form-control','required' => 'required','rows'=>3]) !!}
</div>
</div>

<div class="form-group">
        {!! Form::label('start_time', Lang::get('Start Time'), ['class' => 'col-md-3 control-label']) !!}
             <div class="col-md-7 col-sm-12 required">
         {!! Form::text('start_time', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('end_time', Lang::get('End Time'), ['class' => 'col-md-3 control-label']) !!}
             <div class="col-md-7 col-sm-12 required">
         {!! Form::text('end_time', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>

@php $shifts=displayList('shifts','shift')@endphp
<div class="form-group">
        {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'col-md-3 control-label']) !!}
             <div class="col-md-7 col-sm-12 required">
        {!! Form::select('shift_id',$shifts,isset($duties->shift_id) ? $duties->shift_id : selected,['class' => 'col-md-6 form-control','required' => 'required']) !!}

</div>
</div>
<div class="form-group">
   @if($duties->order_number!='')
        {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('order_number', null, ['class' => 'col-md-6 form-control','readonly' => 'readonly']) !!}
        </div>
         @else
         @php $duties_value= maxId1('duties','order_number','route_id',$route_master_id) @endphp
         {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('order_number', $duties_value, ['class' => 'col-md-6 form-control','readonly' => 'readonly',]) !!}
        </div>
         @endif
</div>

<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required')) }}
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div> 