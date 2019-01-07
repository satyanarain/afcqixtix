<div class="row">
    <div class="col-md-3">
        @php $depots_value=displayList('depots','name')@endphp
        {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'control-label']) !!}
        {!! Form::select('depot_id',$depots_value,isset($depot->depot_id) ? $depot->depot_id : selected,['class' => ' form-control','required' => 'required','placeholder'=>"Select Depot"]) !!}
    </div>
    <div class="col-md-3">
        {!! Form::label('date', Lang::get('Till Date'), ['class' => 'control-label']) !!}    
        {!! Form::text('date', date('d-m-Y'), ['class' => 'multiple_date','readonly' => 'readonly', 'placeholder'=>'DD-MM-YY']) !!}
    </div>

    <div class="col-md-3">
        @php $etms=displayList('etm_details','etm_no')@endphp
        {!! Form::label('etm_no', Lang::get('ETM No.'), ['class' => 'control-label']) !!}    
        {!! Form::select('etm_no', $etms, null, ['class' => 'form-control', 'placeholder'=>'All']) !!}
    </div>

    <div class="col-md-3">
        <label>&nbsp;</label>
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
    </div>
</div>


