@extends('layouts.master')
@section('header')
<h1>Bus-wise Earning Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Bus-wise Earning</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create Bus-wise Earning Report</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.revenue.bus_wise_earning.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.revenue.bus_wise_earning.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
                @if(isset($data))
                <div class="row" style="margin-top: 50px;" id="reportDataBox">
                    <div class="col-md-12">
                        @if(count($data) > 0)
                        <h4>
                            <button class="btn btn-primary pull-right" id="exportAsPDF">Export as PDF</button> 
                            <button class="btn btn-primary pull-right" style="margin-right: 10px;margin-bottom: 10px;" id="exportAsXLS">Export as XLS</button>
                        </h4>
                        @endif
                        <table class="table table-bordered" id="afcsReportTable">
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Date</th>
                                    <th>Bus No.</th>
                                    <th class="text-right">Total No. of Shifts</th>
                                    <th class="text-right">Total No. of Trips</th>
                                    <th class="text-right">Total Km.</th>
                                    <th class="text-right">Total Amt. (Rs)</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$rdata)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{date('d-m-Y', strtotime($rdata->created_at))}}</td>
                                    <td>{{$rdata->vehicle->vehicle_registration_number}}</td>
                                    <td class="text-right">{{$rdata->shifts->count()}}</td>
                                    <td class="text-right">{{$rdata->trips->count()}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->trips->pluck('route')->sum('distance'), 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->auditRemittance->payable_amount, 2, '.', '')}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="7"><strong>No Record Found! &#9785</strong></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="pull-right"> 
                            {{$data->appends(request()->input())->links()}}
                        </div>
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
        var bus_no = $('#bus_no').val();
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

        $.ajax({
            url: "{{route('reports.revenue.bus_wise_earning.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                bus_no: bus_no,
                from_date: fromDate,
                to_date: toDate
            },
            success: function(response)
            {
                if(response.status == 'Ok')
                {
                    var data = response.data;
                    console.log(data)
                    var reportData = [];
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Date', 'style': 'tableHeaderStyle'}, {'text':'Bus No.', 'style': 'tableHeaderStyle'}, {'text':'No. of Shifts', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'No. of Trips', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Total Km.', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Total Amt. (Rs)', 'style': 'tableHeaderStyle', alignment:'right'}]);
                    var i = 1;
                    $.each(data, function(ind, d){
                        var shifts = d.shifts;
                        var trips = d.trips;
                        console.log(shifts.length)
                        var total_amt = 0;
                        if(d.audit_remittance)
                        {
                            total_amt = d.audit_remittance.payable_amount;
                        }
                        var distance = 0;
                        if(i%2 == 0)
                        {
                            reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+d.created_at, style:'oddRowStyle'}, {'text':''+d.vehicle.vehicle_registration_number, style:'oddRowStyle'}, {'text':''+shifts.length, style:'oddRowStyle', alignment:'right'}, {'text':''+trips.length, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(distance).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(total_amt).toFixed(2), style:'oddRowStyle', alignment:'right'}]);
                        }else{
                            reportData.push([{'text':''+i}, {'text':''+d.created_at}, {'text':''+d.vehicle.vehicle_registration_number}, {'text':''+shifts.length, alignment:'right'}, {'text':''+trips.length, alignment:'right'}, {'text':''+parseFloat(distance).toFixed(2), alignment:'right'}, {'text':''+parseFloat(total_amt).toFixed(2), alignment:'right'}]);
                        }
                        i++;
                    })
                
                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    Export(metaData, title, reportData, takenBy, serverDate, '*', 'noBorders');  
                                    
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
        var bus_no = $('#bus_no').val();
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

        var queryParams = "?depot_id="+depot_id
                        + "&from_date="+fromDate
                        + "&to_date="+toDate
                        + "&bus_no="+bus_no;

        var url = "{{route('reports.revenue.bus_wise_earning.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

