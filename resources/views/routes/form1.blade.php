<div class="input-group col-md-12">
   {!! Form::label('route', Lang::get('Route'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
   <div class="input-group col-md-12 required">
   {!! Form::text('route', null, ['class' => 'form-control','required' => 'required']) !!}
   </div>
</div>
<div class="input-group col-md-12">
<div class="col-md-12" style="padding:0px;  margin-bottom:10px;">
  {!! Form::label('route', Lang::get('Direction'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}</br>
 {!! Form::select('direction',array('Up'=>'Up','Down'=>'Down',),isset($routes->direction) ? $routes->direction : selected,['class' => 'form-control required','required' => 'required','placeholder'=>'Select Direction']) !!}
</div>
</div>
<div class="path-section">
    <p class="path-section-heading">Path</p>

    <div class="path-section-content">
        <div class="input-group col-md-12">
            {!! Form::label('route', Lang::get('Source'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
            @php $stops=displayList('stops','stop')@endphp
            
            {!! Form::select('source',$stops,isset($routes->source) ? $routes->source : selected,['class' => 'form-control required','required' => 'required','placeholder'=>'Select Source']) !!}
        </div>   
        <div class="input-group col-md-12">
            {!! Form::label('route', Lang::get('Destination'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
            @php $stops=displayList('stops','stop')@endphp
            {!! Form::select('destination',$stops,isset($routes->destination) ? $routes->destination : selected,['class' => 'form-control required','required' => 'required','placeholder'=>'Select Destination']) !!}
        </div>   
        <div class="input-group col-md-12">
            {!! Form::label('route', Lang::get('Via'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
            @php $stops=displayList('stops','stop')@endphp
            {!! Form::select('via',$stops,isset($routes->via) ? $routes->via : selected,['class' => 'form-control required','required' => 'required','placeholder'=>'Select Via']) !!}
        </div> 

    </div>
</div>

<div class="input-group col-md-12">
 <div class="col-md-12" style="padding:0px;  margin-bottom:10px;">
  {!! Form::label('route', Lang::get('Default Path'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}</br>
 <input type="checkbox" value='Yes' name="default_path"> 
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
     <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;">Stop</div>
       <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;">Stage Number</div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">Distance(km.)</div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;">Hot Key</div>

</div>
   
@if(count($routes) >0)
@foreach($route_details as $value)
 <div id="control-group" style="padding-left:0px;  margin-bottom:10px;" class="col-md-12" >
       <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;">
           @php $stops=displayList('stops','stop')@endphp
            {!! Form::select('stop_id[]',$stops,isset($value->stop_id) ? $value->stop_id : selected,['class' => 'form-control','required' => 'required','placeholder'=>'Select Stop']) !!}
        </div>
     <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="stage_number[]" class="form-control" placeholder="Stage Number" required="required" onkeypress="return isIntegerKey(event)" value="{{ $value->stage_number }}"></div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="distance[]" class="form-control" placeholder="Distance(km)" required="required" onkeypress="return isNumberKey(event)" value="{{ $value->stage_number }}"></div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="hot_key[]" class="form-control" placeholder="Hot Key" required="required" onkeypress="return isIntegerKey(event)" value="{{ $value->stage_number }}"></div>

    </div>
@endforeach
<div class="copy show" id="input_fields_wrap_classes">
</div>
@else
<div class="copy show" id="input_fields_wrap_classes">
       <div id="control-group" style="padding-left:0px;  margin-bottom:10px;" class="col-md-12" >
       <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;">
           @php $stops=displayList('stops','stop')@endphp
            {!! Form::select('stop_id[]',$stops,isset($routes->stop_id) ? $routes->stop_id : selected,['class' => 'form-control','required' => 'required','placeholder'=>'Select Stop']) !!}
        </div>
       <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="stage_number[]" class="form-control" placeholder="Stage Number" required="required" onkeypress="return isIntegerKey(event)"></div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="distance[]" class="form-control" placeholder="Distance(km)" required="required" onkeypress="return isNumberKey(event)"></div>
       <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="hot_key[]" class="form-control" placeholder="Hot Key" required="required" onkeypress="return isIntegerKey(event)"></div>
     
</div>
</div>
@endif

</div>
</div>
</div>
<div class="input-group col-md-12">
<div class="col-md-12" style="padding:0px;  margin-bottom:10px;">
  {!! Form::label('is_this_by', Lang::get('Is this via stop of the path ?'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}</br>
 {!! Form::select('is_this_by',array('Yes'=>'Yes','No'=>'No'),isset($routes->is_this_by) ? $routes->is_this_by: selected,['class' => 'form-control','required' => 'required','placeholder'=>'Select is this via stop of the path ?']) !!}
</div>
</div>



<div class="input-group col-md-12" id="button">
  {!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
  <div class="col-md-3" style="margin-right: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-left','onclick'=>'window.history.back();')) }}</div>
</div>
 </div>

<script type="text/javascript">
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
