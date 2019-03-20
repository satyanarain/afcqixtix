@extends('layouts.master')
@section('header')
<h1>Route Wise Summary Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Route Wise Summary</a></li>
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
                'route' => 'reports.revenue.route_wise_summary.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date", "", "", "", "", "", "route_id");'
                ]) !!}
                @include('reports.revenue.route_wise_summary.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <!-- <th>From Stop - To Stop</th> -->
                                    <th>Route</th>
                                    <th class="text-right">Distance</th>
                                    <th class="text-right">Sch. Trips</th>
                                    <th class="text-right">Opr. Trips</th>
                                    <th class="text-right">Sch. KMS</th>
                                    <th class="text-right">Opr. KMS</th>
                                    <th class="text-right">Income (Rs)</th>
                                    <th class="text-right">EPKM ETM</th>
                                    <th class="text-right">PPT Tkts/Pass</th>
                                    <th class="text-right">ETM Pasngr</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$rdata)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$rdata['route']}}</td>
                                    <!-- <td>{{$rdata->fromStop->short_name}}</td>  -->
                                    <td class="text-right">{{number_format((float)$rdata['distance'], 2, '.', '')}}</td>
                                    <td class="text-right">{{$rdata['tripsCount']}}</td>
                                    <td class="text-right">{{$rdata['tripsCount']}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['distance'], 2, '.', '')}}</td>    
                                    <td class="text-right">{{number_format((float)$rdata['distance'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['totalAmount'], 2, '.', '')}}</td>
                                    @php $epkm = $rdata['totalAmount']/$rdata['distance'];@endphp
                                    <td class="text-right">{{number_format((float)$epkm, 2, '.', '')}}</td>
                                    <td class="text-right">{{$rdata['ticketsCount']}}</td>
                                    <td class="text-right">{{$rdata['passengersCount']}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="11"><strong>No Record Found! &#9785</strong></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
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
            url: "{{route('reports.revenue.route_wise_summary.getpdfreport')}}",
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
                if(response.status == 'Ok')
                {
                    var data = response.data;
                    console.log(data)
                    var reportData = [];
                    //var widths = [22, "*", "*", "*", "*", "*", "*", "*", "*", "*"];
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Route', 'style': 'tableHeaderStyle'}, {'text':'Distance', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Sch. Trips', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Oper. Trips', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Sch. KMS', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Oper. KMS', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Income (Rs)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'EPKM ETM', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'PPT Tkts/Pass', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'ETM Passngr', 'style': 'tableHeaderStyle', alignment:'right'}]);
                    var i = 1;
                    $.each(data, function(ind, d){ 
                        var epkm = d.totalAmount/d.distance;
                        reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+d.route, style:'oddRowStyle'}, {'text':''+parseFloat(d.distance).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+d.tripsCount, style:'oddRowStyle', alignment:'right'}, {'text':''+d.tripsCount, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.distance).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.distance).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.totalAmount).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(epkm).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+d.ticketsCount, style:'oddRowStyle', alignment:'right'}, {'text':''+d.passengersCount, style:'oddRowStyle', alignment:'right'}]);
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
        var route_id = $('#route_id').val();
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
                        + "&route_id="+route_id;

        var url = "{{route('reports.revenue.route_wise_summary.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

