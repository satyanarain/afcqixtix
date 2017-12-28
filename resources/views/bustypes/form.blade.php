<div class="form-group">
        {!! Form::label('bus_type', Lang::get('Bus Type'), ['class' => 'control-label required']) !!}
        {!! Form::text('bus_type', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('abbreviation', Lang::get('Abbreviation'), ['class' => 'control-label required']) !!}
    {!! Form::text('abbreviation', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', null, ['class' => 'form-control']) !!}
</div>
 {!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
