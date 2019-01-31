@extends('layouts.master')
@section('header')
<h1>Passenger Profiling Stop-wise Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Passenger Profiling Stop-wise</a></li>
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
                'route' => 'reports.revenue.passenger_profiling_stop_wise.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("", "from_date", "to_date", "", "time_slot", "direction");'
                ]) !!}
                @include('reports.revenue.passenger_profiling_stop_wise.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
                @if(isset($stops))
                <div class="row" style="margin-top: 50px;" id="reportDataBox">
                    <div class="col-md-12">
                        @if(count($stops) > 0)
                        <h4>
                            <button class="btn btn-primary pull-right" id="exportAsPDF">Export as PDF</button> 
                            <button class="btn btn-primary pull-right" style="margin-right: 10px;margin-bottom: 10px;" id="exportAsXLS">Export as XLS</button>
                        </h4>
                        @endif
                        <table class="table table-bordered" id="afcsReportTable">
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Stop</th>
                                    @foreach($slots as $key=>$slot)
                                    <th class="text-right">{{substr($slot, 11, 5)}}</th>
                                    @endforeach
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($stops) > 0)
                            @foreach($stops as $key=>$stop)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$stop->short_name}}</td>
                                    @php $totalCount = 0;@endphp
                                    @foreach($slots as $key=>$slot)
                                    @php $count = $stop->$slot;@endphp
                                    <td class="text-right">{{$count}}</td>
                                    @php $totalCount += (int)$count; @endphp
                                    @endforeach
                                    <td class="text-right">{{$totalCount}}</td>
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
                            {{$stops->appends(request()->input())->links()}}
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

        var time_slot = $('#time_slot').val();
        var direction = $('#direction').val();
        var stop_id = $('#stop_id').val();        

        $.ajax({
            url: "{{route('reports.revenue.passenger_profiling_stop_wise.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                stop_id: stop_id,
                from_date: fromDate,
                to_date: toDate,
                time_slot: time_slot,
                direction: direction
            },
            success: function(response)
            {
                if(response.status == 'Ok')
                {
                    var stops = response.stops;
                    var slots = response.slots;
                    console.log(stops)
                    var reportData = [];
                    var headerColumns = [];
                    var widths = [22, 100];
                    headerColumns.push({'text':'S. No.', 'style': 'tableHeaderStyle'});
                    headerColumns.push({'text':'Stop', 'style': 'tableHeaderStyle'});
                    slots.map(function(s){
                        headerColumns.push({'text':s.substr(10, 6), 'style': 'tableHeaderStyle', alignment:'right'});
                        widths.push("*");
                    })
                    headerColumns.push({'text':'Total', 'style': 'tableHeaderStyle', alignment:'right'});
                    widths.push("*");
                    reportData.push(headerColumns);
                    var i = 1;
                    $.each(stops, function(ind, stop){  
                        var rowColumns = [];
                        if(i%2 == 0)
                        {
                            rowColumns.push({'text':''+i, style:'oddRowStyle'});
                            rowColumns.push({'text':stop.short_name, style:'oddRowStyle'});
                            var totalCount = 0;
                            slots.map(function(s){
                                rowColumns.push({'text':''+stop[s], style:'oddRowStyle', alignment:'right'});
                                totalCount += parseInt(stop[s]);
                            })
                            rowColumns.push({'text':''+totalCount, style:'oddRowStyle', alignment:'right'});

                            reportData.push(rowColumns);
                        }else{
                            rowColumns.push({'text':''+i});
                            rowColumns.push({'text':stop.short_name});
                            var totalCount = 0;
                            slots.map(function(s){
                                rowColumns.push({'text':''+stop[s], alignment:'right'});
                                totalCount += parseInt(stop[s]);
                            })
                            rowColumns.push({'text':''+totalCount, alignment:'right'});

                            reportData.push(rowColumns);
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

        var time_slot = $('#time_slot').val();
        var direction = $('#direction').val();
        var stop_id = $('#stop_id').val(); 

        var queryParams = "?stop_id="+stop_id
                        + "&from_date="+fromDate
                        + "&to_date="+toDate
                        + "&direction="+direction
                        + "&time_slot="+time_slot;

        var url = "{{route('reports.revenue.passenger_profiling_stop_wise.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

