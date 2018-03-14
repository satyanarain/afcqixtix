@php $routes=displayList('routes','route')@endphp
<div class="form-group">
        {!! Form::label('route_id', Lang::get('Route'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::select('route_id',$routes,isset($targets->route_id) ? $targets->route_id : selected,['class' => 'col-md-6 form-control','required' => 'required','onchange'=>'findDuty(this.value)','placeholder'=>"Select Route"]) !!}

</div>
</div>
@php $duties=displayList('duties','duty_number')@endphp
@if($targets->duty_id!='')
<div class="form-group">
        {!! Form::label('duty_id', Lang::get('Duty'), ['class' => 'col-md-3 control-label']) !!}
           <div class="col-md-7 col-sm-12 required">
        {!! Form::select('duty_id',$duties,isset($targets->duty_id) ? $targets->duty_id : selected,['class' => 'col-md-6 form-control','required' => 'required']) !!}

</div>
</div>
@else
<span  id='duty' style="display:none;">
</span>
@endif
@php $shifts=displayList('shifts','shift')@endphp
<div class="form-group" id=''>
        {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
        {!! Form::select('shift_id',$shifts,isset($targets->shift_id) ? $targets->shift_id : selected,['class' => 'col-md-6 form-control','required' => 'required']) !!}

</div>
</div>

<div class="form-group">
        {!! Form::label('trip', Lang::get('Trip'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
         {!! Form::text('trip', null, ['class' => 'col-md-6 form-control','required' => 'required', onkeypress=>'return isIntegerKey(event)']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('epkm', Lang::get('EPKM'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
         {!! Form::text('epkm', null, ['class' => 'col-md-6 form-control','required' => 'required', onkeypress=>'return isNumberKey(event)']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('income', Lang::get('Income'), ['class' => 'col-md-3 control-label']) !!}
      <div class="col-md-7 col-sm-12 required">
         {!! Form::text('income', null, ['class' => 'col-md-6 form-control','required' => 'required',onkeypress=>'return isNumberKey(event)']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('incentive', Lang::get('Incentive'), ['class' => 'col-md-3 control-label']) !!}
          <div class="col-md-7 col-sm-12">
         {!! Form::text('incentive', null, ['class' => 'col-md-6 form-control']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('driver_share', Lang::get('Driver Share'), ['class' => 'col-md-3 control-label']) !!}
          <div class="col-md-7 col-sm-12">
         {!! Form::text('driver_share', null, ['class' => 'col-md-6 form-control',onkeypress=>'return isNumberKey(event)']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('conductor_share', Lang::get('Conductor Share'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12">
         {!! Form::text('conductor_share', null, ['class' => 'col-md-6 form-control',onkeypress=>'return isNumberKey(event)']) !!}
</div>
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