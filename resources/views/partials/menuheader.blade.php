@foreach($users as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
   
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view">
                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>
               <h4 class="viewdetails_details"><span class="fa fa-menu"></span>&nbsp;Menu Details</h4>
            </div>
             <div class="modal-body-view">
                 <div class="alert alert-success alert-block" id="{{"message_show".$value->id}}" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong id="{{"message".$value->id}}"></strong>
                </div>
          
                 <form autocomplete="off">
                     <table class="table table-responsive.view">
                         <tr>
                             <td>Menu</td>
                             <td>Action</td>
                         </tr>
                         <tr>
                             <td><b>
                                 <input type="checkbox" name="depots[]" value="{{$value->depots}}" @if(in_array('depots',explode(',',$value->depots)))checked @endif onchange="showMenu(this.id)" id={{'depots'.$value->id}}>
                                   &nbsp;&nbsp;Depot</b></td>
                             <td align="left" valign="top"><span id="{{"showdepots".$value->id}}" 
                                                                 @if(in_array('depots',explode(',',$value->depots)))
                                                                 @else
                                                                 class="display_none"
                                                                 @endif
                                                                 >
                                     <table class="table_normal_100">
                                         <tr>
                                             <td><input type="checkbox" name="depots[]" value="{{$value->depots}}" @if(in_array('create',explode(',',$value->depots)))checked @endif>&nbsp;&nbsp;Add</td>
                                             <td><input type="checkbox" name="depots[]" value="{{$value->depots}}" @if(in_array('edit',explode(',',$value->depots)))checked @endif>&nbsp;&nbsp;Edit</td>
                                             <td><input type="checkbox" name="depots[]" value="{{$value->depots}}" @if(in_array('view',explode(',',$value->depots)))checked @endif>&nbsp;&nbsp;View</td>
                                         </tr>   
                                     </table>  
                                 </span>
                             </td>
                         </tr>
                         <tr>
                             <td><b>{!! Form::checkbox('bus_types[]','bus_types',false,['onchange'=>"showMenu(this.id)",'id'=>'bus_types'.$value->id]) !!}&nbsp;&nbsp;Bus Type</b></td>
                             <td><span id="{{"showbus_types".$value->id}}" class="display_none"> 
                                     <table  class="table_normal_100">
                                         <tr>
                                             <td>{!! Form::checkbox('bus_types[]','create',false) !!} Add</td>
                                             <td>{!! Form::checkbox('bus_types[]','edit',false) !!}&nbsp;&nbsp;Edit</td>
                                             <td>{!! Form::checkbox('bus_types[]','view',false) !!}&nbsp;&nbsp;View</td>
                                         </tr>   
                                     </table> 
                                 </span></td>
                         </tr>
                         <tr>
                             {!! Form::hidden('user_id',$value->id) !!}
                             <td  align="left" id="{{$value->id}}"><div type="" class="btn btn-success" id="savemenuall" >Save</div></td>
                             <td  align="right"> <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></td>
                         </tr>
                     </table>  
                 </form>

            </div>
        </div>

    </div>
</div>
@endforeach
<script>
    function showMenu(id)
    {
 //   alert(id)

 if($('#'+ id).is(":checked")) 
 {  
   $("#show" + id).show();
 }
    else{
        $("#show" + id).hide();

}

     }
  $(document).on('click', '#savemenuall', function(){
  var  userid=$(this).parent().attr('id');
 
      if($('input:checkbox:checked').length==0)
      {
          alert("Please select at least one checkbox")
      }else
      {
var formData = new FormData($(this).parents('form')[0]);

var action = $(this).attr('id');
$.ajax({
            url: '/permissions/'+action,
            type: 'POST',
            success: function(data,textStatus,xhr){
                alert(data)
                $("#message_show"+userid).show();
               $("#message"+userid).html(data);
               
                },
            
            data: formData,
            cache: false,
            contentType: false,
            processData: false
      

});
      }
});  
    
    
</script>
