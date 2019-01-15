@extends('layouts.master')
@section('header')
<h1>Trip Cancellation Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Trip Cancellation</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create Trip Cancellation</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.etm.trip_cancellation.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.etm.trip_cancellation.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>S. No.</th>
                                    <th>Time</th>
                                    <th>Route</th>
                                    <th>Duty</th>
                                    <th>Shift</th>
                                    <th>Bus No.</th>
                                    <th>Conductor</th>
                                    <th>Trip No.</th>
                                    <th>Stop</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$da)
                            @if($da->wayBill)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{date('H:i:s', strtotime($da->cancellation_timestamp))}}</td>
                                    <td>{{$da->wayBill->route->route_name}}</td>
                                    <td>{{$da->wayBill->duty->duty_number}}</td>
                                    <td>{{$da->wayBill->shift->shift}}</td>
                                    <td>{{$da->wayBill->vehicle->vehicle_registration_number}}</td>
                                    <td>{{$da->wayBill->conductor->crew_name.' ('.$da->wayBill->conductor->crew_id.')'}}</td>
                                    <td>{{$da->trip_no}}</td>
                                    <td>{{isset($da->stop) ? $da->stop->stop : 'N/A'}}</td>
                                    <td>{{$da->reason->reason_description}}</td>
                                </tr>
                            @endif
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
        var route_id = $('#route_id').val();
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
            url: "{{route('reports.etm.trip_cancellation.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                route_id: route_id,
                from_date: fromDate,
                to_date: toDate
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
                        reportData.push([{'text':'Time', 'style': 'tableHeaderStyle'}, {'text':'Route', 'style': 'tableHeaderStyle'}, {'text':'Duty', 'style': 'tableHeaderStyle'}, {'text':'Shift', 'style': 'tableHeaderStyle'}, {'text':'Bus No.', 'style': 'tableHeaderStyle'}, {'text':'Conductor', 'style': 'tableHeaderStyle'}, {'text':'Trip No.', 'style': 'tableHeaderStyle'}, {'text':'Stop', 'style': 'tableHeaderStyle'}, {'text':'Reason', 'style': 'tableHeaderStyle'}]);
                        
                        
                        data.map((d) => {
                            var stop = '';
                            if(d.stop)
                            {
                                stop = d.stop.stop;
                            }else{
                                stop = "N/A";
                            }
                            reportData.push([{'text':d.created_at}, {'text':d.way_bill.route.route_name}, {'text':d.way_bill.duty.duty_number}, {'text':d.way_bill.shift.shift}, {'text':d.way_bill.vehicle.vehicle_registration_number}, {'text':d.way_bill.conductor.crew_name+' ('+d.way_bill.conductor.crew_id+')'}, {'text':d.trip_no}, {'text':stop}, {'text':d.reason.reason_description}]);
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
        var route_id = $('#route_id').val();
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
                        + "&route_id="+route_id
                        + "&from_date="+fromDate
                        + "&to_date="+toDate;

        var url = "{{route('reports.etm.trip_cancellation.getexcelreport')}}"+queryParams;

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

