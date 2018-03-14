<div class="form-group">
        {!! Form::label('stop', Lang::get(''), ['class' => 'col-md-3 control-label']) !!}
          <div class="col-md-7 col-sm-12 required">
        {!! Form::text('stop', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('stop_id', Lang::get('Stop ID'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('stop_id', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('abbreviation', Lang::get('Abbreviation'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
    {!! Form::text('abbreviation', null, ['class' => 'col-md-6 form-control']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('short_name', Lang::get('Short Name'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
    {!! Form::text('short_name', null, ['class' => 'col-md-6 form-control']) !!}
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
