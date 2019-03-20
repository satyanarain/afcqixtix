<div class="row">
    <div class="col-md-3">
        @php $depots_value=displayList('depots','name')@endphp
        {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'control-label']) !!}<span class="label-required">*</span>
        {!! Form::select('depot_id',$depots_value,isset($depot->depot_id) ? $depot->depot_id : selected,['class' => ' form-control','placeholder'=>"Select Depot"]) !!}
    </div>

    <div class="col-md-3">
        {!! Form::label('from_date', Lang::get('From'), ['class' => 'control-label']) !!}<span class="label-required">*</span>    
        {!! Form::text('from_date', date('d-m-Y'), ['class' => 'multiple_date','readonly' => 'readonly', 'placeholder'=>'DD-MM-YY']) !!}
    </div>

    <div class="col-md-3">
        {!! Form::label('to_date', Lang::get('To'), ['class' => 'control-label']) !!}<span class="label-required">*</span>    
        {!! Form::text('to_date', date('d-m-Y'), ['class' => 'multiple_date','readonly' => 'readonly', 'placeholder'=>'DD-MM-YY']) !!}
    </div>

    <div class="col-md-3">
        @php $routes = displayList('route_master','route_name');@endphp
        {!! Form::label('route_id', Lang::get('Route'), ['class' => 'control-label']) !!}<span class="label-required">*</span>    
        {!! Form::select('route_id', $routes, null, ['class' => 'form-control', 'placeholder'=>'Select Route']) !!}
    </div>

    <div class="col-md-3">
        @php $duties = displayList('duties','duty_number');@endphp
        {!! Form::label('duty_id', Lang::get('Duty'), ['class' => 'control-label']) !!}<span class="label-required">*</span>    
        {!! Form::select('duty_id', $duties, null, ['class' => 'form-control', 'placeholder'=>'Select Duty']) !!}
    </div>


    <div class="col-md-3">
        {!! Form::label('conductor_id', Lang::get('Conductor'), ['class' => 'control-label']) !!}<span class="label-required">*</span>    
        {!! Form::select('conductor_id', [], null, ['class' => 'form-control', 'placeholder'=>'Select Conductor']) !!}
    </div>

    <div class="col-md-3">
        <label>&nbsp;</label>
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
    </div>
</div>


