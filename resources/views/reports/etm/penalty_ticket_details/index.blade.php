@extends('layouts.master')
@section('header')
<h1>Penalty Ticket Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Penalty Ticket</a></li>
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
                'route' => 'reports.etm.penalty_ticket_details.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date");'
                ]) !!}
                @include('reports.etm.penalty_ticket_details.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                        <table class="table" id="afcsReportTable">
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Inspection Date - Time</th>
                                    <th>Inspector</th>
                                    <th>Route</th>
                                    <th>Direction</th>
                                    <th style="text-align: right;">Penalty Amt.</th>
                                    <th>Passenger</th>
                                    <th>Stop</th>
                                    <th>Conductor</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$da)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{date('d-m-Y H:i:s', strtotime($da->inspection_timestamp))}}</td>
                                    <td>{{$da->inspector->crew_name}}</td>
                                    <td>{{isset($da->route)?$da->route->route_name:'N/A'}}</td>
                                    <td>{{$da->direction}}</td>
                                    <td style="text-align: right;">{{$da->penalty_amount}}</td>
                                    <td>{{$da->name_of_passenger}}</td>
                                    <td>{{isset($da->stop) ? $da->stop->stop : 'N/A'}}</td>
                                    <td>{{$da->conductor->crew_name}}</td>
                                    <td>{{$da->remark->remark_description}}</td>
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
        var route_id = $('#route_id').val();
        var inspector_id = $('#inspector_id').val();
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
            url: "{{route('reports.etm.penalty_ticket_details.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                route_id: route_id,
                from_date: fromDate,
                to_date: toDate,
                inspector_id: inspector_id
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
                        reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Inspection Date - Time', 'style': 'tableHeaderStyle'}, {'text':'Inspector', 'style': 'tableHeaderStyle'}, {'text':'Route', 'style': 'tableHeaderStyle'}, {'text':'Diretion', 'style': 'tableHeaderStyle'}, {'text':'Penalty Amount', 'style': 'tableHeaderStyle'}, {'text':'Passenger', 'style': 'tableHeaderStyle'}, {'text':'Stop', 'style': 'tableHeaderStyle'}, {'text':'Conductor', 'style': 'tableHeaderStyle'}, {'text':'Remark', 'style': 'tableHeaderStyle'}]);
                        
                        var i = 1;
                        data.map((d) => {
                            console.log(d);
                            var route = '';
                            var remark = '';
                            var conductor = '';
                            var inspector = '';
                            if(d.route)
                            {
                                route = d.route.route_name;
                            }else{
                                route = "N/A";
                            }
                            if(d.remark)
                            {
                                remark = d.remark.remark_description;
                            }else{
                                remark = "N/A";
                            }
                            if(d.conductor)
                            {
                                conductor = d.conductor.crew_name;
                            }else{
                                conductor = "N/A";
                            }
                            if(d.inspector)
                            {
                                inspector = d.inspector.crew_name;
                            }else{
                                inspector = "N/A";
                            }
                            reportData.push([{'text':''+i}, {'text':d.created_at}, {'text':inspector}, {'text':route}, {'text':d.direction}, {'text':''+d.penalty_amount, 'alignment':'right'}, {'text':d.name_of_passenger}, {'text':d.stop.stop}, {'text':conductor}, {'text':remark}]);
                            i++;
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
        var inspector_id = $('#inspector_id').val();
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
                        + "&inspector_id="+inspector_id
                        + "&to_date="+toDate;

        var url = "{{route('reports.etm.penalty_ticket_details.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

