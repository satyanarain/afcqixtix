@extends('layouts.master')
@section('header')
<h1>EPKM for Route Trip-wise Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>EPKM for Route Trip-wise</a></li>
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
                'route' => 'reports.revenue.epkm.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date", "", "", "", "", "", "route_id");'
                ]) !!}
                @include('reports.revenue.epkm.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Duty</th>
                                    <th class="text-right">Trip No.</th>
                                    <th>From Stop</th>
                                    <th>To Stop</th>
                                    <th>Direction</th>
                                    <th>Sch. Trip Time</th>
                                    <th class="text-right">Distance (Kms)</th>
                                    <th>Operated</th>
                                    <th>Operated Distance</th>
                                    <th class="text-right">Target Income</th>
                                    <th class="text-right">Actual Income</th>
                                    <th class="text-right">Target EPKM</th>
                                    <th class="text-right">Actual EPKM</th>
                                    <th class="text-right">Passengers</th>
                                    <th class="text-right">Tickets</th>
                                    <th class="text-right">Load Factor</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$rdata)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$rdata->waybill->duty->duty_number}}</td>
                                    <td class="text-right">{{$rdata->trip_id}}</td>
                                    <td>{{$rdata->fromStop->short_name}}</td>
                                    <td>{{$rdata->toStop->short_name}}</td>
                                    <td>{{$rdata->direction}}</td>
                                    <td>{{$rdata->schedule_time}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->route->distance, 2, '.', '')}}</td>
                                    <td class="text-right">{{'0'}}</td>
                                    <td class="text-right">{{'0'}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->target_income, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->tickets[0]->actual_income, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->target_epkm, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->actual_epkm, 2, '.', '')}}</td>
                                    <td class="text-right">{{$rdata->tickets[0]->passenger_count}}</td>
                                    <td class="text-right">{{$rdata->tickets[0]->tickets_count}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->load_factor, 2, '.', '')}}</td>
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
        var etm_no = $('#etm_no').val();
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
            url: "{{route('reports.revenue.epkm.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                etm_no: etm_no,
                from_date: fromDate,
                to_date: toDate
            },
            success: function(response)
            {
                if(response.status == 'Ok')
                {
                    var data = response.data.data;
                    console.log(data)
                    var reportData = [];
                    var widths = [22, 20, 25, "*", "*", "*", "*", "*", "*", "*", "*", "*", "*", "*", "*", "*", "*"];
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Duty', 'style': 'tableHeaderStyle'}, {'text':'Trip No.', 'style': 'tableHeaderStyle'}, {'text':'From Stop', 'style': 'tableHeaderStyle'}, {'text':'To Stop', 'style': 'tableHeaderStyle'}, {'text':'Direction', 'style': 'tableHeaderStyle'}, {'text':'Sch. Trip Time', 'style': 'tableHeaderStyle'}, {'text':'Distance (Kms)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Operated', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Operated Distance', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Target Income', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Actual Income', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Target EPKM', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Actual EPKM', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Passengers', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Tickets', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Load Factor', 'style': 'tableHeaderStyle', alignment:'right'}]);
                    var i = 1;
                    $.each(data, function(ind, d){  
                        
                        var duty_number = d.waybill ? d.waybill.duty.duty_number : "";
                        var trip_id = d.trip_id;
                        var fromStop = d.from_stop ? d.from_stop.short_name : "";
                        var toStop = d.to_stop ? d.to_stop.short_name : "";
                        var direction = d.direction;
                        var schedule_time = d.schedule_time;
                        var distance = d.route ? d.route.distance : "";
                        var operated = 0;
                        var operatedDistance = 0;
                        var target_income = d.target_income;
                        var actual_income = d.tickets[0] ? d.tickets[0].actual_income : "";
                        var target_epkm = d.target_epkm;
                        var actual_epkm = d.actual_epkm;
                        var passenger_count = d.tickets[0] ? d.tickets[0].passenger_count : "";
                        var tickets_count = d.tickets[0] ? d.tickets[0].tickets_count : "";
                        var load_factor = d.load_factor;

                        if(i%2 == 0)
                        {
                            reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+duty_number, style:'oddRowStyle'}, {'text':''+trip_id, style:'oddRowStyle'}, {'text':''+fromStop, style:'oddRowStyle'}, {'text':''+toStop, style:'oddRowStyle'}, {'text':''+direction, style:'oddRowStyle'}, {'text':''+schedule_time, style:'oddRowStyle'}, {'text':''+distance, style:'oddRowStyle', alignment:'right'}, {'text':''+operated, style:'oddRowStyle', alignment:'right'}, {'text':''+operatedDistance, style:'oddRowStyle', alignment:'right'}, {'text':''+target_income, style:'oddRowStyle', alignment:'right'}, {'text':''+actual_income, style:'oddRowStyle', alignment:'right'}, {'text':''+target_epkm, style:'oddRowStyle', alignment:'right'}, {'text':''+actual_epkm, style:'oddRowStyle', alignment:'right'}, {'text':''+passenger_count, style:'oddRowStyle', alignment:'right'}, {'text':''+tickets_count, style:'oddRowStyle', alignment:'right'}, {'text':''+load_factor, style:'oddRowStyle', alignment:'right'}]);
                        }else{
                            reportData.push([{'text':''+i}, {'text':''+duty_number}, {'text':''+trip_id}, {'text':''+fromStop}, {'text':''+toStop}, {'text':''+direction}, {'text':''+schedule_time}, {'text':''+distance, alignment:'right'}, {'text':''+operated, alignment:'right'}, {'text':''+operatedDistance, alignment:'right'}, {'text':''+target_income, alignment:'right'}, {'text':''+actual_income, alignment:'right'}, {'text':''+target_epkm, alignment:'right'}, {'text':''+actual_epkm, alignment:'right'}, {'text':''+passenger_count, alignment:'right'}, {'text':''+tickets_count, alignment:'right'}, {'text':''+load_factor, alignment:'right'}]);
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

        var url = "{{route('reports.revenue.epkm.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

