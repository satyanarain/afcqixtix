@extends('layouts.master')
@section('header')
<h1>ETM Issue Details Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>ETM Issue Details</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create ETM Issue Details</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.etm.issue_details.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.etm.issue_details.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}

                @if(isset($data))
                <div class="row" style="margin-top: 50px;" id="reportDataBox">
                    <div class="col-md-12">
                        <h4>
                            <button class="btn btn-primary pull-right" id="exportAsPDF">Export as PDF</button> 
                            <button class="btn btn-primary pull-right" style="margin-right: 10px;margin-bottom: 10px;" id="exportAsXLS">Export as XLS</button>
                        </h4>
                        <table class="table" id="afcsReportTable">
                            <thead>
                                <tr>
                                    <th>Abstract</th>
                                    <th>Waybill</th>
                                    <th>Route</th>
                                    <th>Duty</th>
                                    <th>Shift</th>
                                    <th>Conductor</th>
                                    <th>Vehicle</th>
                                    <th>ETM No.</th>
                                    <th>Issued By</th>
                                    <th>Received By</th>
                                    <th>Issuance Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$da)
                                <tr>
                                    <td>{{$da->abstract_no}}</td>
                                    <td>{{$da->waybill_no}}</td>
                                    <td>{{$da->route->route_name}}</td>
                                    <td>{{$da->duty->duty_number}}</td>
                                    <td>{{$da->shift->shift}}</td>
                                    <td>{{$da->conductor->crew_name}}</td>
                                    <td>{{$da->vehicle->vehicle_registration_number}}</td>
                                    <td>{{$da->etm->etm_no}}</td>
                                    <td>{{$da->depotHead->name}}</td>
                                    <td>{{$da->conductor->crew_name}}</td>
                                    <td>{{date('d-m-Y H:i:s', strtotime($da->etm_issue_time))}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td>No Record Found!</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{$data->appends(request()->input())->links()}}
                    </div>
                </div>
                @endif
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
        var shift_id = $('#shift_id').val();
        var fromDate = $('#from_date').val();
        if(!fromDate)
        {
            return alert('Please enter from date.');
        }

        var toDate = $('#to_date').val();
        if(!toDate)
        {
            return alert('Please enter to date.');
        }

        var splitFrom = fromDate.split('-');
        var splitTo = toDate.split('-');

        //Create a date object from the arrays
        fDate = new Date(splitFrom[2], splitFrom[1]-1, splitFrom[0]);
        tDate = new Date(splitTo[2], splitTo[1]-1, splitTo[0]);

        if(fDate > tDate)
        {
            return alert('From Date must be smaller than or equal to To Date.');
        }

        $.ajax({
            url: "{{route('reports.etm.issue_details.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                from_date: fromDate,
                to_date: toDate,
                etm_no: etm_no,
                shift_id: shift_id
            },
            success: function(response)
            {
                console.log(response);
                if(response.status == 'Ok')
                {
                    var columns = response.columns
                    var data = response.data;

                    var reportData = [];
                    if(data.length > 0)
                    {
                        reportData.push([{'text':'Abstract', 'style': 'tableHeaderStyle'}, {'text':'Waybill', 'style': 'tableHeaderStyle'}, {'text':'Route', 'style': 'tableHeaderStyle'}, {'text':'Duty', 'style': 'tableHeaderStyle'}, {'text':'Shift', 'style': 'tableHeaderStyle'}, {'text':'Conductor', 'style': 'tableHeaderStyle'}, {'text':'Vehicle', 'style': 'tableHeaderStyle'}, {'text':'ETM No.', 'style': 'tableHeaderStyle'}, {'text':'Issued By', 'style': 'tableHeaderStyle'}, {'text':'Received By', 'style': 'tableHeaderStyle'}, {'text':'Issuance Timestamp', 'style': 'tableHeaderStyle'}]);
                        
                        
                        data.map((d) => {
                            reportData.push([{'text':''+d.abstract_no}, {'text':d.waybill_no}, {'text':d.route.route_name}, {'text':''+d.duty.duty_number}, {'text':''+d.shift.shift}, {'text':''+d.conductor.crew_name}, {'text':''+d.vehicle.vehicle_registration_number}, {'text':''+d.etm.etm_no}, {'text':d.depot_head.name}, {'text':d.conductor.crew_name}, {'text':d.etm_issue_time}]);
                        });                            
                    }

                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    Export(metaData, title, reportData, takenBy, serverDate, '*', 'lightHorizontalLines');                    
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
        var fromDate = $('#from_date').val();
        if(!fromDate)
        {
            return alert('Please enter from date.');
        }

        var toDate = $('#to_date').val();
        if(!toDate)
        {
            return alert('Please enter to date.');
        }

        var splitFrom = fromDate.split('-');
        var splitTo = toDate.split('-');

        //Create a date object from the arrays
        fDate = new Date(splitFrom[2], splitFrom[1]-1, splitFrom[0]);
        tDate = new Date(splitTo[2], splitTo[1]-1, splitTo[0]);

        if(fDate > tDate)
        {
            return alert('From Date must be smaller than or equal to To Date.');
        }

        var queryParams = "?depot_id="+depot_id
                        + "&from_date="+fromDate
                        + "&to_date="+toDate;

        var url = "{{route('reports.etm.issue_details.getexcelreport')}}"+queryParams;

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

