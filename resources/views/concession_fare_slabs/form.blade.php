<div class="form-group">
        {!! Form::label('percentage', Lang::get('Percentage'), ['class' => 'col-md-3 control-label']) !!}   <div class="col-md-7 col-sm-12 required">
         {!! Form::number('percentage', null, ['class' => 'col-md-6 form-control','required' => 'required','onkeypress'=>'return isNumberKey(event)']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('stage_from', Lang::get('Stage From'), ['class' => 'col-md-3 control-label','onkeypress'=>'return isNumberKey(event)']) !!}   <div class="col-md-7 col-sm-12 required">
         {!! Form::text('stage_from', null, ['class' => 'col-md-6 form-control','required' => 'required','onkeypress'=>'return isIntegerKey(event)']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('stage_to', Lang::get('Stage To'), ['class' => 'col-md-3 control-label','onkeypress'=>'return isNumberKey(event)']) !!}   <div class="col-md-7 col-sm-12 required">
         {!! Form::text('stage_to', null, ['class' => 'col-md-6 form-control','required' => 'required','onkeypress'=>'return isIntegerKey(event)']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('fare', Lang::get('Fare'), ['class' => 'col-md-3 control-label','onkeypress'=>'return isNumberKey(event)']) !!}   <div class="col-md-7 col-sm-12 required">
         {!! Form::text('fare', null, ['class' => 'col-md-6 form-control','required' => 'required','onkeypress'=>'return isNumberKey(event)']) !!}
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
