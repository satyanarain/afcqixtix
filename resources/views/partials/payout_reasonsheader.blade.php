@foreach($payout_reasons as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-cc-mastercard"></span>&nbsp;{{ PopUpheadingMain($result) }}</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Payout Reason</b></td>
                        <td class="table_normal">{{ $value->inspector_remark }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Short Reason</b></td>
                        <td class="table_normal">{{ $value->short_reason }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Reason Description</b></td>
                        <td class="table_normal">{{ $value->reason_description }}</td>
                    </tr>
                    <tr>
                        <td><b>Order Number</b></td>
                        <td class="table_normal">{{ $value->order_number }}</td>
                    </tr>
                  </table>  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endforeach
