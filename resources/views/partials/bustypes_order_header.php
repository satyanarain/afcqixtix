<div class="modal fade" id="order_id" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>
                <h4 class="viewdetails_details"><span class="fa fa-bus"></span>&nbsp;Bus Type</h4>
            </div>
            <div class="modal-body-view">
                <div class="alert alert-success alert-block" id="successMessage_show">
<!--                    <button type="button" class="close" data-dismiss="alert">×</button>	-->
                    <strong id="success_order">{{ $message }}</strong>
                </div>
                <?php echo orderList('bus_types','id','bus_type','order_number','abbreviation'); ?>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Close()">Close</button>
                </div>
            </div>
        </div>

    </div>
</div>
