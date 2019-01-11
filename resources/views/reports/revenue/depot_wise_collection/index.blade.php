@extends('layouts.master')
@section('header')
<h1>Depot-wise Revenue Collection Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Depot-wise Revenue Collection</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create Depot-wise Revenue Collection Report</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.revenue.depot_wise_collection.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.revenue.depot_wise_collection.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}

                <div class="row" style="margin-top: 50px;" id="reportDataBox">
                    <div class="col-md-12">
                        <h4>
                            <button class="btn btn-primary pull-right" id="exportAsPDF">Export as PDF</button> 
                            <button class="btn btn-primary pull-right" style="margin-right: 10px;margin-bottom: 10px;" id="exportAsXLS">Export as XLS</button>
                        </h4>
                        <table class="table table-bordered" id="afcsReportTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th colspan="4" style="text-align: center;">PPT</th>
                                    <th colspan="5" style="text-align: center;">ETM</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Depot</th>
                                    <th>No. of Duties</th>
                                    <th>No. of Trips</th>
                                    <th>Dist. (Kms)</th>
                                    <th>Tkt Cnt</th>
                                    <th>Tkt Amt (Rs)</th>
                                    <th>Pass Sold Cnt</th>
                                    <th>Pass Sold Amt (Rs)</th>
                                    <th>Tkt Cnt</th>
                                    <th>Passenger Cnt</th>
                                    <th>Tkt Amt (Rs)</th>
                                    <th>Pass Sold Cnt</th>
                                    <th>Pass Sold Amt (Rs)</th>
                                    <th>Payout Amt (Rs)</th>
                                    <th>Fine Amt (Rs)</th>
                                    <th>Cash (Rs)</th>
                                    <th>E-Purse (Rs)</th>
                                    <th>Tot Amt (Rs)</th>
                                    <th>Cncs Amt (Rs)</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($consolidatedData) > 0)
                                <tr>
                                    <td>{{$depotName}}</td>
                                    <td>{{$consolidatedData['duties']}}</td>
                                    <td>{{$consolidatedData['trips']}}</td>
                                    <td>{{$consolidatedData['distance']}}</td>
                                    <td>{{$consolidatedData['totalPaperTkts']}}</td>
                                    <td>{{$consolidatedData['totalPaperTktsSum']}}</td>
                                    <td>{{$consolidatedData['duties']}}</td>
                                    <td>{{$consolidatedData['duties']}}</td>
                                    <td>{{$consolidatedData['totalETMTkts']}}</td>
                                    <td>{{$consolidatedData['totalETMTotalPsnger']}}</td>
                                    <td>{{$consolidatedData['totalETMTktsSum']}}</td>
                                    <td>{{$consolidatedData['duties']}}</td>
                                    <td>{{$consolidatedData['duties']}}</td>
                                    <td>{{$consolidatedData['payout']}}</td>
                                    <td>{{$consolidatedData['duties']}}</td>
                                    <td>{{$consolidatedData['duties']}}</td>
                                    <td>{{$consolidatedData['duties']}}</td>
                                    <td>{{$consolidatedData['duties']}}</td>
                                    <td>{{$consolidatedData['concession']}}</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="18">No Record Found!</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

@push('scripts')
@include('partials.report_script')
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click', '#exportAsPDF', function(){
        var depot_id = $('#depot_id').val();
        var etm_no = $('#etm_no').val();
        var date = $('#date').val();

        $.ajax({
            url: "{{route('reports.revenue.depot_wise_collection.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                date: date,
                etm_no: etm_no
            },
            success: function(response)
            {
                console.log(response);
                if(response.status == 'Ok')
                {
                    var columns = response.columns
                    var d = response.data;

                    var reportData = [];
                    if(d)
                    {
                        reportData.push([{'text':'Conductor Name', 'style': 'tableHeaderStyle'}, {'text':'Route', 'style': 'tableHeaderStyle'}, {'text':'Duty', 'style': 'tableHeaderStyle'}, {'text':'Login On', 'style': 'tableHeaderStyle'}, {'text':'Logout On', 'style': 'tableHeaderStyle'}, {'text':'Duty Hours', 'style': 'tableHeaderStyle'}, {'text':'Tkt + Pass', 'style': 'tableHeaderStyle'}, {'text':'Error Tkt Prntd.', 'style': 'tableHeaderStyle'}, {'text':'Battery Percentage On Login', 'style': 'tableHeaderStyle'}, {'text':'Battery Percentage On Logout', 'style': 'tableHeaderStyle'}]);
                        
                        
                        var login_timestamp = "";
                        var logout_timestamp = "";
                        var battery_percentage_on_login = "";
                        var battery_percentage_on_logout = "";

                        if(d.etm_login_details)
                        {
                            if(d.etm_login_details.login_timestamp)
                            {
                                login_timestamp = d.etm_login_details.login_timestamp; 
                            }else {
                                login_timestamp = "";
                            }

                            if(d.etm_login_details.logout_timestamp)
                            {
                                logout_timestamp = d.etm_login_details.logout_timestamp; 
                            }else {
                                logout_timestamp = "";
                            }

                            battery_percentage_on_login = d.etm_login_details.battery_percentage;
                            battery_percentage_on_logout = d.etm_login_details.battery_percentage;
                        }
                        
                        reportData.push([{'text':''+d.conductor.crew_name}, {'text':d.route.route_name}, {'text':''+d.duty.duty_number}, {'text':''+login_timestamp}, {'text':''+logout_timestamp}, {'text':''+d.dutyHours}, {'text':''+d.totalTicket}, {'text':'0'}, {'text':''+battery_percentage_on_login}, {'text':''+battery_percentage_on_logout}]);

                        var metaData = response.meta;
                        var title = response.title;
                        var takenBy = response.takenBy;
                        var serverDate = response.serverDate;
                        Export(metaData, title, reportData, takenBy, serverDate);  
                    }else{
                        alert('No record found');
                    }                  
                }                
            },
            error: function(error)
            {
                console.log(error);
            }
        })
    });

    $(document).on('click', '#exportAsXLS', function(){
        var depot_id = $('#depot_id').val();
        var date = $('#date').val();
        var etm_no = $('#etm_no').val();

        var queryParams = "?depot_id="+depot_id
                        + "&date="+date
                        + "&etm_no="+etm_no;

        var url = "{{route('reports.revenue.depot_wise_collection.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
function validateForm()
    {
        var fromDate = $('#from_date').val();
        if(!fromDate)
        {
            alert('Please enter from date.');
            return false;
        }

        var toDate = $('#to_date').val();
        if(!toDate)
        {
            alert('Please enter to date.');
            return false;
        }

        var splitFrom = fromDate.split('-');
        var splitTo = toDate.split('-');

        console.log(splitFrom)

        //Create a date object from the arrays
        fromDate = new Date(splitFrom[2], splitFrom[1]-1, splitFrom[0]);
        toDate = new Date(splitTo[2], splitTo[1]-1, splitTo[0]);

        if(fromDate > toDate)
        {
            alert('From Date must be smaller than or equal to To Date.');
            return false;
        }

        return true;
    }
</script>
@endpush

