@php $routes=displayList('routes','route')@endphp
<div class="form-group">
        {!! Form::label('route_id', Lang::get('Routes'), ['class' => 'control-label required']) !!}
        {!! Form::select('route_id',$routes,isset($duties->route_id) ? $duties->route_id : selected,['class' => 'form-control','required' => 'required']) !!}

</div>
<div class="form-group">
        {!! Form::label('duty_number', Lang::get('Duty Number'), ['class' => 'control-label required']) !!}
        {!! Form::text('duty_number', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
        {!! Form::label('description', Lang::get('Description'), ['class' => 'control-label required']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control','required' => 'required','rows'=>3]) !!}
</div>

<div class="form-group">
        {!! Form::label('start_time', Lang::get('Start Time'), ['class' => 'control-label required']) !!}<br>
         {!! Form::text('start_time', null, ['class' => 'form-control','required' => 'required']) !!}
</div>

@php $shifts=displayList('shifts','shift')@endphp
<div class="form-group">
        {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'control-label required']) !!}
        {!! Form::select('shift_id',$shifts,isset($duties->shift_id) ? $duties->shift_id : selected,['class' => 'form-control','required' => 'required']) !!}

</div>
<div class="form-group">
    {!! Form::label('order_number', Lang::get('Order Mumber'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', null, ['class' => 'form-control']) !!}
</div>
{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
