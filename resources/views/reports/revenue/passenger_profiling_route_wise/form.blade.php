<div class="row">         
    <div class="col-md-3">
        {!! Form::label('from_date', Lang::get('From'), ['class' => 'control-label','for'=>'from_date']) !!}<span class="label-required">*</span>
        <div class="input-group date form_datetime_backdate col-md-10" data-date="2019-01-01" data-date-format="d-m-Y H:i:s" data-link-field="from_date">
            {!! Form::text('from_date', date('d-m-Y H:i:s'), ['class' => 'form-control',''=>'']) !!}
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="from_date" value="" />
    </div> 
         
    <div class="col-md-3">
        {!! Form::label('to_date', Lang::get('To'), ['class' => 'control-label','for'=>'to_date']) !!}<span class="label-required">*</span>
        <div class="input-group date form_datetime_backdate col-md-10" data-date="" data-date-format="d-m-Y H:i:s" data-link-field="to_date">
            {!! Form::text('to_date', date('d-m-Y H:i:s', time()+28800), ['class' => 'form-control',''=>'']) !!}
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="to_date" value="" />
    </div>

    <div class="col-md-3">
        {!! Form::label('time_slot', Lang::get('Time Slot (in Min.)'), ['class' => 'control-label']) !!}<span class="label-required">*</span>    
        {!! Form::text('time_slot', 30, ['class' => 'form-control', 'onkeypress'=>'return numvalidate()', 'maxlength'=>2]) !!}
    </div>

    <div class="col-md-3">
        @php $directions=['Up'=>'Up', 'Down'=>'Down'];@endphp
        {!! Form::label('direction', Lang::get('Direction'), ['class' => 'control-label']) !!}<span class="label-required">*</span>
        {!! Form::select('direction', $directions, "up", ['class' => ' form-control']) !!}
    </div>

    <div class="col-md-3">
        @php $routes=displayList('route_master','route_name')@endphp
        {!! Form::label('route_id', Lang::get('Route'), ['class' => 'control-label']) !!}<span class="label-required">*</span>
        {!! Form::select('route_id',$routes, null, ['class' => ' form-control']) !!}
    </div>

    <div class="col-md-3">
        <label>&nbsp;</label>
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
    </div>
</div>


