@php $services=displayList('services','name')@endphp
<div class="form-group">
        {!! Form::label('service_id', Lang::get('Service'), ['class' => 'control-label required']) !!}
        {!! Form::select('service_id',$services,isset($concessions->service_id) ? $concessions->service_id : selected,['class' => 'form-control','required' => 'required','placeholder'=>"Select Service"]) !!}
</div>

<div class="form-group">
    @php $concession_provider_masters=displayList('concession_provider_masters','name')@endphp
    {!! Form::label('concession_provider_master_id', Lang::get('Concession Provider'), ['class' => 'control-label required']) !!}
  {!! Form::select('concession_provider_master_id',$concession_provider_masters, isset($concessions->concession_provider_master_id) ? $concessions->concession_provider_master_id :selected,['class' => 'form-control','placeholder'=>'Select Concession','required'=>'required']) !!}
</div>
<div class="form-group">
    @php $concession_masters=displayList('concession_masters','name')@endphp
    {!! Form::label('concession_master_id', Lang::get('Concession'), ['class' => 'control-label required']) !!}
  {!! Form::select('concession_master_id',$concession_masters, isset($concessions->concession_master_id) ? $concessions->concession_master_id :selected,['class' => 'form-control','placeholder'=>'Select Concession','required'=>'required']) !!}
</div>
<div class="form-group">
         {!! Form::label('description', Lang::get('Description'), ['class' => 'control-label required']) !!}
         {!! Form::text('description', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    <div class="form-group">
    @if($concessions->order_number!='')
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number',null, ['class' => 'form-control','readonly'=>readonly]) !!}
     @else
    @php $concessions_order= maxId('concessions','order_number') @endphp
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', $concessions_order, ['class' => 'form-control','readonly'=>readonly]) !!}
  @endif
 </div>
 </div>
<div class="form-group">
        {!! Form::label('percentage', Lang::get('Percentage'), ['class' => 'control-label required']) !!}<br>
         {!! Form::number('percentage', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
     @php $pass_type_masters=displayList('pass_type_masters','name')@endphp
      {!! Form::label('pass_type_master_id', Lang::get('Pass Type'), ['class' => 'control-label']) !!}<br>
         {!! Form::select('pass_type_master_id',$pass_type_masters, isset($concessions->pass_type_master_id) ? $concessions->pass_type_master_id :selected,['class' => 'form-control','placeholder'=>'Select Pass Type']) !!}
</div>
<div class="form-group">
    {!! Form::label('print_ticket', Lang::get('Print Ticket'), ['class' => 'control-label']) !!}<br>
    <input type="checkbox" name="print_ticket" value="1" <?php if($concessions->print_ticket==1) { ?>checked="checked"<?php } ?>>
</div>
<div class="form-group">
      @php $etm_hot_key_master_id=displayList('etm_hot_key_masters','name')@endphp
    {!! Form::label('etm_hot_key_master_id', Lang::get('ETM Hot Key'), ['class' => 'control-label']) !!}<br>
      {!! Form::select('pass_type_master_id',$etm_hot_key_master_id, isset($concessions->etm_hot_key_master_id) ? $concessions->etm_hot_key_master_id :selected,['class' => 'form-control','placeholder'=>'Select ETM Hot key']) !!}
</div>

 @php 
 if($concession->concession_allowed_on!='')
 {
 $concession_allowed_on = date('d-m-Y', strtotime($concession->concession_allowed_on));
 }
 @endphp
<div class="form-group">
    {!! Form::label('concession_allowed_on', Lang::get('Concession Allowed on(for all days of the year leave field blank)'), ['class' => 'control-label']) !!}
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('concession_allowed_on', $concession_allowed_on, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
    <!-- /.input group -->
</div>
<div class="form-group">
      {!! Form::label('flat_fare', Lang::get('Flat Fare'), ['class' => 'control-label']) !!}<br>
      <input type="radio" name="flat_fare" value="Yes" <?php if($concessions->flat_fare=="Yes") { ?>checked  <?php } ?>  > Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="flat_fare" value="No"  <?php if($concessions->flat_fare=="No") { ?>checked  <?php } ?>  > No
</div>
<div class="form-group">
      {!! Form::label('flat_fare_amount', Lang::get('Flat Fare Amount'), ['class' => 'control-label']) !!}<br>
      {!! Form::text('flat_fare_amount', null, ['class' => 'form-control','onkeypress'=>'return isNumberKey(event)']) !!}
</div>
{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
