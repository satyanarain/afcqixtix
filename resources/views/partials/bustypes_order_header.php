<div class="modal fade" id="order_id" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>
                <h4 class="viewdetails_details"><span class="fa fa-bus"></span>&nbsp;Bus Type</h4>
            </div>
            <div class="modal-body-view">
                <div class="alert alert-success alert-block" id="successMessage_order" style="display:none">
<!--                    <button type="button" class="close" data-dismiss="alert">×</button>	-->
                    <strong id="success_order"></strong>
                </div>
                    <ul class="list-group-order">
            <li class="order-sub"><a href="javascript:void(0);">Bus Type</a>
          <a href="javascript:void(0);">Order Number</a>
         <a href="javascript:void(0);">Abbreviation</a>
         </li> 
                <?php echo orderList('bus_types','id','bus_type','order_number','abbreviation'); ?>
         </ul>
         </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Close()">Close</button>
                </div>
            </div>
        </div>

    </div>
</div>
