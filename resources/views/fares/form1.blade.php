<div id="control-group" style="padding-left:0px;" class="col-md-12" >
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">Stage</div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">Adult Ticket Amount</div>
       <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;">Child Ticket Amount</div>
       <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;">Luggage Ticket Amount</div>
</div>
<div id="fare_list">
@if($fare_details!='')
@foreach($fare_details as $value)
<div id="control-group" style="padding-left:0px;  margin-bottom:10px;" class="col-md-12" id="{{ "div_remove_field".$value->id }}">
           <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="stage" class="form-control" placeholder="Stage" required="required" onkeypress="return isNumberKey(event)" value="{{$value->stage}}"></div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="adult_ticket_amount" class="form-control" placeholder="Adult Ticket Amount" required="required" onkeypress="return isNumberKey(event)" value="{{$value->adult_ticket_amount}}"></div>
       <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="child_ticket_amount" class="form-control" placeholder="Child Ticket Amount" required="required" onkeypress="return isNumberKey(event)" value="{{$value->child_ticket_amount}}"></div>
       <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="luggage_ticket_amount" class="form-control" placeholder="Luggage Ticket Amount" required="required" onkeypress="return isNumberKey(event)" value="{{$value->luggage_ticket_amount}}"></div>
</div>
@endforeach
<div class="copy show" id="input_fields_wrap_classes">
</div>
 
@endif
</div>

<div class="input-group col-md-12" id="button">
    <input type="hidden" name='service_id' value="<?php echo $fares->id; ?>">
  {!! Form::submit(Lang::get('common.titles.update'), ['class' => 'btn btn-success']) !!}
  <div class="col-md-3" style="margin-right: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-left','onclick'=>'window.history.back();')) }}</div>
</div>

 </div>


<!--<div id="b" style="position:absolute; top:50px"><i class="fa fa-bus" style="font-size:48px;color:red"></i></div>-->
@push('scripts')
 <script type="text/javascript">
$(document).ready(function() {
    
    function beeLeft() {
        $("#b").animate({left: "-=300"}, 1500, "swing", beeRight);
    }
    function beeRight() {
        $("#b").animate({left: "+=300"}, 1500, "swing", beeLeft);
    }
    
    beeRight();
    
});

    
    
function fareList(id)
{

if(id!='')
{
  $.ajax({
          type: "get",
               url:'/fares/fare_list/'+id,
            success:function(data)
            {
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
    
   //var maxvalue= $("#maxvalue").val();
   //alert(maxvalue)
//  if(maxvalue != 'undefined')
//  {
    var x = 1;  
//  }else
//  {
//    var x = maxvalue;   
//  }

    
    //initlal text box count
    $("#add_field_button_classes").click(function(e){ //on add input button click
     
        e.preventDefault();
         if(x < max_fields){ //max input box allowed
            x++; //text box increment
$("#input_fields_wrap_classes").append('<div id="div_remove_field'+ x +'" style="padding-left:0px;  margin-bottom:10px;" class="col-md-12">\n\
<div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="stage[]" class="form-control" placeholder="Stage" required="required" onkeypress="return isNumberKey(event)"></div>\n\
 <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="adult_ticket_amount[]" class="form-control" placeholder="Adult Ticket Amount" required="required" onkeypress="return isNumberKey(event)"></div>\n\
<div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="child_ticket_amount[]" class="form-control" placeholder="Child Ticket Amount" required="required" onkeypress="return isNumberKey(event)"></div>\n\
<div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="luggage_ticket_amount[]" class="form-control" placeholder="Luggage Ticket Amount" required="required" onkeypress="return isNumberKey(event)"></div>\n\
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
@endpush