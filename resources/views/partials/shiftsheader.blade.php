@foreach($shifts as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view">
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
               <h4 class="viewdetails_details"><span class="fa fa-calendar"></span>&nbsp;{{ PopUpheadingMain($result) }}</h4>
            </div>
            <div class="modal-body-view">
                <table class="table table-responsive.view">
                    <tr>
                        <td><b>Shift</b></td>
                        <td class="table_normal">{{ $value->shift }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Abbreviation</b></td>
                        <td class="table_normal">{{ $value->abbreviation }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Start Time</b></td>
                        <td class="table_normal">{{ $value->start_time }}</td>
                    </tr>
                    <tr>
                        <td><b>End Time</b></td>
                        <td class="table_normal">{{ $value->end_time }}</td>
                    </tr>
                    <tr>
                        <td><b>Order Number</b></td>
                        <td class="table_normal">{{ $value->order_number }}</td>
                    </tr>
                    <tr>
                        <td><b>System Id</b></td>
                        <td class="table_normal">{{ $value->system_id }}</td>
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
