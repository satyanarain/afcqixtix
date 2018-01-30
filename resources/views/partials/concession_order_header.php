<div class="modal fade" id="order_id" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>
                <h4 class="viewdetails_details"><span class="fa fa-ins"></span>&nbsp;<?php echo headingMainOrder(); ?></h4>
            </div>
            <div class="modal-body-view">
                <div class="alert alert-success alert-block" id="successMessage_order" style="display:none">
<!--                    <button type="button" class="close" data-dismiss="alert">×</button>	-->
                    <strong id="success_order"></strong>
                </div>
        <div class="gallery">
        <ul class="list-group-order">
            <li class="order-sub"><a href="javascript:void(0);">Service Name</a>
          <a href="javascript:void(0);">Order Number</a>
         <a href="javascript:void(0);">Concession Provider</a>
         <a href="javascript:void(0);">Concession</a>
         </li>  
                <?php echo orderList('concessions','id','name','order_number','concession_provider','concession_master_id','services','service_id','concession_masters','concession_master_id');?>
         </ul>
         </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Close()">Close</button>
                </div>
            </div>
        </div>

    </div>
</div>
