 <div class="modal-content">
            <div class="formmain">
                <div class="plusminusbutton"></div>&nbsp;&nbsp;Model Details
            </div>
            <div class="modal-body-view">
                <div class="alert-new-success alert-block" id="{{"message_show".$permissions->id}}" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong id="{{"message".$permissions->id}}"></strong>
                </div>
                <table  width="100%" class="table">
                        <tr>
                            <td width="15%">Select All</td>
                            <td width="30%">Menu</td>
                            <td width="55%">Action</td>
                        </tr>
                    </table>
                    <div   class="formmain" onclick="showHide(this.id)" id="ACC1{{$permissions->id}}">
                        <div class="plusminusbutton" id="plusminusbuttonACC1{{$permissions->id}}">+</div>&nbsp;&nbsp; Master Details
                    </div>
                    <div class="row1"  id="formACC1{{$permissions->id}}" style="display:none;">
                        <div class="row">  
                            <table  align="left" class="table">
                                {{ menuCreate('users','create','edit','view',$permissions->id,$permissions->users)}}
                                {{ menuCreate('changepasswords','create','edit','view',$permissions->id,$permissions->changepasswords)}}
                                {{ menuCreate('permissions','create','edit','view',$permissions->id,$permissions->permissions) }}
                                {{ menuCreate('depots','create','edit','view',$permissions->id,$permissions->depots) }}
                                {{ menuCreate('bus_types','create','edit','view',$permissions->id,$permissions->bus_types)}}
                                {{ menuCreate('services','create','edit','view',$permissions->id,$permissions->services)}}
                                {{ menuCreate('vehicles','create','edit','view',$permissions->id,$permissions->vehicles)}}
                                {{ menuCreate('shifts','create','edit','view',$permissions->id,$permissions->shifts)}}
                                {{ menuCreate('stops','create','edit','view',$permissions->id,$permissions->stops)}}
                                {{ menuCreate('routes','create','edit','view',$permissions->id,$permissions->routes)}}
                                {{ menuCreate('duties','create','edit','view',$permissions->id,$permissions->duties)}}
                                {{ menuCreate('targets','create','edit','view',$permissions->id,$permissions->targets)}}
                                {{ menuCreate('trips','create','edit','view',$permissions->id,$permissions->trips)}}
                                {{ menuCreate('fares','create','edit','view',$permissions->id,$permissions->fares)}}
                                {{ menuCreate('concession_fare_slabs','create','edit','view',$permissions->id,$permissions->concession_fare_slabs)}}
                                {{ menuCreate('concessions','create','edit','view',$permissions->id,$permissions->concessions)}}
                                {{ menuCreate('trip_cancellation_reasons','create','edit','view',$permissions->id,$permissions->trip_cancellation_reasons)}}
                                {{ menuCreate('inspector_remarks','create','edit','view',$permissions->id,$permissions->inspector_remarks)}}
                                {{ menuCreate('payout_reasons','create','edit','view',$permissions->id,$permissions->payout_reasons)}}
                                {{ menuCreate('denominations','create','edit','view',$permissions->id,$permissions->denominations)}}
                                {{ menuCreate('pass_types','create','edit','view',$permissions->id,$permissions->pass_types)}}
                                {{ menuCreate('crews','create','edit','view',$permissions->id,$permissions->crews)}}
                                
                            </table> 
                        </div>
                    </div>
                    <div   class="formmain" onclick="showHide(this.id)" id="ACC2{{$permissions->id}}">
                        <div class="plusminusbutton" id="plusminusbuttonACC2{{$permissions->id}}">+</div>&nbsp;&nbsp;ETM Details
                    </div>
                    <div class="row1"  id="formACC2{{$permissions->id}}" style="display:none;">
                        <div class="row">  
                            <table class="table table-responsive.view">
                                 {{ menuCreate('ETM_details','create','edit','view',$permissions->id,$permissions->ETM_details)}}
                                 
                        </table> 
                        </div>
                    </div>
                    <div   class="formmain" onclick="showHide(this.id)" id="ACC3{{$permissions->id}}">
                        <div class="plusminusbutton" id="plusminusbuttonACC3{{$permissions->id}}">+</div>&nbsp;&nbsp;Miscellaneous
                    </div>
                    <div class="row1"  id="formACC3{{$permissions->id}}" style="display:none;">
                        <div class="row">  
                            <table class="table table-responsive.view">
                                 {{ menuCreate('versions','create','edit','view',$permissions->id,$permissions->versions)}}
                                 {{ menuCreate('settings','create','edit','view',$permissions->id,$permissions->settings)}}
                        </table> 
                        </div>
                    </div>
                    <div   class="formmain" onclick="showHide(this.id)" id="ACC4{{$value->id}}">
                        <div class="plusminusbutton" id="plusminusbuttonACC4{{$value->id}}">+</div>&nbsp;&nbsp;Inventories
                    </div>
                     <div class="row1"  id="formACC4{{$value->id}}" style="display:none;border:#ccc 1px solid;">
                        <div class="row">  
                            <table class="table table-responsive.view">
                                 {{ menuCreate('inventories','create','edit','view',$value->id,$value->inventories)}}
                        </table> 
                        </div>
                    </div>
              </div>
        </div>

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
            $("#showview" + id).prop('checked', true);
         } else {
            $("#show" + id).hide();
            $("#showview" + id).prop('checked', false);

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

