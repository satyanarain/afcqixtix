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
        @php $routes=displayList('route_master','route_name')@endphp
        {!! Form::label('route_id', Lang::get('Route'), ['class' => 'control-label']) !!}
        {!! Form::select('route_id', $routes, null, ['class' => 'form-control','placeholder'=>"All"]) !!}  
    </div>

    <div class="col-md-3">
        {!! Form::label('inspector_id', Lang::get('Inspector'), ['class' => 'control-label']) !!}
        {!! Form::select('inspector_id', $inspectors, null, ['class' => 'form-control','placeholder'=>"All"]) !!}  
    </div>

    <div class="col-md-3">
        <label>&nbsp;</label>
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
    </div>
</div>


