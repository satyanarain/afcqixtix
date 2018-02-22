<div class="form-group">
    @php
    $bus_type_id=displayList('bus_types','bus_type')
    @endphp
    {!! Form::label('bus_type_id', Lang::get('Bus Type'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
    {!! Form::select('bus_type_id',$bus_type_id,isset($services->bus_type_id) ? $services->bus_type_id : selected,
    ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Bus Type','required' => 'required']) !!}
</div> 
</div> 
<div class="form-group">
        {!! Form::label('name', Lang::get('Service Name'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-7 col-sm-12 required">
        {!! Form::text('name', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('short_name', Lang::get('Short Name'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
    {!! Form::text('short_name', null, ['class' => 'col-md-6 form-control']) !!}
</div>
</div>


<div class="form-group">
     @if($services->order_number!='')
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
   {!! Form::text('order_number',null, ['class' => 'col-md-6 form-control','readonly'=>readonly]) !!}
   @else
     @php $services_value= maxId('services','order_number') @endphp
        {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
   {!! Form::text('order_number', $services_value, ['class' => 'col-md-6 form-control','readonly'=>readonly]) !!}
    @endif
</div>
 </div>
<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required')) }}
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div> 
