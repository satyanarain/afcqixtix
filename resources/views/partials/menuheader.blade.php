@foreach($users as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view">
                <!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-menu"></span>&nbsp;Menu Details</h4>
            </div>
            <div class="modal-body-view">
                <div class="alert-new-success alert-block" id="{{"message_show".$value->id}}" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong id="{{"message".$value->id}}"></strong>
                </div>

                <form autocomplete="off">
                    <table class="table table-responsive.view">
                        <tr><?php //print_r($value);  ?>
                            <td>Select All</td>
                            <td>Menu</td>
                            <td>Action</td>
                        </tr>
                    </table>
                    <div   class="formmain" onclick="showHide(this.id)" id="ACC1{{$value->id}}">
                        <div class="plusminusbutton" id="plusminusbuttonACC1{{$value->id}}">+</div>&nbsp;&nbsp; Master Details
                    </div>
                    <div class="row1"  id="formACC1{{$value->id}}">
                        <div class="row">  
                            <table class="table table-responsive.view" style="border:#000 1px solid;">
                                {{ menuCreate('users','create','edit','view',$value->id,$value->users)}}
                                {{ menuCreate('changepasswords','create','edit','view',$value->id,$value->changepasswords)}}
                                {{ menuCreate('permissions','create','edit','view',$value->id,$value->permissions) }}
                                {{  menuCreate('depots','create','edit','view',$value->id,$value->depots) }}
                                {{ menuCreate('bus_types','create','edit','view',$value->id,$value->bus_types)}}
                                {{ menuCreate('services','create','edit','view',$value->id,$value->services)}}
                                {{ menuCreate('vehicles','create','edit','view',$value->id,$value->vehicles)}}
                                {{ menuCreate('shifts','create','edit','view',$value->id,$value->shifts)}}
                                {{ menuCreate('stops','create','edit','view',$value->id,$value->stops)}}
                                {{ menuCreate('routes','create','edit','view',$value->id,$value->routes)}}
                                {{ menuCreate('duties','create','edit','view',$value->id,$value->duties)}}
                                {{ menuCreate('targets','create','edit','view',$value->id,$value->targets)}}
                                {{ menuCreate('trips','create','edit','view',$value->id,$value->trips)}}
                                {{ menuCreate('fares','create','edit','view',$value->id,$value->fares)}}
                                {{ menuCreate('concession_fare_slabs','create','edit','view',$value->id,$value->concession_fare_slabs)}}
                                {{ menuCreate('concessions','create','edit','view',$value->id,$value->concessions)}}
                                {{ menuCreate('trip_cancellation_reasons','create','edit','view',$value->id,$value->trip_cancellation_reasons)}}
                                {{ menuCreate('inspector_remarks','create','edit','view',$value->id,$value->inspector_remarks)}}
                                {{ menuCreate('payout_reasons','create','edit','view',$value->id,$value->payout_reasons)}}
                                {{ menuCreate('denominations','create','edit','view',$value->id,$value->denominations)}}
                                {{ menuCreate('pass_types','create','edit','view',$value->id,$value->pass_types)}}
                                {{ menuCreate('crews','create','edit','view',$value->id,$value->crews)}}
                                
                                
                            </table> 
                        </div>
                    </div>
                    <div   class="formmain" onclick="showHide(this.id)" id="ACC2{{$value->id}}">
                        <div class="plusminusbutton" id="plusminusbuttonACC2{{$value->id}}">+</div>&nbsp;&nbsp;ETM Details
                    </div>
                     <div class="row1"  id="formACC2{{$value->id}}" style="display:none;border:#ccc 1px solid;">
                        <div class="row">  
                            <table class="table table-responsive.view">
                                 {{ menuCreate('etm_details','create','edit','view',$value->id,$value->etm_details)}}
                        </table> 
                        </div>
                    </div>
                    <div   class="formmain" onclick="showHide(this.id)" id="ACC3{{$value->id}}">
                        <div class="plusminusbutton" id="plusminusbuttonACC3{{$value->id}}">+</div>&nbsp;&nbsp;Miscellaneous
                    </div>
                    <div class="row1"  id="formACC3{{$value->id}}" style="display:none;">
                        <div class="row">  
                            <table class="table table-responsive.view">
                                 {{ menuCreate('versions','create','edit','view',$value->id,$value->versions)}}
                                 {{ menuCreate('settings','create','edit','view',$value->id,$value->settings)}}
                        </table> 
                        </div>
                    </div>
                    <div   class="formmain" onclick="showHide(this.id)" id="ACC4{{$permissions->id}}">
                        <div class="plusminusbutton" id="plusminusbuttonACC2{{$permissions->id}}">+</div>&nbsp;&nbsp;Inventories
                    </div>
                    <div class="row1"  id="formACC4{{$permissions->id}}" style="display:none;">
                        <div class="row">  
                            <table class="table table-responsive.view">
                                 {{ menuCreate('inventories','create','edit','view',$permissions->id,$permissions->inventories)}}
                        </table> 
                        </div>
                    </div>
                    
                     <table class="table table-responsive.view">
                        <tr>
                            {!! Form::hidden('user_id',$value->id) !!}
                            <td  align="left" id="{{$value->id}}"><div type="" class="btn btn-success" id="savemenuall" >Save</div></td>
                            <td  align="left"></td>
                            <td  align="left"></td>
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



    function checkAll(id, cid) {
        //alert(cid)
        $('.' + cid).not(id).prop('checked', id.checked);

        var final_id = cid.replace('checkAll', '');
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

