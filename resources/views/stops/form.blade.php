<!--SELECT `id`, `user_id`, `stop`, `stop_id`, `abbreviation`, `shor_name`,-->
<div class="form-group">
        {!! Form::label('stop', Lang::get(''), ['class' => 'control-label required']) !!}
        {!! Form::text('stop', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
        {!! Form::label('stop_id', Lang::get('Stop ID'), ['class' => 'control-label required']) !!}
        {!! Form::text('stop_id', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('abbreviation', Lang::get('Abbreviation'), ['class' => 'control-label required']) !!}
    {!! Form::text('abbreviation', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('short_name', Lang::get('Short Name'), ['class' => 'control-label required']) !!}
    {!! Form::text('short_name', null, ['class' => 'form-control']) !!}
</div>


 {!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
