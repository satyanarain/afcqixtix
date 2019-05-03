<div class="row">
    <div class="col-md-3">
        @php $depots_value=displayList('depots','name')@endphp
        {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'control-label']) !!}<span class="label-required">*</span>
        {!! Form::select('depot_id',$depots_value,isset($depot->depot_id) ? $depot->depot_id : selected,['class' => ' form-control','placeholder'=>"Select Depot"]) !!}
    </div>

    <div class="col-md-3">
        {!! Form::label('date', Lang::get('Date'), ['class' => 'control-label','for'=>'date']) !!}<span class="label-required">*</span>
        {!! Form::text('date', date('d-m-Y'), ['class' => 'form_date form-control']) !!}
    </div> 

    <div class="col-md-3">
        @php $shifts = displayList('shifts','shift'); @endphp
        {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'control-label']) !!}    
        {!! Form::select('shift_id', $shifts, null, ['class' => 'form-control', 'placeholder'=>'All']) !!}
    </div>

    <div class="col-md-3">
        <label>&nbsp;</label>
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
    </div>
</div>


