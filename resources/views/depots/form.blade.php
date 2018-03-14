<div class="form-group">
        {!! Form::label('name', Lang::get('Depot Name'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('name', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('depot_id', Lang::get('Depot ID'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::number('depot_id', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('short_name', Lang::get('Short Name'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
    {!! Form::text('short_name', null, ['class' => 'col-md-6 form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('depot_location', Lang::get('Depot Location'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
    {!! Form::text('depot_location', null, ['class' => 'col-md-6 form-control']) !!}
</div>
</div>

<div class="form-group">
    @php $services_value=displayList('services','name')@endphp
   
      {!! Form::label('service_id', Lang::get('Default Service'), ['class' => 'col-md-3 control-label']) !!}
       <div class="col-md-7 col-sm-12 required">
       {!! Form::select('service_id',$services_value,isset($depot->service_id) ? $depot->service_id : selected,['class' => 'form-control required','required' => 'required','onchange'=>'fareList(this.value)','placeholder'=>"Select Service"]) !!}
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


