<div class="input-group col-md-12">
   {!! Form::label('route_name', Lang::get('Route Name'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
   <div class="input-group col-md-12 required">
   {!! Form::text('route_name', null, ['class' => 'form-control','required' => 'required']) !!}
   </div>
</div>
<div class="input-group col-md-12"><p></p></div>
<div class="input-group col-md-12" id="button">
    <div class="col-md-1" style="margin-right: 15px;">{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}</div>
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
</script>
