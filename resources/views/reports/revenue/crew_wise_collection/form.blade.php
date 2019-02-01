<div class="row">
    <div class="col-md-3">
        @php $depots_value=displayList('depots','name')@endphp
        {!! Form::label('depot_id', Lang::get('Depot*'), ['class' => 'control-label']) !!}
        {!! Form::select('depot_id',$depots_value,isset($depot->depot_id) ? $depot->depot_id : selected,['class' => ' form-control','required' => 'required','placeholder'=>"Select Depot"]) !!}
    </div>

    <div class="col-md-3">
        {!! Form::label('from_date', Lang::get('From*'), ['class' => 'control-label','for'=>'from_date']) !!}
        <div class="input-group date form_datetime_backdate col-md-10" data-date="2019-01-01" data-date-format="d-m-Y H:i:s" data-link-field="from_date">
            {!! Form::text('from_date', date('d-m-Y H:i:s'), ['class' => 'form-control',''=>'']) !!}
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="from_date" value="" />
    </div> 
         
    <div class="col-md-3">
        {!! Form::label('to_date', Lang::get('To*'), ['class' => 'control-label','for'=>'to_date']) !!}
        <div class="input-group date form_datetime_backdate col-md-10" data-date="" data-date-format="d-m-Y H:i:s" data-link-field="to_date">
            {!! Form::text('to_date', date('d-m-Y H:i:s', time()+28800), ['class' => 'form-control',''=>'']) !!}
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="to_date" value="" />
    </div>

    <div class="col-md-3">
        {!! Form::label('conductor_id', Lang::get('Conductor ID'), ['class' => 'control-label']) !!}    
        {!! Form::text('conductor_id', null, ['class' => 'form-control']) !!}
    </div>

    <div class="col-md-3">
        <label>&nbsp;</label>
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
    </div>
</div>


