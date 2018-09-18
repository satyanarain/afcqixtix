<div class="input-group col-md-12">
   {!! Form::label('route_name', Lang::get('Route Name'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
   <div class="input-group col-md-12 required">
   {!! Form::text('route_name', null, ['class' => 'form-control','required' => 'required']) !!}
   </div>
</div>

<div class="input-group col-md-12">
<div class="col-md-12" style="padding:0px;  margin-bottom:10px;">
 
</div>
</div>
<div class="input-group col-md-12" id="button">
    <div class="col-md-1" style="margin-right: 15px;">{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}</div>
  <div class="col-md-3" style="margin-right: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-left','onclick'=>'window.history.back();')) }}</div>
</div>
 </div>

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
               url:'/routes/fare_list/'+id,
            success:function(data)
            {
               // alert(data);
              $('#fare_list').html(data);
            }
            
        });
   
   }   
}
    
 $(document).ready(function() {
    var max_fields      = 10000; //maximum input boxes allowed
    var wrapper         = $("#input_fields_wrap_classes"); //Fields wrapper
    var add_button      = $("#add_field_button_classes"); //Add button ID
    var add_button      = $("#add_field_button_classes");
 
    var x = 1;  
  $("#add_field_button_classes").click(function(e){ //on add input button click
     
        e.preventDefault();
         if(x < max_fields){ //max input box allowed
            x++; //text box increment
$("#input_fields_wrap_classes").append('<div id="div_remove_field'+ x +'" style="padding-left:0px;  margin-bottom:10px;" class="col-md-12">\n\
 <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;">{!! Form::select('stop_id[]',$stops,isset($routes->stop_id) ? $routes->stop_id : selected,['class' => 'form-control','required' => 'required','placeholder'=>'Select Stop']) !!}</div>\n\
  <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="stage_number[]" class="form-control" placeholder="Stage Number" required="required" onkeypress="return isIntegerKey(event)"></div>\n\
<div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="distance[]" class="form-control" placeholder="Distance(km)" required="required" onkeypress="return isNumberKey(event)"></div>\n\
<div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="hot_key[]" class="form-control" placeholder="Hot Key" required="required" onkeypress="return isIntegerKey(event)"></div>\n\
<button class="btn btn-danger remove" type="button" id="remove_field'+ x+'" onclick="removeFunction(this.id)"><i class="glyphicon glyphicon-remove"></i> Remove</button></div>'); //add input box
   }
 });
});
function removeFunction(id)
{

       $("#"+id).parent('div').remove();
      $("#div_"+id).remove();
    
}
</script>
