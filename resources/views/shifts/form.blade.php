<div class="form-group">
        {!! Form::label('shift', Lang::get('Shift'), ['class' => 'control-label required']) !!}
        {!! Form::text('shift', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('abbreviation', Lang::get('Abbreviation'), ['class' => 'control-label required']) !!}
    {!! Form::text('abbreviation', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
     {!! Form::label('start_date', Lang::get('Start Date'), ['class' => 'control-label required']) !!}

    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('start_date', start_date, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
    <!-- /.input group -->
</div>

<div class="form-group">
    {!! Form::label('end_date', Lang::get('End Date'), ['class' => 'control-label required']) !!}

    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('end_date', end_date, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
    <!-- /.input group -->
</div>

<div class="form-group">
    {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('system_id', Lang::get('System Id'), ['class' => 'control-label required']) !!}
    {!! Form::text('system_id', null, ['class' => 'form-control']) !!}
</div>
 {!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
 