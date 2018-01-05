<div class="form-group">
        {!! Form::label('shift', Lang::get('Shift'), ['class' => 'control-label required']) !!}
        {!! Form::text('shift', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('abbreviation', Lang::get('Abbreviation'), ['class' => 'control-label required']) !!}
    {!! Form::text('abbreviation', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
     {!! Form::label('start_time', Lang::get('Start Time'), ['class' => 'control-label required']) !!}
    {!! Form::text('start_time', null, ['class' => 'form-control']) !!}
     
    <!-- /.input group -->
</div>

<div class="form-group">
    {!! Form::label('end_time', Lang::get('End Time'), ['class' => 'control-label required']) !!}
     {!! Form::text('end_time',null , ['class' => 'form-control']) !!}

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
 