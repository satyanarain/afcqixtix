@php $services=displayList('services','name')@endphp
<div class="form-group">
        {!! Form::label('service_id', Lang::get('Service'), ['class' => 'control-label required']) !!}
        {!! Form::select('service_id',$services,isset($concessions->service_id) ? $concessions->service_id : selected,['class' => 'form-control','required' => 'required','placeholder'=>"Select Service"]) !!}
</div>
<div class="form-group">
    @php $concession_provider=displayList('concession_providers','name')@endphp
        {!! Form::label('concession_provider', Lang::get('Concession Provider'), ['class' => 'control-label required']) !!}<br>
         {!! Form::select('concession_provider', $concession_provider,isset($concessions->concession_provider) ? $concessions->concession_provider :selected,['class' => 'form-control','required' => 'required','placeholder'=>"Select Concession Provider"]) !!}
</div>
<div class="form-group">
        {!! Form::label('concession', Lang::get('Concession'), ['class' => 'control-label required']) !!}
         {!! Form::text('concession', null, ['class' => 'form-control','required' => 'required']) !!}
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
    @php $concessions_order= maxId('concessions',$result='') @endphp
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
      {!! Form::label('pass_types', Lang::get('Pass Type'), ['class' => 'control-label']) !!}<br>
         {!! Form::select('pass_types',array(1=>Student,2=>'Senior Citizen'), isset($concessions->pass_types) ? $concessions->pass_types :selected,['class' => 'form-control','placeholder'=>'Select Pass Type']) !!}
</div>
<div class="form-group">
    {!! Form::label('print_ticket', Lang::get('Print Ticket'), ['class' => 'control-label']) !!}<br>
         {!! Form::checkbox('print_ticket',1,false) !!}
</div>

 @php 
 if($concession->concession_allowed_on!='')
 {
 $concession_allowed_on = date('d-m-Y', strtotime($concession->concession_allowed_on));
 }
 @endphp
<div class="form-group">
    {!! Form::label('concession_allowed_on', Lang::get('Concession Allowed on(for all days of the year leave field blank'), ['class' => 'control-label']) !!}
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
      {!! Form::radio('flat_fare', null,false) !!} Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      {!! Form::radio('flat_fare', null) !!} No
</div>
<div class="form-group">
      {!! Form::label('flat_fare_amount', Lang::get('Flat Fare Amount'), ['class' => 'control-label']) !!}<br>
      {!! Form::text('flat_fare_amount', null, ['class' => 'form-control']) !!}
</div>
{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
