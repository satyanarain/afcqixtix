<div class="form-group">
        {!! Form::label('shift', Lang::get('Shift'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
        {!! Form::text('shift', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('abbreviation', Lang::get('Abbreviation'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
        {!! Form::text('abbreviation', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>

<div class="form-group">
     {!! Form::label('start_time', Lang::get('Start Time'), ['class' => 'col-md-3 control-label']) !!}
      <div class="col-md-7 col-sm-12 required">
    {!! Form::text('start_time', null, ['class' => 'col-md-6 form-control']) !!}
     
    <!-- /.input group -->
</div>
</div>

<div class="form-group">
    {!! Form::label('end_time', Lang::get('End Time'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
     {!! Form::text('end_time',null , ['class' => 'col-md-6 form-control']) !!}

    <!-- /.input group -->
</div>
</div>

<div class="form-group">
   @if($bustypes->order_number!='')
        {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('order_number', null, ['class' => 'col-md-6 col-md-6 form-control','readonly' => 'readonly']) !!}
        </div>
         @else
         @php $shifts= maxId('shifts','order_number') @endphp
         {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('order_number', $shifts, ['class' => 'col-md-6 col-md-6 form-control','readonly' => 'readonly',]) !!}
        </div>
         @endif
</div>
<div class="form-group">
    {!! Form::label('system_id', Lang::get('System ID'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
    {!! Form::text('system_id', null, ['class' => 'col-md-6 form-control']) !!}
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
 