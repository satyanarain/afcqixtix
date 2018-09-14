<div class="form-group">
    @php $concession_provider_masters=displayList('concession_provider_masters','name')@endphp
    {!! Form::label('concession_provider_master_id', Lang::get('Concession Provider'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
  {!! Form::select('concession_provider_master_id',$concession_provider_masters, isset($concessions->concession_provider_master_id) ? $concessions->concession_provider_master_id :selected,['class' => 'col-md-6 form-control','placeholder'=>'Select Concession','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('concession_master_id', Lang::get('Concession'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
  {!! Form::text('concession_master_id',null, ['class' => 'col-md-6 form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
         {!! Form::label('description', Lang::get('Description'), ['class' => 'col-md-3 control-label']) !!}
          <div class="col-md-7 col-sm-12 required">
         {!! Form::text('description', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>

    <div class="form-group">
    @if($concessions->order_number!='')
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
      <div class="col-md-7 col-sm-12 required">
    {!! Form::text('order_number',null, ['class' => 'col-md-6 form-control','readonly'=>readonly]) !!}
     </div>
     @else
    @php $concessions_order= maxId1('concessions','order_number','service_id',$service_id) @endphp
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
      <div class="col-md-7 col-sm-12 required">
    {!! Form::text('order_number', $concessions_order, ['class' => 'col-md-6 form-control','readonly'=>readonly]) !!}
     </div>
  @endif
 </div>

<div class="form-group">
        {!! Form::label('percentage', Lang::get('Percentage'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
         {!! Form::number('percentage', null, ['class' => 'col-md-6 form-control','required' => 'required','onkeypress'=>'return isIntegerKey(event)']) !!}
</div>
</div>
<div class="form-group">
     @php $pass_type_masters=displayList('pass_types','pass_type_master_id')@endphp
      {!! Form::label('pass_type_master_id', Lang::get('Pass Type'), ['class' => 'col-md-3 control-label']) !!}
      <div class="col-md-7 col-sm-12">
         {!! Form::select('pass_type_master_id',$pass_type_masters, isset($concessions->pass_type_master_id) ? $concessions->pass_type_master_id :selected,['class' => 'col-md-6 form-control','placeholder'=>'Select Pass Type']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('print_ticket', Lang::get('Print Ticket'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
    <input type="checkbox" name="print_ticket" value="Yes" <?php if($concessions->print_ticket=='Yes') { ?>checked="checked"<?php } ?>>
</div>
</div>
<div class="form-group">
      @php $etm_hot_key_master_id=displayList('etm_hot_key_masters','name')@endphp
    {!! Form::label('etm_hot_key_master_id', Lang::get('ETM Hot Key'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
      {!! Form::select('etm_hot_key_master_id',$etm_hot_key_master_id, isset($concessions->etm_hot_key_master_id) ? $concessions->etm_hot_key_master_id :selected,['class' => 'col-md-6 form-control','placeholder'=>'Select ETM Hot key']) !!}
</div>
</div>

 @php 
 if($concession->concession_allowed_on!='')
 {
 $concession_allowed_on = date('d-m-Y', strtotime($concession->concession_allowed_on));
 }
 @endphp
<div class="form-group">
    
    {!! Form::label('concession_allowed_on', Lang::get('Concession Allowed on(for all days of the year leave field blank)'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('concession_allowed_on', $concession_allowed_on, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
      </div>
    <!-- /.input group -->
</div>
<div class="form-group">
      {!! Form::label('flat_fare', Lang::get('Flat Fare'), ['class' => 'col-md-3 control-label']) !!}
      <div class="col-md-7 col-sm-12">
      <input type="radio" name="flat_fare" value="Yes" <?php if($concessions->flat_fare=="Yes") { ?>checked  <?php } ?>  > Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="flat_fare" value="No"  <?php if($concessions->flat_fare=="No") { ?>checked  <?php } ?>  > No
</div>
</div>
<div class="form-group">
      {!! Form::label('flat_fare_amount', Lang::get('Flat Fare Amount'), ['class' => 'col-md-3 control-label']) !!}
      <div class="col-md-7 col-sm-12 required">
      {!! Form::text('flat_fare_amount', null, ['class' => 'col-md-6 form-control','onkeypress'=>'return isNumberKey(event)']) !!}
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
