<div class="form-group ">
    {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 required">
        @php $depots=displayList('depots','name');@endphp
       <span id="depot_id"> {!! Form::select('depot_id', $depots,isset($etm_details->depot_id) ? $etm_details->depot_id : selected,
        ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Depot','required' => 'required']) !!}</span>
    </div>

</div> 
<div class="form-group ">
     {!! Form::label('role', Lang::get('ETM No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('etm_no', null, ['class' => 'col-md-6 form-control','required' => 'required', 'onkeypress'=>'return isNumberKey(event)']) !!}
    </div>
</div>
<div class="form-group ">
    {!! Form::label('etm_status_masters', Lang::get('Status'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 required">
        @php $etm_status_masters=displayList('etm_status_masters','name');@endphp
       <span id="depot_id"> {!! Form::select('evm_status_master_id',$etm_status_masters,isset($etm_details->depot_id) ? $etm_details->evm_status_master_id : selected,
        ['class' => 'col-md-6 form-control', 'placeholder'=>'Select status','required' => 'required']) !!}</span>
    </div>

</div> 
<div class="form-group ">
     {!! Form::label('sim_no', Lang::get('SIM No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('sim_no', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('imei_no', Lang::get('IMEI No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('imei_no', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('serial_no', Lang::get('Serial No.'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('serial_no', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('make', Lang::get('Make'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
          {!! Form::text('make', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div> 

<div class="form-group ">
     {!! Form::label('warranty', Lang::get('Warranty'), ['class' => 'col-md-3 control-label','for'=>'warranty']) !!}
    <div class="col-md-9 col-sm-12">
        <div class="input-group date form_date col-md-10" data-date="" data-date-format="dd MM yyyy p" data-link-field="">
        {!! Form::text('warranty', $warranty, ['class' => 'form-control','readonly'=>'readonly']) !!}
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        
    </div>
</div>
<!--<div class="form-group ">
     {!! Form::label('warranty1', Lang::get('Warranty'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
       <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('warranty1', $warranty, ['class' => 'multiple_date','readonly'=>'readonly']) !!}
      </div>
    </div>
</div> -->
<div class="form-group ">
     {!! Form::label('project_period', Lang::get('Project period (Years)'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::text('project_period', null, ['class' => 'col-md-6 form-control','onkeypress'=>'return isNumberKey(event)']) !!}
    </div>
</div> 
<div class="form-group ">
     {!! Form::label('remarks', Lang::get('Remarks'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
          {!! Form::textarea('remarks', null, ['class' => 'col-md-6 form-control','rows'=>'3']) !!}
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