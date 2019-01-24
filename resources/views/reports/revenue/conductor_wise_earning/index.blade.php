@extends('layouts.master')
@section('header')
<h1>Conductor-wise Earning Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Conductor-wise Earning</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Select Parameters</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.revenue.conductor_wise_earning.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date");'
                ]) !!}
                @include('reports.revenue.conductor_wise_earning.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Conductor Name (ID)</th>
                                    <th class="text-right">Revenue (Rs)</th>
                                    <th class="text-right">No. of Trips</th>
                                    <th class="text-right">No. of Shifts</th>
                                    <th class="text-right">Average Cash Collection (Rs)</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$rdata)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$rdata->conductor->crew_name.' ('.$rdata->conductor->crew_id.')'}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->auditRemittance->payable_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$rdata->trips->count()}}</td>
                                    <td class="text-right">{{$rdata->shifts->count()}}</td>
                                    @php 
                                        if($rdata->shifts->count() > 0)
                                        {
                                            $avg = $rdata->auditRemittance->payable_amount / $rdata->shifts->count();
                                        }else{
                                            $avg = 0;
                                        }
                                    @endphp
                                    <td class="text-right">{{number_format((float)$avg, 2, '.', '')}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="10"><strong>No Record Found! &#9785</strong></td>
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
        var conductor_id = $('#conductor_id').val();
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
            url: "{{route('reports.revenue.conductor_wise_earning.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                conductor_id: conductor_id,
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
                    //var widths = [22, "*", "*", "*", "*", "*", "*", "*", "*", "*"];
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Conductor Name (ID)', 'style': 'tableHeaderStyle'}, {'text':'Revenue (Rs)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'No. of Trips', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'No. of Shifts', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Average Cash Collection (Rs)', 'style': 'tableHeaderStyle', alignment:'right'}]);
                    var i = 1;
                    $.each(data, function(ind, d){  
                        var trips = 0;
                        if(d.trips)
                        {
                            trips = d.trips.length;
                        }

                        var shifts = 0;
                        if(d.shifts)
                        {
                            shifts = d.shifts.length;
                        }

                        var payable = 0;
                        if(d.audit_remittance)
                        {
                            payable = d.audit_remittance.payable_amount;
                        }

                        var avg = 0;
                        if(shifts && d.audit_remittance)
                        {
                            avg =  payable / shifts;
                        }
                    
                        if(i%2 == 0)
                        {
                            reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+d.conductor.crew_name+' ('+d.conductor.crew_name+')', style:'oddRowStyle'}, {'text':''+parseFloat(payable).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+trips, style:'oddRowStyle', alignment:'right'}, {'text':''+shifts, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(avg).toFixed(2), style:'oddRowStyle', alignment:'right'}]);
                        }else{
                            reportData.push([{'text':''+i}, {'text':''+d.conductor.crew_name+' ('+d.conductor.crew_name+')'}, {'text':''+parseFloat(payable).toFixed(2), alignment:'right'}, {'text':''+trips, alignment:'right'}, {'text':''+shifts, alignment:'right'}, {'text':''+parseFloat(avg).toFixed(2), alignment:'right'}]);
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
        var conductor_id = $('#conductor_id').val();
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
                        + "&conductor_id="+conductor_id;

        var url = "{{route('reports.revenue.conductor_wise_earning.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

