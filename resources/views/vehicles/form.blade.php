<!--SELECT `id`, `name`, `depot_id`, `short_name`, `depot_location`, `default_service`, `created_at`, `updated_at` FROM `vehicles` WHERE 1-->
<div class="form-group">
    @php
    $depot_id=displayList('depots','name')
    @endphp
    {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'control-label required']) !!}
    {!! Form::select('depot_id',$depot_id,isset($vehicles->depot_id) ? $vehicles->depot_id : selected,
    ['class' => 'form-control', 'placeholder'=>'Select Depot','required' => 'required']) !!}
</div> 
<div class="form-group">
        {!! Form::label('vehicle_registration_number', Lang::get('Vehicles Registration Number'), ['class' => 'control-label required']) !!}
        {!! Form::text('vehicle_registration_number', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    @php
    $bus_type_id=displayList('bus_types','bus_type')
    @endphp
    {!! Form::label('bus_type_id', Lang::get('Bus Type'), ['class' => 'control-label required']) !!}
    {!! Form::select('bus_type_id',$bus_type_id,isset($vehicles->bus_type_id) ? $vehicles->bus_type_id : selected,
    ['class' => 'form-control', 'placeholder'=>'Select Bus Type','required' => 'required']) !!}
</div> 
 {!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
