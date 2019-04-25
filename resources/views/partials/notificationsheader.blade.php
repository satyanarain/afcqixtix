@foreach($notifications as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view">
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
               <h4 class="viewdetails_details"><span class="fa fa-bus"></span>&nbsp;{{ PopUpheadingMain($result) }}</h4>
            </div>
            <div class="modal-body-view">
                <table class="table table-responsive.view">
                    <tr>
                        <td><b>Notification Type</b></td>
                        <td class="table_normal">{{ $value->notifications_type_name }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td class="table_normal">{{ $value->email }}</span></td>
                    </tr>
                    @include('partials.userhistory')
                </table>  

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endforeach