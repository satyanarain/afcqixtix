<div class="form-group ">
    {!! Form::label('depot_id', Lang::get('Select Depot'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
        @php $depots=displayList('depots','name');@endphp
        {!! Form::select('depot_id', $depots,isset($waybills->depot_id) ? $waybills->depot_id : selected,
        ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Depot','required' => 'required']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('abstract_no', Lang::get('Abstract No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('abstract_no', $unique_number, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
     <div class="" style="margin-right: 15px;">{{ Form::button('Fetch Details', array('class' => 'btn btn-success pull-left get_abstract_detail')) }}</div>
</div>

<div class="form-group ">
     {!! Form::label('route_duty', Lang::get('Route/Duty'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('route_duty', null, ['class' => 'col-md-6 form-control','readonly','required' => 'required']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('conductor_name', Lang::get('Conductor Name'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('conductor_name', null, ['class' => 'col-md-6 form-control','readonly']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('conductor_id', Lang::get('Conductor ID'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('conductor_id', null, ['class' => 'col-md-6 form-control','readonly']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('amount_payable', Lang::get('Amount Payable'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('amount_payable', null, ['class' => 'col-md-6 form-control','readonly','required' => 'required']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('cash_remitted', Lang::get('Cash Remitted'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('cash_remitted', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('cash_challan_no', Lang::get('Cash Challan No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('cash_challan_no', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required','disabled')) }}
    <div class="col-md-3" style="margin-right: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-left','onclick'=>'window.history.back();')) }}</div>
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div>