@foreach($concessions as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>
                <h4 class="viewdetails_details"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{ PopUpheadingMain($result) }}</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Service</b></td>
                        <td class="table_normal">{{ $value->name}}</span></td>
                    </tr>
                    <tr>
                        <td><b>Concession</b></td>
                       <td class="table_normal">{{ $value->concession_provider_master_id}}</td>
                    </tr>
                    <tr>
                        <td><b>Concession Provider</b></td>
                       <td class="table_normal">{{ $value->concession_master_id}}</td>
                    </tr>
                    <tr>
                        <td><b>Description</b></td>
                        <td class="table_normal">{{ $value->description}}</td>
                    </tr>
                    <tr>
                        <td><b>Order Number</b></td>
                        <td class="table_normal">{{ $value->order_number}}</td>
                    </tr>
                    <tr>
                        <td><b>Percentage</b></td>
                        <td class="table_normal">{{ $value->percentage }}</td>
                    </tr>
                   
                    <tr>
                        <td><b>Pass Type</b></td>
                        <td class="table_normal">{{ $value->pass_type_master_id }}</td>
                    </tr>
                  
                    <tr>
                        <td><b>Print Ticket</b></td>
                        <td class="table_normal">{{ displayView($value->print_ticket) }}</td>
                    </tr>
                    <tr>
                        <td><b>ETM Hot Key</b></td>
                        <td class="table_normal">{{ displayView($value->etm_hot_key_master_id) }}</td>
                    </tr>
                   
                    <tr>
                        <td><b>Concession Allowed on(for all days of the year leave field blank)</b></td>
                        <td class="table_normal">{{ displayView($value->concession_allowed_on) }}</td>
                    </tr>
                    <tr>
                        <td><b>Flat Fare</b></td>
                        <td class="table_normal">{{ displayView($value->flat_fare) }}</td>
                    </tr>
                    <tr>
                        <td><b>Flat Fare Amount</b></td>
                        <td class="table_normal">{{ displayView($value->flat_fare_amount) }}</td>
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
  
                    