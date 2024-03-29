<div class="form-group">
        {!! Form::label('setting_name', Lang::get('Configuration Name'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('setting_name', isset($settings)?$settings->setting_description:null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('setting_value', Lang::get('Configuration Value'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('setting_value', $settings->setting_value, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>

<div class="form-group">
        {!! Form::label('setting_unit', Lang::get('Configuration Value Unit'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('setting_unit', $settings->setting_unit, ['class' => 'col-md-6 form-control']) !!}
</div>
</div>

<div class="form-group">
        {!! Form::label('setting_remarks', Lang::get('Remarks'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('setting_remarks', $settings->setting_remarks, ['class' => 'col-md-6 form-control']) !!}
</div>
</div>

<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required')) }}
    <div class="col-md-3" style="margin-right: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-left','onclick'=>'window.history.back();')) }}</div>
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div> 
