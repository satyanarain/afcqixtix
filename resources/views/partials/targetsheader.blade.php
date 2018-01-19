@foreach($targets as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>
                <h4 class="viewdetails_details"><span class="fa fa-bus"></span>&nbsp;Bus Type</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Route</b></td>
                        <td class="table_normal">{{ $value->route }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Duty</b></td>
                       <td class="table_normal">{{ $value->duty_number}}</td>
                    </tr>
                    <tr>
                        <td><b>Shift</b></td>
                        <td class="table_normal">{{ $value->shift}}</td>
                    </tr>
                    <tr>
                        <td><b>Trip</b></td>
                        <td class="table_normal">{{ $value->trip }}</td>
                    </tr>
                    <tr>
                        <td><b>EPKM</b></td>
                        <td class="table_normal">{{ $value->epkm }}</td>
                    </tr>
                    <tr>
                        <td><b>Income</b></td>
                        <td class="table_normal">{{ $value->income}}</td>
                    </tr>
                    <tr>
                        <td><b>Incentive</b></td>
                        <td class="table_normal">{{ displayView($value->incentive) }}</td>
                    </tr>
                    <tr>
                        <td><b>Driver Share</b></td>
                        <td class="table_normal">{{ displayView($value->driver_share) }}</td>
                    </tr>
                    <tr>
                        <td><b>Conductor Share</b></td>
                        <td class="table_normal">{{ displayView($value->conductor_share) }}</td>
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
