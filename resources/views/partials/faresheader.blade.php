@foreach($fares as $value)
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
                        <td><b>Service</b></td>
                        <td class="table_normal">{{ $value->name}}</span></td>
                    </tr>
                    <tr>
                        <td><b>Stage</b></td>
                       <td class="table_normal">{{ $value->stage}}</td>
                    </tr>
                    <tr>
                        <td><b>Adult Ticket Amount (Rs).</b></td>
                        <td class="table_normal">{{ $value->adult_ticket_amount}}</td>
                    </tr>
                    <tr>
                        <td><b>Child Ticket Amount (Rs).</b></td>
                        <td class="table_normal">{{ $value->child_ticket_amount}}</td>
                    </tr>
                    <tr>
                        <td><b>Luggage Ticket Amount (Rs).</b></td>
                        <td class="table_normal">{{ $value->luggage_ticket_amount }}</td>
                    </tr>
                    
                    
                    <tr>
                        <td><b>Luggage Ticket Amount (Rs).</b></td>
                        <td class="table_normal">{{ $value->luggage_ticket_amount }}</td>
                    </tr>
                    <tr>
                        <td><b>Luggage Ticket Amount (Rs).</b></td>
                        <td class="table_normal">{{ $value->luggage_ticket_amount }}</td>
                    </tr>
                    <tr>
                        <td><b>Created By</b></td>
                        <td class="table_normal">{{ $value->username }}</td>
                    </tr>
                    <tr>
                        <td><b>Created At</b></td>
                        <td class="table_normal">{{ dateView($value->created_at) }}</td>
                    </tr>
                    <tr>
                        <td><b>Updated At</b></td>
                        <td class="table_normal">{{ dateView($value->updated_at) }}</td>
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
