@php $shifts=displayList('shifts','shift')@endphp
<div class="form-group" id=''>
        {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
        {!! Form::select('shift_id',$shifts,isset($targets->shift_id) ? $targets->shift_id : selected,['class' => 'col-md-6 form-control', 'placeholder'=>'Select Shift','required' => 'required','onchange'=>'fillTripDropdown('.$route_master_id.','.$duty_id.')']) !!}

</div>
</div>

<div class="form-group">
        {!! Form::label('trip', Lang::get('Trip'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
<!--         {!! Form::text('trip', null, ['class' => 'col-md-6 form-control','required' => 'required',
         onkeypress=>'return isIntegerKey(event)']) !!}-->
        
        {!! Form::select('trip', $trips,isset($targets->trip) ? $targets->trip : selected,['id'=>'trip_id','class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Trip','required' => 'required']) !!}
</div>
        
</div>
<div class="form-group">
        {!! Form::label('epkm', Lang::get('EPKM'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7 col-sm-12 required">
         {!! Form::text('epkm', null, ['class' => 'col-md-6 form-control','required' => 'required', onkeypress=>'return isNumberKey(event)']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('income', Lang::get('Income'), ['class' => 'col-md-3 control-label']) !!}
      <div class="col-md-7 col-sm-12 required">
         {!! Form::text('income', null, ['class' => 'col-md-6 form-control','required' => 'required',onkeypress=>'return isNumberKey(event)']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('incentive', Lang::get('Incentive'), ['class' => 'col-md-3 control-label']) !!}
          <div class="col-md-7 col-sm-12">
         {!! Form::text('incentive', null, ['class' => 'col-md-6 form-control']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('driver_share', Lang::get('Driver Share'), ['class' => 'col-md-3 control-label']) !!}
          <div class="col-md-7 col-sm-12">
         {!! Form::text('driver_share', null, ['class' => 'col-md-6 form-control',onkeypress=>'return isNumberKey(event)']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('conductor_share', Lang::get('Conductor Share'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12">
         {!! Form::text('conductor_share', null, ['class' => 'col-md-6 form-control',onkeypress=>'return isNumberKey(event)']) !!}
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