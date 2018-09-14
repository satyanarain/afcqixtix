<!--SELECT `id`, `name`, `depot_id`, `short_name`, `depot_location`, `default_service`, `created_at`, `updated_at` FROM `vehicles` WHERE 1-->
@php
    $segment = Request::segments();
    $depot_id = displayList('depots','name');
@endphp
@if($segment[4]==="edit")
    <div class="form-group">
        {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
            {!! Form::select('depot_id',$depot_id,isset($vehicles->depot_id) ? $vehicles->depot_id : selected,['class' => 'col-md-6 form-control', 'placeholder'=>'Select Depot']) !!}
        </div> 
    </div>
@endif


<div class="form-group">
    {!! Form::label('vehicle_registration_number', Lang::get('Vehicles Registration Number'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
        {!! Form::text('vehicle_registration_number', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
   
</div>
<div class="form-group">
    @php
    $bus_type_id=displayList('bus_types','bus_type')
    @endphp
    {!! Form::label('bus_type_id', Lang::get('Bus Type'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
        {!! Form::select('bus_type_id',$bus_type_id,isset($vehicles->bus_type_id) ? $vehicles->bus_type_id : selected,
        ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Bus Type','required' => 'required']) !!}
    </div> 
</div> 
<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required')) }}
    <div class="col-md-3" style="margin-right: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-left','onclick'=>'window.history.back();')) }}</div>
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div> 
