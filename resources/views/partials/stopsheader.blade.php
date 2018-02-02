@foreach($stops as $value)
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
                        <td><b>Stop</b></td>
                        <td class="table_normal">{{ $value->stop }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Stop ID</b></td>
                        <td class="table_normal">{{ $value->stop_id }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Abbreviation</b></td>
                        <td class="table_normal">{{ $value->abbreviation }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Short Name</b></td>
                        <td class="table_normal">{{ $value->short_name }}</td>
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
