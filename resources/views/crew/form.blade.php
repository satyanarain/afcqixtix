@php
    $segment = Request::segments();
    $depots = displayList('depots','name');
@endphp
@if($segment[4]==="edit")
<div class="form-group ">
    {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 required">
       <span id="depot_id"> {!! Form::select('depot_id', $depots,isset($crew_details->depot_id) ? $crew_details->depot_id : selected,
        ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Depot','required' => 'required']) !!}</span>
    </div>
<!--    <div class="col-md-1 col-sm-1 text-left required">
        <div class="btn btn-sm btn-default" onclick="AddDepot('depots')">Add New</div> 
    </div>-->
</div> 
@endif

<div class="form-group ">
    {!! Form::label('crew_type', Lang::get('Service Type'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 required">
       <span id="crew_type"> {!! Form::select('crew_type', array('Permanent'=>'Permanent','Adhoc'=>'Adhoc'),isset($crew_details->crew_type) ? $crew_details->crew_type : selected,
        ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Service Type','required' => 'required']) !!}</span>
    </div>
</div>

<div class="form-group ">
     {!! Form::label('role', Lang::get('Designation'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
            {!! Form::select('role', array('Conductor'=>'Conductor','Driver'=>'Driver','Inspector'=>'Inspector'),isset($crew_details->role) ? $crew_details->role : selected,
        ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Crew Designation','required' => 'required']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('crew_id', Lang::get('Crew Name'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('crew_name', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('crew_id', Lang::get('Crew ID'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('crew_id', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 
@if($crew_details->id=='')
<div class="form-group ">
     {!! Form::label('password', Lang::get('Password'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
           <input name="password" value="" id="password" class="form-control" type="password">
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('confirm_password', Lang::get('Confirm Password'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
        <input name="confirm_password" value="" id="confirm_password" class="form-control" type="password">
    </div>
</div> 
@endif
<?php //echo $crew_details->gender; ?>
<div class="form-group ">
     {!! Form::label('gender', Lang::get('Gender'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
        <input type="radio" name="gender" value="Male" <?php if($crew_details->gender=='Male'){ ?>checked="checked" <?php } ?>>&nbsp;Male&nbsp;
        <input type="radio" name="gender" value="Female" <?php if($crew_details->gender=='Female'){ ?>checked="checked" <?php } ?>>&nbsp;Female&nbsp;
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('father_name', Lang::get('Father Name'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('father_name', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('licence_no', Lang::get('Licence No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('licence_no', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('valid_up_to', Lang::get('Licence No. Valid Up To'), ['class' => 'col-md-3 control-label','for'=>'valid_up_to']) !!}
    <div class="col-md-9 col-sm-12">
        <div class="input-group date form_date col-md-10" data-date="" data-date-format="dd MM yyyy p" data-link-field="date_of_birtha">
        {!! Form::text('valid_up_to', $date_of_birth, ['class' => 'form-control','readonly'=>'readonly']) !!}
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        
    </div>
</div>
<!--<div class="form-group ">
     {!! Form::label('valid_up_to', Lang::get('Licence No. Valid Up To'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
       <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('valid_up_to', $date_of_birth, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
    </div>
</div> -->
<div class="form-group ">
     {!! Form::label('pf_no', Lang::get('PF No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('pf_no', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('city', Lang::get('City'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('city', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
</div> 
<div class="form-group ">
    {!! Form::label('country_id', Lang::get('Country'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
           @php $countries=displayList('countries','country_name');@endphp
     {!! Form::select('country_id', $countries,isset($crew_details->country_id) ? $crew_details->country_id : selected,
    ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Country']) !!}
    </div>
</div> 
  

<div class="form-group ">
     {!! Form::label('address', Lang::get('Address'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('address', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('mobile', Lang::get('Mobile'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('mobile', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('date_of_birth', Lang::get('Download From'), ['class' => 'col-md-3 control-label','for'=>'date_of_birth']) !!}
    <div class="col-md-9 col-sm-12">
        <div class="input-group date form_date col-md-10" data-date="" data-date-format="dd MM yyyy p" data-link-field="date_of_birtha">
        {!! Form::text('date_of_birth', $date_of_birth, ['class' => 'form-control','readonly'=>'readonly']) !!}
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        
    </div>
</div>
<!-- <div class="form-group ">
     {!! Form::label('date_of_birth', Lang::get('Date of Birth'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
       <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('date_of_birth', $date_of_birth, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
    </div>
</div> -->
<div class="form-group ">
     {!! Form::label('date_of_join', Lang::get('Date of Joining'), ['class' => 'col-md-3 control-label','for'=>'date_of_join']) !!}
    <div class="col-md-9 col-sm-12">
        <div class="input-group date form_date col-md-10" data-date="" data-date-format="dd MM yyyy p" data-link-field="date_of_birtha">
        {!! Form::text('date_of_join', $date_of_join, ['class' => 'form-control','readonly'=>'readonly']) !!}
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        
    </div>
</div>
<!-- <div class="form-group ">
     {!! Form::label('date_of_join', Lang::get('Date of Join'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
       <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('date_of_join', $date_of_join, ['class' => 'multiple_date','readonly'=>'readonly','required'=>'required']) !!}
      </div>
    </div>
</div>  -->
<div class="form-group ">
     {!! Form::label('date_of_leaving', Lang::get('Date of Leaving'), ['class' => 'col-md-3 control-label','for'=>'date_of_leaving']) !!}
    <div class="col-md-9 col-sm-12">
        <div class="input-group date form_date col-md-10" data-date="" data-date-format="dd MM yyyy p" data-link-field="date_of_birtha">
        {!! Form::text('date_of_leaving', $date_of_leaving, ['class' => 'form-control','readonly'=>'readonly']) !!}
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        
    </div>
</div>
<!--  <div class="form-group ">
     {!! Form::label('date_of_leaving', Lang::get('Date of Leaving'), ['class' => 'col-md-3 control-label','readonly'=>'readonly']) !!}
    <div class="col-md-7 col-sm-12">
       <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('date_of_leaving', $date_of_leaving, ['class' => 'multiple_date','readonly'=>'readonly','readonly'=>'readonly']) !!}
      </div>
    </div>
</div> -->
  
  
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

<script>
 $('#image_path').change(function () {
  var ext = $('#image_path').val().split('.').pop().toLowerCase();
 if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
    $("#output").hide();
    alert('Only JPG, JPEG, PNG &amp; GIF files are allowed.' );
    return false;
    
}

});
 var loadFile = function(event) {
       $("#output").show();
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };  
 
     function validateForm(){
      var usernane=   $("#user_name").val();
     nospace = usernane.split(' '); //we split the string in an array of strings using     whitespace as separator
     
     if(nospace.length>1)
     {
         alert("Space is not allowed in user name");
           return false; 
     }
     
     var ext = $('#image_path').val().split('.').pop().toLowerCase();
     if(ext!='')
     {
      if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
       $("#output").hide();
       alert('invalid extension!');
       return false;

       }
     }
 }  
</script>