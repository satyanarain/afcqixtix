<div class="form-group">
    @php $concession_provider_masters=displayList('concession_provider_masters','name')@endphp
    {!! Form::label('concession_provider_master_id', Lang::get('Pass Provider'), ['class' => 'control-label required']) !!}
  {!! Form::select('concession_provider_master_id',$concession_provider_masters, isset($pass_types->concession_provider_master_id) ? $pass_types->concession_provider_master_id :selected,['class' => 'form-control','placeholder'=>'Select Pass Provider','required'=>'required']) !!}
</div>
<div class="form-group">
     @php $pass_type_masters=displayList('pass_types','pass_type_master_id')@endphp
      {!! Form::label('pass_type_master_id', Lang::get('Pass Type'), ['class' => 'control-label']) !!}<br>
         {!! Form::text('pass_type_master_id',null,['class' => 'form-control','required' => 'required']) !!}
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
<div class="col-sm-12"  style="padding-left:0px; padding-bottom:20px;">
    <?php $accept_gender_detail = explode(',',$pass_types->accept_gender_detail);?>
    <div class="col-sm-3" style="padding-left:0px; ">
        {!! Form::label('accept_gender_male', Lang::get('Male'), ['class' => 'control-label']) !!}<br>
        <input id="accept_gender_male" type="checkbox" name="accept_gender_detail[]" value="Male" <?php if(in_array('Male',$accept_gender_detail)) { ?>checked="checked"<?php } ?>>
    </div>
    <div class="col-sm-3" style="padding-left:0px; ">
        {!! Form::label('accept_gender_female', Lang::get('Female'), ['class' => 'control-label']) !!}<br>
        <input id="accept_gender_female" type="checkbox" name="accept_gender_detail[]" value="Female" <?php if(in_array('Female',$accept_gender_detail)) { ?>checked="checked"<?php } ?>>
    </div>
    <div class="col-sm-3" style="padding-left:0px; ">
        {!! Form::label('accept_gender_other', Lang::get('Other'), ['class' => 'control-label']) !!}<br>
        <input id="accept_gender_other" type="checkbox" name="accept_gender_detail[]" value="Other" <?php if(in_array('Other',$accept_gender_detail)) { ?>checked="checked"<?php } ?>>
    </div>
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
    @php $pass_types_order= maxId1('pass_types','order_number','service_id',$service_id) @endphp
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', $pass_types_order, ['class' => 'form-control','readonly'=>readonly]) !!}
  @endif
 
</div>

<div class="form-group">
    <div class="col-md-1" style="margin-left: 15px;">{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}</div>
<div class="col-md-3" style="margin-right: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-left','onclick'=>'window.history.back();')) }}</div>
</div>