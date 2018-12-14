<div class="form-group">@include('partials.message')</div>
<div class="form-group ">
     {!! Form::label('downloading_wef', Lang::get('Download From'), ['class' => 'col-md-3 control-label','for'=>'downloading_wef']) !!}
    <div class="col-md-9 col-sm-12">
        <div class="input-group date form_date col-md-10" data-date="" data-date-format="dd MM yyyy p" data-link-field="date_of_birtha">
        {!! Form::text('downloading_wef', $versions->downloading_wef, ['class' => 'form-control','readonly'=>'readonly']) !!}
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        
    </div>
</div>
<!--<div class="form-group">
        {!! Form::label('downloading_wef', Lang::get('Download From'), ['class' => 'col-md-3 control-label']) !!}
        
        <div class="col-md-7 col-sm-12 required">
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {!! Form::text('downloading_wef1', $versions->downloading_wef, ['class' => 'multiple_date1','readonly'=>'readonly']) !!}
            </div>
      </div>
        
        
          
</div>-->
<div class="form-group">
        {!! Form::label('reason', Lang::get('Reason'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('reason', $versions->reason, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
@php
    $segment = Request::segments();
    $depot_id = displayList('depots','name');
@endphp
@if($segment[2]==="edit")
<div class="form-group">
    {!! Form::label('version_status', Lang::get('Status'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12 required">
    {!! Form::select('version_status',array('o'=>'Open','c'=>'Close'),isset($versions->version_status) ? $versions->version_status : selected,['class' => 'col-md-6 form-control','placeholder'=>'Select Version Status','required'=>'required']) !!}
</div>
</div>
@endif
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
