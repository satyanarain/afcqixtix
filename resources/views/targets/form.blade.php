@php $routes=displayList('routes','route')@endphp


<div class="form-group">
        {!! Form::label('route_id', Lang::get('Route'), ['class' => 'control-label required']) !!}
        {!! Form::select('route_id',$routes,isset($targets->route_id) ? $targets->route_id : selected,['class' => 'form-control','required' => 'required','onchange'=>'findDuty(this.value)','placeholder'=>"Select Route"]) !!}

</div>
@php $duties=displayList('duties','duty_number')@endphp
@if($targets->duty_id!='')
<div class="form-group">
        {!! Form::label('duty_id', Lang::get('Duty'), ['class' => 'control-label required']) !!}
          {!! Form::select('duty_id',$duties,isset($targets->duty_id) ? $targets->duty_id : selected,['class' => 'form-control','required' => 'required']) !!}

</div>
@else
<div class="form-group" id='duty' style="display:none;">
</div>
@endif
@php $shifts=displayList('shifts','shift')@endphp
<div class="form-group" id=''>
        {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'control-label required']) !!}
        {!! Form::select('shift_id',$shifts,isset($targets->shift_id) ? $targets->shift_id : selected,['class' => 'form-control','required' => 'required']) !!}

</div>

<div class="form-group">
        {!! Form::label('trip', Lang::get('Trip'), ['class' => 'control-label required']) !!}<br>
         {!! Form::text('trip', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
        {!! Form::label('epkm', Lang::get('EPKM'), ['class' => 'control-label required']) !!}<br>
         {!! Form::text('epkm', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
        {!! Form::label('income', Lang::get('Income'), ['class' => 'control-label required']) !!}<br>
         {!! Form::text('income', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
        {!! Form::label('incentive', Lang::get('Incentive'), ['class' => 'control-label']) !!}<br>
         {!! Form::text('incentive', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
        {!! Form::label('driver_share', Lang::get('Driver Share'), ['class' => 'control-label']) !!}<br>
         {!! Form::text('driver_share', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
        {!! Form::label('conductor_share', Lang::get('Conductor Share'), ['class' => 'control-label']) !!}<br>
         {!! Form::text('conductor_share', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
