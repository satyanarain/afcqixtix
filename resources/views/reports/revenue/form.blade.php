<div class="form-group">
     @php $depots_value=displayList('depots','name')@endphp
    {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'col-md-3 control-label']) !!}
       <div class="col-md-7 col-sm-12 required">
       {!! Form::select('depot_id',$depots_value,isset($depot->depot_id) ? $depot->depot_id : selected,['class' => 'col-md-6 form-control','required' => 'required','placeholder'=>"Select Depot"]) !!}
</div> 
</div> 

<div class="form-group">
        {!! Form::label('report_date', Lang::get('Date'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12">
        <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('report_date', null, ['class' => 'col-md-6 form-control multiple_date']) !!}
      </div>
</div>
</div>
<div class="form-group">
     @php $shifts_value=displayList('shifts','shift')@endphp
    {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'col-md-3 control-label']) !!}
       <div class="col-md-7 col-sm-12">
       {!! Form::select('shift_id',$shifts_value,isset($depot->shift_id) ? $shifts_value->shift_id : selected,['class' => 'col-md-6 form-control','placeholder'=>"Select Shift"]) !!}
</div> 
</div> 

<div class="form-group">
     <?php 
       $status_type=array('g'=>"Generated",'s'=>"Submitted",'c'=>"Completed");
     ?>
     
    {!! Form::label('status_uype', Lang::get('Status Type'), ['class' => 'col-md-3 control-label']) !!}
       <div class="col-md-7 col-sm-12">
       {!! Form::select('status_type',$status_type,isset($status_type->status_uype) ? $status_type->status_type : selected,['class' => 'col-md-6 form-control','placeholder'=>"Select Status Type"]) !!}
</div> 
</div>
<div class="form-group">
    {!! Form::label('etm_no', Lang::get('ETM No.'), ['class' => 'col-md-3 control-label']) !!}
     <div class="col-md-7 col-sm-12">
    {!! Form::text('etm_no', null, ['class' => 'col-md-6 form-control']) !!}
</div>
</div>
<div class="form-group">
     @php $selectFormat=displaySelectFormat($data)@endphp
    {!! Form::label('shift_id', Lang::get('Select Format'), ['class' => 'col-md-3 control-label']) !!}
       <div class="col-md-7 col-sm-12">
       {!! Form::select('select_format',$selectFormat,isset($select_format->select_format) ? $select_format->select_format : selected,['class' => 'col-md-6 form-control','placeholder'=>"Select Format"]) !!}
</div> 
</div>
 
<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left')) }}
<!--    <div class="col-md-3" style="margin-right: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-left','onclick'=>'window.history.back();')) }}</div>-->
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div> 


