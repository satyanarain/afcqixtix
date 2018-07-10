<div class="input-group col-md-12">
    @php $routes=displayList('routes','route')@endphp
    {!! Form::label('route_id', Lang::get('Route'), ['class' => 'control-label','style'=>"margin-bottom:10px;" ]) !!}
    
    <div class="input-group col-md-12 required">
  {!! Form::select('route_id',$routes,isset($duties->route_id) ? $duties->route_id : selected,['class' => 'form-control','required' => 'required','onchange'=>"getSubCate(this.value,'duties','returned_id')",'placeholder'=>'Select route']) !!}
</div>

</div>
<div class="input-group col-md-12" id="returned_id_show" style="display:none">
    @php $duties=displayList('duties','duty_number')@endphp
    {!! Form::label('duty_id', Lang::get('Duty'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
     <div class="input-group col-md-12 required">
             <span id='returned_id'></span>
      </div>
   
</div>
<div class="input-group col-md-12">
    @php $shifts=displayList('shifts','shift')@endphp
    {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
   <div class="input-group col-md-12 required">
  {!! Form::select('shift_id',$shifts,isset($trips->shift_id) ? $trips->shift_id : selected,['class' => 'form-control','required' => 'required','placeholder'=>'Select shift']) !!}
</div>
</div>
<div class="path-section">
    <p class="path-section-heading">Stop Details</p>

    <div class="path-section-content">
<div class="input-group col-md-12">
<div class="row" id="after-add-more">
  <div class="form-group ">
   <div class="col-md-9" style="padding:0px 0px 0px 30px;">
            <div class="btn btn-success add-more pull-left" type="button" id="add_field_button_classes"><i class="glyphicon glyphicon-plus" ></i> Add</div>
            <div class="col-md-9" style="padding-left: 0px;">
           </div>
        </div>
      
    </div> 
</div>
<div id="control-group" style="padding-left:0px;" class="col-md-12" >
     <div class="col-md-1" style="padding-left:0px;  margin-bottom:10px;">Trip No.</div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">Start Time</div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">Path</div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">Deviated Route</div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">Deviated Path</div>
      
</div>
      @php $routes=displayList('routes','route')@endphp
<div id="fare_list">
<div class="copy show" id="input_fields_wrap_classes">
       <div id="control-group" style="padding-left:0px;  margin-bottom:10px;" class="col-md-12" >
       <div class="col-md-1" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="trip_no[]" class="form-control" placeholder="Trip No." required="required" onkeypress="return isIntegerKey(event)"></div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"  data-placement="right" data-align="top" data-autoclose="true">
           <div class="input-group col-md-12">
               <div class="input-group col-md-12" data-placement="right" data-align="top" data-autoclose="true">
                   <input type="text" class="form-control clockpicker1" value="" name="start_time[]" plcacholder="Start Time">
                   <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div>
           </div>
       </div>
        <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">{{ displayPath('path_route_id[]')}}</div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">{!! Form::select('deviated_route[]',$routes,isset($trips->deviated_route) ? $trips->deviated_route : selected,['class' => 'form-control','placeholder'=>'Select deviated route']) !!}</div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">{{ displayPath('deviated_path[]')}}</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="input-group col-md-12" id="button">
  {!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
</div>
 </div>
<script src="{{ asset(elixir('js/bootstrap-clockpicker.min.js')) }}"></script>
<script type="text/javascript">
$('.clockpicker1').clockpicker({ 
placement: 'bottom',
	align: 'left',
	donetext: 'Done',
        autoclose: true,
  twelvehour: true
 });
</script>
<script type="text/javascript">
function checkDest(id)
{
var source= $("#source").val();
var destination= $("#destination").val();
  if(source==id)
  {
   alert("Please select source and destination different.");  
   $("#destination").val('');
  }
 }
function checkDest_via(id)
{
var source= $("#source").val();
var destination= $("#destination").val();
  if(source==id)
  {
   alert("Please select source and via different.");  
    $("#via").val('');
  }else if(destination==id)
  {
   alert("Please select destination and via different.");  
   $("#via").val('');
  }
 }
 function fareList(id)
{

if(id!='')
{
  $.ajax({
          type: "get",
               url:'/trips/fare_list/'+id,
            success:function(data)
            {
              $('#fare_list').html(data);
            }
            
        });
   
   }   
}
 function getSubCate(id,table_name,returned_id)
{
if(id!='')
{
$.ajax({
          type: "get",
          url:'/trips/getsubcat/'+id,
             data:'table_name='+table_name,
            success:function(data)
            {
              //alert(data);  
                
            if(data==0)
            {
               $('#returned_id_show').hide();    
            
            }else
            {
              $('#returned_id_show').show();
             $('#' + returned_id).html(data);
               
            }
        }
        });
   
   }   
}
jQuery(function($) {
    var max_fields      = 10000; //maximum input boxes allowed
    var wrapper         = $("#input_fields_wrap_classes"); //Fields wrapper
    var add_button      = $("#add_field_button_classes"); //Add button ID
    var add_button      = $("#add_field_button_classes");
  var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>';
    var x = 1;  
  //$("#add_field_button_classes").click(function(e){ //on add input button click
     $( document ).on( "click", "#add_field_button_classes", function(e) {
        e.preventDefault();
         if(x < max_fields){ //max input box allowed
            x++; //text box increment
$("#input_fields_wrap_classes").append('<div id="div_remove_field'+ x +'" style="padding-left:0px;  margin-bottom:10px;" class="col-md-12">\n\
  <div class="col-md-1" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="trip_no[]" class="form-control" placeholder="Trip No." required="required" onkeypress="return isIntegerKey(event)"></div>\n\
<div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"  data-placement="right" data-align="top" data-autoclose="true"><div class="input-group col-md-12"><div class="input-group col-md-12" data-placement="right" data-align="top" data-autoclose="true"><input type="text" class="form-control clockpicker" value="" name="start_time[]" plcacholder="Start Time"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></div></div>\n\
<div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">{{ displayPath('path_route_id[]')}}</div>\n\
<div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">{!! Form::select('deviated_route[]',$routes,isset($shifts->deviated_route) ? $$shifts->deviated_route : selected,['class' => 'form-control','placeholder' => 'Select deviated route']) !!}</div>\n\
<div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">{{ displayPath('deviated_path[]')}}</div>\n\
<button class="btn btn-danger remove" type="button" id="remove_field'+ x+'" onclick="removeFunction(this.id)"><i class="glyphicon glyphicon-remove"></i> Remove</button></div>'); //add input box
   bindClockPicker();
  }
 });
 
   function bindClockPicker() {
        $('.clockpicker').clockpicker({
          placement: 'top',
	align: 'left',
	donetext: 'Done',
        autoclose: true,
  twelvehour: true
        });
    }

    // Last but not least, call this to bind to any existing clockpicker elements
    bindClockPicker();
});
function removeFunction(id)
{

       $("#"+id).parent('div').remove();
      $("#div_"+id).remove();
    
}
</script>
 