<div class="col-lg-12 currenttask">
    <div class="well well-sm" style="margin-top:2%"><h1 style="display: inline-block;margin:0px;">Bank Details</h1><a href="{{ route('users.editbankdetail', $user->id)}}" class="kiperda-edit pull-right-button">
        <span class="glyphicon glyphicon-pencil"></span>&nbspEdit
    </a></div>
    
    <table class="table table-hover">
        <tbody>
            <tr >
                <th style="width: 50%;">Beneficiary Name</th><td style="width: 50%;">{{$user->beneficiary_name}}</td>
            </tr>
            <tr>
                <th>Beneficiary Address</th><td>{{$user->beneficiary_address}}</td>
            </tr>
            <tr>
                <th>Beneficiary Pin Code</th><td>{{$user->beneficiary_pin_code}}</td>
            </tr>
            <tr>
                <th>Beneficiary Country</th><td>{{$user->beneficiary_country_name}}</td>
            </tr>
            <tr>
                <th>Account Type</th><td>{{$user->account_type}}</td>
            </tr>
            <tr>
                <th>Account Number</th><td>{{$user->account_number}}</td>
            </tr>
            <tr>
                <th>SWIFT Code</th><td>{{$user->swift_code}}</td>
            </tr>
            <tr>
                <th>IFSC Code</th><td>{{$user->ifsc_code}}</td>
            </tr>
            <tr>
                <th>Routing Code</th><td>{{$user->routing_code}}</td>
            </tr>
        </tbody>
    </table>
    <p style="font-weight: bold;" class="well well-sm"> Bank Branch Details</p>
    <table class="table table-hover">
        <tbody>
            <tr>
                <th style="width: 50%;">Name</th><td style="width: 50%;">{{$user->bank_name}}</td>
            </tr>
            <tr>
                <th>Branch </th><td>{{$user->branch_name}}</td>
            </tr>
            <tr>
                <th>Address</th><td>{{$user->branch_address}}</td>
            </tr>
            <tr>
                <th>Pin Code</th><td>{{$user->bank_pin_code}}</td>
            </tr>
            <tr>
                <th>Country</th><td>{{$user->bank_country}}</td>
            </tr>
            
        </tbody>
    </table>
</div>