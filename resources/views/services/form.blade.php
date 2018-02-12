<div class="form-group">
    @php
    $bus_type_id=displayList('bus_types','bus_type')
    @endphp
    {!! Form::label('bus_type_id', Lang::get('Bus Type'), ['class' => 'control-label required']) !!}
    {!! Form::select('bus_type_id',$bus_type_id,isset($services->bus_type_id) ? $services->bus_type_id : selected,
    ['class' => 'form-control', 'placeholder'=>'Select Bus Type','required' => 'required']) !!}
</div> 
<div class="form-group">
        {!! Form::label('name', Lang::get('Service Name'), ['class' => 'control-label required']) !!}
        {!! Form::text('name', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('short_name', Lang::get('Short Name'), ['class' => 'control-label required']) !!}
    {!! Form::text('short_name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <div class="form-group">
    @if($services->order_number!='')
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number',null, ['class' => 'form-control','readonly'=>readonly]) !!}
     @else
    @php $services_value= maxId('services','order_number') @endphp
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', $services_value, ['class' => 'form-control','readonly'=>readonly]) !!}
  @endif
    </div>
</div>
 {!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
