<div class="form-group ">
     {!! Form::label('date', Lang::get('Departure Date'), ['class' => 'col-md-3 control-label','for'=>'dtp_input1']) !!}
    <div class="col-md-7 col-sm-12">
        {!! Form::text('date', $waybills->date, ['class' => 'form-control','readonly'=>'readonly','disabled']) !!}
    </div>
</div> 
<div class="form-group ">
    {!! Form::label('depot_id', Lang::get('Select Depot'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
        @php $depots=displayList('depots','name');@endphp
        {!! Form::select('depot_id', $depots,isset($waybills->depot_id) ? $waybills->depot_id : selected,
        ['class' => 'col-md-6 form-control', 'disabled']) !!}
    </div>

</div> 
<div class="form-group ">
    {!! Form::label('vehicle_id', Lang::get('Vehicle'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
    {!! Form::select('vehicle_id', $vehicles,null,
        ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>

</div> 
<div class="form-group ">
    {!! Form::label('route_id', Lang::get('Route'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
        @php $routes=displayList('route_master','route_name');@endphp
       {!! Form::select('route_id', $routes,isset($waybills->route_id) ? $waybills->route_id : selected,
        ['class' => 'col-md-6 form-control', 'disabled']) !!}
    </div>

</div> 
<div class="form-group ">
    {!! Form::label('duty_id', Lang::get('Duty'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
    {!! Form::select('duty_id', $duties,null,
        ['class' => 'col-md-6 form-control', 'disabled']) !!}
    </div>

</div>
<div class="form-group ">
    {!! Form::label('bus_type_id', Lang::get('Bus Type'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
        @php $routes=displayList('bus_types','bus_type');@endphp
       {!! Form::select('bus_type_id', $routes,isset($waybills->route_id) ? $waybills->route_id : selected,
        ['class' => 'col-md-6 form-control', 'disabled']) !!}
    </div>

</div> 
<div class="form-group ">
    {!! Form::label('service_id', Lang::get('Service'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
    {!! Form::select('service_id', $services,null,
        ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>

</div> 
<div class="form-group ">
    {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
        @php $shifts=displayList('shifts','shift');@endphp
       {!! Form::select('shift_id', $shifts,isset($waybills->shift_id) ? $waybills->shift_id : selected,
        ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>

</div>
<div class="form-group ">
     {!! Form::label('driver', Lang::get('Driver'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('driver', null, ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>
</div>
 
<div class="form-group ">
     {!! Form::label('conductor', Lang::get('Conductor'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('conductor', null, ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('bag_no', Lang::get('Bag No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('bag_no', null, ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('waybill_no', Lang::get('Waybill No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('waybill_no', null, ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>
</div> 

<div class="form-group ">
     {!! Form::label('etm_no', Lang::get('ETM No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('etm_no', null, ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>
</div>

<div class="form-group ">
     {!! Form::label('abstract_no', Lang::get('Abstract No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('abstract_no', $unique_number, ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>
</div>

<div class="form-group ">
     {!! Form::label('paper_roll_issued', Lang::get('Paper Roll Issued'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('paper_roll_issued', null, ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('paper_roll_received', Lang::get('Paper Roll Received'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('paper_roll_received', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('portable_ups_issued', Lang::get('Portable UPS Issued'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('portable_ups_issued', null, ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('portable_ups_received', Lang::get('Portable UPS Received'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('portable_ups_received', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('etm_issue_time', Lang::get('ETM Issued Date and Time'), ['class' => 'col-md-3 control-label','for'=>'etm_issue_time']) !!}
    <div class="col-md-7 col-sm-12">
        {!! Form::text('etm_issue_time', date('Y-m-d'), ['class' => 'form-control','disabled']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('etm_receive_time', Lang::get('ETM Received Date and Time'), ['class' => 'col-md-3 control-label','for'=>'etm_receive_time']) !!}
    <div class="col-md-9 col-sm-12">
        <div class="input-group date form_datetime col-md-10" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="etm_receive_time">
        {!! Form::text('etm_receive_time', date('Y-m-d'), ['class' => 'form-control','readonly'=>'readonly']) !!}
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="etm_receive_time" value="" />
        <input type="hidden" readonly="readonly" id="status" name="status" value="s" />
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('remarks', Lang::get('Remarks'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::textarea('remarks', null, ['class' => 'col-md-6 form-control','rows'=>'3','disabled']) !!}
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