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
                        <tr><?php  //print_r($value); ?>
                            <td>Menu</td>
                            <td>Action</td>
                        </tr>
                        {{ menuCreate('users','create','edit','view',$value->id,$value->users)}}
                        {{ menuCreate('changepasswords','create','edit','view',$value->id,$value->changepasswords)}}
                        {{ menuCreate('permissions','create','edit','view',$value->id,$value->permissions) }}
                        {{  menuCreate('depots','create','edit','view',$value->id,$value->depots) }}
                        {{ menuCreate('bus_types','create','edit','view',$value->id,$value->bus_types)}}
                        {{ menuCreate('vehicles','create','edit','view',$value->id,$value->vehicles)}}
                        {{ menuCreate('shifts','create','edit','view',$value->id,$value->shifts)}}
                        {{ menuCreate('stops','create','edit','view',$value->id,$value->stops)}}
                        {{ menuCreate('routes','create','edit','view',$value->id,$value->routes)}}
                        {{ menuCreate('duties','create','edit','view',$value->id,$value->duties)}}
                        {{ menuCreate('targets','create','edit','view',$value->id,$value->targets)}}
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
    
    
    
function checkAll(id,cid) {
  //alert(cid)
   $('.'+cid).not(id).prop('checked', id.checked);
   
   var final_id=cid.replace('checkAll','');
   //value = value.replace(".", ":");
  
   
   if ($('#' + cid).is(":checked"))
        {
            // alert(final_id)
            $("#show" + final_id).show();
        } else {
            // alert(final_id)
            $("#show" + final_id).hide();

        }
}

    function showMenu(id)
    {
     if ($('#' + id).is(":checked"))
        {
            $("#show" + id).show();
        } else {
            $("#show" + id).hide();

        }

    }
    
    
    $(document).on('click', '#savemenuall', function () {
        var userid = $(this).parent().attr('id');

        if ($('input:checkbox:checked').length == 0)
        {
            alert("Please select at least one checkbox")
        } else
        {
            var formData = new FormData($(this).parents('form')[0]);

            var action = $(this).attr('id');
            $.ajax({
                url: '/permissions/' + action,
                type: 'POST',
                success: function (data, textStatus, xhr) {
                    //alert(data)
                   $("#message_show" + userid).show();
                   $("#message" + userid).html(data);

                },

                data: formData,
                cache: false,
                contentType: false,
                processData: false


            });
        }
    });
</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

