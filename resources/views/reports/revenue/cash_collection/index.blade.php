@extends('layouts.master')
@section('header')
<h1>Cash Collection Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Cash Collection</a></li>
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
                'route' => 'reports.revenue.cash_collection.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date");'
                ]) !!}
                @include('reports.revenue.cash_collection.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Collected By</th>
                                    <th>Route - Duty - Shift</th>
                                    <th>Abstract No.</th>
                                    <th>Challan No.</th>
                                    <th>Conductor Name (ID)</th>
                                    <th class="text-right">Amt. Payable (Rs)</th>
                                    <th class="text-right">Adjustment Amt. (Rs)</th>
                                    <th class="text-right">Amt. Collected (Rs)</th>
                                    <th>Collected On</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$rdata)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$rdata->collector->name}}</td>
                                    <td>{{$rdata->waybill->route->route_name.' - '.$rdata->waybill->duty->duty_number.' - '.$rdata->waybill->shift->shift}}</td>
                                    <td>{{$rdata->abstract_no}}</td>
                                    <td>{{$rdata->cash_challan_no}}</td>
                                    <td>{{$rdata->waybill->conductor->crew_name.' ('.$rdata->waybill->conductor->crew_id.')'}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->amount_payable, 2, '.', '')}}</td>
                                    @php $diff = $rdata->amount_payable - $rdata->waybill->auditRemittance->payable_amount; @endphp
                                    <td class="text-right">{{number_format((float)$diff, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->waybill->auditRemittance->payable_amount, 2, '.', '')}}</td>
                                    <td>{{date('d-m-Y H:i:s', strtotime($rdata->submitted_at))}}</td>
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
            url: "{{route('reports.revenue.cash_collection.getpdfreport')}}",
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
                    var widths = [22, "*", "*", "*", "*", "*", "*", "*", "*", "*"];
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Collected By', 'style': 'tableHeaderStyle'}, {'text':'Route - Duty - Shift', 'style': 'tableHeaderStyle'}, {'text':'Abstract No.', 'style': 'tableHeaderStyle'}, {'text':'Challan No.', 'style': 'tableHeaderStyle'}, {'text':'Conductor Name (ID)', 'style': 'tableHeaderStyle'}, {'text':'Amt. Payable (Rs)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Adjustment Amt. (Rs)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Amt. Collected (Rs)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Collected On', 'style': 'tableHeaderStyle'}]);
                    var i = 1;
                    $.each(data, function(ind, d){  
                        var route_duty_shift = d.waybill.route.route_name +' - '+d.waybill.duty.duty_number +' - '+d.waybill.shift.shift;
                        
                        var amount_collected = 0;
                        if(d.waybill.audit_remittance)
                        {
                            amount_collected = d.waybill.audit_remittance.payable_amount;
                        }
                        var adjust_amount = parseInt(d.amount_payable) - parseInt(amount_collected);
                    
                        if(i%2 == 0)
                        {
                            reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+d.collector.name, style:'oddRowStyle'}, {'text':''+route_duty_shift, style:'oddRowStyle'}, {'text':''+d.abstract_no, style:'oddRowStyle'}, {'text':''+d.cash_challan_no, style:'oddRowStyle'}, {'text':''+d.waybill.conductor.crew_name+' ('+d.waybill.conductor.crew_name+')', style:'oddRowStyle'}, {'text':''+parseFloat(d.amount_payable).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(adjust_amount).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(amount_collected).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+d.submitted_at, style:'oddRowStyle'}]);
                        }else{
                            reportData.push([{'text':''+i}, {'text':''+d.collector.name}, {'text':''+route_duty_shift}, {'text':''+d.abstract_no}, {'text':''+d.cash_challan_no}, {'text':''+d.waybill.conductor.crew_name+' ('+d.waybill.conductor.crew_name+')'}, {'text':''+parseFloat(d.amount_payable).toFixed(2), alignment:'right'}, {'text':''+parseFloat(adjust_amount).toFixed(2), alignment:'right'}, {'text':''+parseFloat(amount_collected).toFixed(2), alignment:'right'}, {'text':''+d.submitted_at}]);   
                        }
                        i++;
                    })
                
                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    Export(metaData, title, reportData, takenBy, serverDate, widths, 'noBorders');  
                                    
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

        var url = "{{route('reports.revenue.cash_collection.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

