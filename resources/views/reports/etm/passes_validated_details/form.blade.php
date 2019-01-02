<div class="row">
    <div class="col-md-3">
        @php $depots_value=displayList('depots','name')@endphp
        {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'control-label']) !!}
        {!! Form::select('depot_id',$depots_value,isset($depot->depot_id) ? $depot->depot_id : selected,['class' => ' form-control','required' => 'required','placeholder'=>"Select Depot"]) !!}
    </div>
    <div class="col-md-3">
        {!! Form::label('from_date', Lang::get('From Date'), ['class' => 'control-label']) !!}    
        {!! Form::text('from_date', null, ['class' => 'multiple_date','readonly' => 'readonly', 'placeholder'=>'DD-MM-YY']) !!}
    </div>

    <div class="col-md-3">
        {!! Form::label('to_date', Lang::get('To Date'), ['class' => 'control-label']) !!}    
        {!! Form::text('to_date', null, ['class' => 'multiple_date','readonly' => 'readonly', 'placeholder'=>'DD-MM-YY']) !!}
    </div>

    <!-- <div class="col-md-3">
        @php $routes=displayList('route_master','route_name')@endphp
        {!! Form::label('route_id', Lang::get('Route'), ['class' => 'control-label']) !!}
        {!! Form::select('route_id', $routes, null, ['class' => 'form-control','placeholder'=>"All"]) !!}  
    </div> -->

    <!-- <div class="col-md-3">
        @php $duties=displayList('duties','duty_number')@endphp
        {!! Form::label('duty_id', Lang::get('Duty'), ['class' => 'control-label']) !!}
        {!! Form::select('duty_id', $duties, null, ['class' => 'form-control','placeholder'=>"All"]) !!}  
    </div> -->

    <!-- <div class="col-md-3">
        @php $shifts=displayList('shifts','shift')@endphp
        {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'control-label']) !!}
        {!! Form::select('shift_id', $shifts, null, ['class' => 'form-control','placeholder'=>"All"]) !!}  
    </div> -->

    <!-- <div class="col-md-3">
        @php $inspectors=displayList('crew','crew_name')@endphp
        {!! Form::label('inspector_id', Lang::get('Inspector'), ['class' => 'control-label']) !!}
        {!! Form::select('inspector_id', $inspectors, null, ['class' => 'form-control','placeholder'=>"All"]) !!}  
    </div> -->

    <div class="col-md-3">
        <label>&nbsp;</label>
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
    </div>
</div>

