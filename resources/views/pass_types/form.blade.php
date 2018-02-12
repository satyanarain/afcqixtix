@php $services=displayList('services','name')@endphp
<div class="form-group">
        {!! Form::label('service_id', Lang::get('Service'), ['class' => 'control-label required']) !!}
        {!! Form::select('service_id',$services,isset($pass_types->service_id) ? $pass_types->service_id : selected,['class' => 'form-control','required' => 'required','placeholder'=>"Select Service"]) !!}
</div>
<div class="form-group">
    @php $concession_provider_masters=displayList('concession_provider_masters','name')@endphp
    {!! Form::label('concession_provider_master_id', Lang::get('Pass Provider'), ['class' => 'control-label required']) !!}
  {!! Form::select('concession_provider_master_id',$concession_provider_masters, isset($pass_types->concession_provider_master_id) ? $pass_types->concession_provider_master_id :selected,['class' => 'form-control','placeholder'=>'Select Pass Provider','required'=>'required']) !!}
</div>
<div class="form-group">
     @php $pass_type_masters=displayList('pass_type_masters','name')@endphp
      {!! Form::label('pass_type_master_id', Lang::get('Pass Type'), ['class' => 'control-label']) !!}<br>
         {!! Form::select('pass_type_master_id',$pass_type_masters, isset($pass_types->pass_type_master_id) ? $pass_types->pass_type_master_id :selected,['class' => 'form-control','placeholder'=>'Select Pass Type']) !!}
</div>
<div class="form-group">
         {!! Form::label('description', Lang::get('Description'), ['class' => 'control-label required']) !!}
         {!! Form::text('description', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
         {!! Form::label('short_description', Lang::get('Short Description'), ['class' => 'control-label required']) !!}
         {!! Form::text('short_description', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
         {!! Form::label('amount', Lang::get('Amount'), ['class' => 'control-label required']) !!}
         {!! Form::text('amount', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
         {!! Form::label('validity_message', Lang::get('Validity Message'), ['class' => 'control-label required']) !!}
         {!! Form::text('validity_message', null, ['class' => 'form-control','required' => 'required']) !!}
 </div>
<div class="form-group">
         {!! Form::label('info_message', Lang::get('Info Message'), ['class' => 'control-label required']) !!}
         {!! Form::text('info_message', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('accept_gender', Lang::get('Accept Gender'), ['class' => 'control-label']) !!}<br>
    <input type="checkbox" name="accept_gender" value="Yes" <?php if($pass_types->accept_gender=='Yes') { ?>checked="checked"<?php } ?>>
</div>
<div class="form-group">
    {!! Form::label('accept_agg', Lang::get('Accept Age ?'), ['class' => 'control-label']) !!}<br>
  <input type="checkbox" name="accept_age" value="Yes" <?php if($pass_types->accept_age=='Yes') { ?>checked="checked"<?php } ?>>
</div>

<div class="col-sm-12"  style="padding-left:0px; padding-bottom:20px;">
<div class="col-sm-6" style="padding-left:0px; ">
   {!! Form::label('accept_age_from', Lang::get('From'), ['class' => 'control-label required']) !!}
   {!! Form::text('accept_age_from', $accept_age_from, ['class' => 'form-control']) !!}
     
</div>
<div class="col-sm-6">
   {!! Form::label('accept_age_to', Lang::get('To'), ['class' => 'control-label required']) !!}
   {!! Form::text('accept_age_to', $accept_age_from, ['class' => 'form-control']) !!}
     
</div>
</div>
<div class="form-group">
    {!! Form::label('accept_agg', Lang::get('Accept Spouse Age'), ['class' => 'control-label']) !!}<br>
  <input type="checkbox" name="accept_spouse_age" value="Yes" <?php if($pass_types->accept_spouse_age=='Yes') { ?>checked="checked"<?php } ?>>
</div>
<div class="col-sm-12"  style="padding-left:0px; padding-bottom:20px;">
<div class="col-sm-6" style="padding-left:0px; ">
   {!! Form::label('accept_spouse_age_from', Lang::get('From'), ['class' => 'control-label required']) !!}
   {!! Form::text('accept_spouse_age_from', $accept_age_from, ['class' => 'form-control']) !!}
     
</div>
<div class="col-sm-6">
   {!! Form::label('accept_spouse_age_to', Lang::get('To'), ['class' => 'control-label required']) !!}
   {!! Form::text('accept_spouse_age_to', $accept_age_from, ['class' => 'form-control']) !!}
     
</div>
</div>
<div class="form-group">
        {!! Form::label('accept_id_number', Lang::get('Accept ID Number'), ['class' => 'control-label required']) !!}<br>
        <input type="radio" name="accept_id_number" value="No" <?php if($pass_types->accept_id_number=='No') { ?>checked="checked"<?php } ?>> &nbsp;No&nbsp;&nbsp;&nbsp;
        <input type="radio" name="accept_id_number" value="Optional" <?php if($pass_types->accept_id_number=='Optional') { ?>checked="checked"<?php } ?>>&nbsp;Optional&nbsp;&nbsp;&nbsp;
        <input type="radio" name="accept_id_number" value="Mandatory" <?php if($pass_types->accept_id_number=='Mandatory') { ?>checked="checked"<?php } ?>>&nbsp;Mandatory
</div>

<div class="form-group">
  
    @if($pass_types->order_number!='')
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number',null, ['class' => 'form-control','readonly'=>readonly]) !!}
     @else
    @php $pass_types_order= maxId('pass_types','order_number') @endphp
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', $pass_types_order, ['class' => 'form-control','readonly'=>readonly]) !!}
  @endif
 
</div>


{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
