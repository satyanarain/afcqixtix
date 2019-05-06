@extends('layouts.master')
@section('header')
<h1>Schedule-wise EPKM Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Schedule-wise EPKM</a></li>
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
                'route' => 'reports.revenue.schedule_wise_epkm.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date", "", "", "", "", "", "route_id");'
                ]) !!}
                @include('reports.revenue.schedule_wise_epkm.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Route</th>
                                    <th>Sch Time</th>
                                    <th class="text-right">Sch Trips</th>
                                    <th class="text-right">Oper Trips</th>
                                    <th class="text-right">Income</th>
                                    <th class="text-right">Target EPKM</th>
                                    <th class="text-right">Actual EPKM</th>
                                    <th class="text-right">Variance</th>
                                    <th class="text-right">PPT Ticket/Pass Count</th>
                                    <th class="text-right">ETM Passenger Count</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($duties as $key=>$duty)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$data[$route_id][$duty->duty_number][0]['route'].'-'.$duty->duty_number}}</td>
                                    <td>{{$duty->start_time}}</td>
                                    <td class="text-right">{{$data[$route_id][$duty->duty_number][0]['scheduledTrips']}}</td>
                                    <td class="text-right">{{$data[$route_id][$duty->duty_number][0]['tripsCount']}}</td>
                                    <td class="text-right">{{number_format((float)$data[$route_id][$duty->duty_number][0]['totalAmount'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$data[$route_id][$duty->duty_number][0]['targetEPKM'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$data[$route_id][$duty->duty_number][0]['actualEPKM'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$data[$route_id][$duty->duty_number][0]['variance'], 2, '.', '')}}</td>
                                    <td class="text-right">{{$data[$route_id][$duty->duty_number][0]['ticketsCount']}}</td>
                                    <td class="text-right">{{$data[$route_id][$duty->duty_number][0]['passengersCount']}}</td>
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
            url: "{{route('reports.revenue.schedule_wise_epkm.getpdfreport')}}",
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
                    var route_id = response.route_id;
                    var duties = response.duties;
                    console.log(duties)
                    var reportData = [];
                    //var widths = [22, "*", "*", "*", "*", "*", "*", "*", "*", "*"];
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Route', 'style': 'tableHeaderStyle'}, {'text':'Sch Time', 'style': 'tableHeaderStyle'}, {'text':'Sch Trips', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Oper Trips', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Income', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Target EPKM', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Actual EPKM', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Variance', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'PPT Ticket/Pass Count', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'ETM Passenger Count', 'style': 'tableHeaderStyle', alignment:'right'}]);
                    var i = 1;
                    $.each(duties, function(ind, d){   
                        var route = data[route_id][d.duty_number][0]['route']+'-'+d.duty_number;
                        var sch_time = d.start_time;
                        var sch_trips = data[route_id][d.duty_number][0]['scheduledTrips'];
                        var oper_trips = data[route_id][d.duty_number][0]['tripsCount'];
                        var income = parseFloat(data[route_id][d.duty_number][0]['totalAmount']).toFixed(2);
                        var targetEPKM = parseFloat(data[route_id][d.duty_number][0]['targetEPKM']).toFixed(2);
                        var actualEPKM = parseFloat(data[route_id][d.duty_number][0]['actualEPKM']).toFixed(2);
                        var variance = parseFloat(data[route_id][d.duty_number][0]['variance']).toFixed(2);
                        var ppt_cnt = data[route_id][d.duty_number][0]['ticketsCount'];
                        var passengersCount = data[route_id][d.duty_number][0]['passengersCount'];                   
                        if(i%2 == 0)
                        {
                            reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+route, style:'oddRowStyle'}, {'text':''+sch_time, style:'oddRowStyle'}, {'text':''+sch_trips, style:'oddRowStyle', alignment:'right'}, {'text':''+oper_trips, style:'oddRowStyle', alignment:'right'}, {'text':''+income, style:'oddRowStyle', alignment:'right'}, {'text':''+targetEPKM, style:'oddRowStyle', alignment:'right'}, {'text':''+actualEPKM, style:'oddRowStyle', alignment:'right'}, {'text':''+variance, style:'oddRowStyle', alignment:'right'}, {'text':''+ppt_cnt, style:'oddRowStyle', alignment:'right'}, {'text':''+passengersCount, style:'oddRowStyle', alignment:'right'}]);
                        }else{
                            reportData.push([{'text':''+i}, {'text':''+route}, {'text':''+sch_time}, {'text':''+sch_trips, alignment:'right'}, {'text':''+oper_trips, alignment:'right'}, {'text':''+income, alignment:'right'}, {'text':''+targetEPKM, alignment:'right'}, {'text':''+actualEPKM, alignment:'right'}, {'text':''+variance, alignment:'right'}, {'text':''+ppt_cnt, alignment:'right'}, {'text':''+passengersCount, alignment:'right'}]);
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

        var url = "{{route('reports.revenue.schedule_wise_epkm.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

