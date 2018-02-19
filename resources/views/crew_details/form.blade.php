

<div class="form-group ">
    {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
           @php $depots=displayList('depots','name');@endphp
     {!! Form::select('depot_id', $depots,isset($crew_details->depot_id) ? $crew_details->depot_id : selected,
    ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Depot','required' => 'required']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('crew_id', Lang::get('Crew ID'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('crew_id', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 
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

<div class="form-group ">
     {!! Form::label('gender', Lang::get('Gender'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
        <input type="radio" name="gender" value="Male" <?php if($crew_details->gender=='Male'){ ?>selected="selected" <?php } ?>>&nbsp;Male&nbsp;
        <input type="radio" name="gender" value="Female" <?php if($crew_details->gender=='Male'){ ?>selected="selected" <?php } ?>>&nbsp;Female&nbsp;
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('father_name', Lang::get('Father Name'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('father_name', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('licence_no', Lang::get('Licence No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('licence_no', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 

<div class="form-group ">
     {!! Form::label('valid_up_to', Lang::get('Licence No. Valid Up To'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
       <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('valid_up_to', $date_of_birth, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('pf_no', Lang::get('PF No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('pf_no', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('city', Lang::get('City'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('city', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 
<div class="form-group ">
    {!! Form::label('country_id', Lang::get('Country'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
           @php $countries=displayList('countries','country_name');@endphp
     {!! Form::select('country_id', $countries,isset($crew_details->country) ? $crew_details->country : selected,
    ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Country','required' => 'required']) !!}
    </div>
</div> 
  

<div class="form-group ">
     {!! Form::label('address', Lang::get('Address'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('address', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('mobile', Lang::get('Mobile'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('mobile', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 
 <div class="form-group ">
     {!! Form::label('date_of_birth', Lang::get('Date of Birth'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
       <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('date_of_birth', $date_of_birth, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
    </div>
</div> 

 <div class="form-group ">
     {!! Form::label('date_of_join', Lang::get('Date of Join'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
       <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('date_of_join', $date_of_join, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
    </div>
</div>  
  
    <div class="form-group ">
     {!! Form::label('date_of_leaving', Lang::get('Date of Leaving'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
       <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('date_of_leaving', $date_of_leaving, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
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