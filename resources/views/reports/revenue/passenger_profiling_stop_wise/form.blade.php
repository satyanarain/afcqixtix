<div class="row">         
    <div class="col-md-3">
        {!! Form::label('from_date', Lang::get('From*'), ['class' => 'control-label','for'=>'from_date']) !!}
        <div class="input-group date form_datetime col-md-10" data-date="2019-01-01" data-date-format="d-m-Y H:i:s" data-link-field="from_date">
            {!! Form::text('from_date', date('d-m-Y H:i:s'), ['class' => 'form-control',''=>'']) !!}
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="from_date" value="" />
    </div> 
         
    <div class="col-md-3">
        {!! Form::label('to_date', Lang::get('To*'), ['class' => 'control-label','for'=>'to_date']) !!}
        <div class="input-group date form_datetime col-md-10" data-date="" data-date-format="d-m-Y H:i:s" data-link-field="to_date">
            {!! Form::text('to_date', date('d-m-Y H:i:s', time()+28800), ['class' => 'form-control',''=>'']) !!}
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="to_date" value="" />
    </div>

    <div class="col-md-3">
        {!! Form::label('time_slot', Lang::get('Time Slot (in Min.)*'), ['class' => 'control-label']) !!}    
        {!! Form::text('time_slot', 30, ['class' => 'form-control', 'onkeypress'=>'return numvalidate()', 'maxlength'=>2]) !!}
    </div>

    <div class="col-md-3">
        @php $directions=['Up'=>'Up', 'Down'=>'Down'];@endphp
        {!! Form::label('direction', Lang::get('Direction*'), ['class' => 'control-label']) !!}
        {!! Form::select('direction', $directions, "up", ['class' => ' form-control']) !!}
    </div>

    <div class="col-md-3">
        @php $stops=displayList('stops','short_name')@endphp
        {!! Form::label('stop_id', Lang::get('Stop'), ['class' => 'control-label']) !!}
        {!! Form::select('stop_id',$stops, null, ['class' => ' form-control','placeholder'=>"All"]) !!}
    </div>

    <div class="col-md-3">
        <label>&nbsp;</label>
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
    </div>
</div>


