<!--SELECT `id`, `name`, `depot_id`, `short_name`, `depot_location`, `default_service`, `created_at`, `updated_at` FROM `services` WHERE 1-->
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
    {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', null, ['class' => 'form-control']) !!}
</div>
 {!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
