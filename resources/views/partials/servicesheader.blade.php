@foreach($services as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view">
                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>
               <h4 class="viewdetails_details"><span class="glyphicon glyphicon-cog"></span>&nbsp;Service Details</h4>
            </div>
            <div class="modal-body-view">
                <table class="table table-responsive.view">
                    <tr>
                        <td><b>Bus Type</b></td>
                        <td class="table_normal">{{ $value->bus_type }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Service Name</b></td>
                        <td class="table_normal">{{ $value->name }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Short Name</b></td>
                        <td class="table_normal">{{ $value->short_name }}</td>
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
