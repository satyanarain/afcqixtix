@extends('layouts.master')
@section('header')
<h1>Crew Stock Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Crew Stock</a></li>
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
                'route' => 'reports.ppt.crew_stock.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date");'
                ]) !!}
                @include('reports.ppt.crew_stock.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Ticket Type</th>
                                    <th>Conductor Name (ID)</th>
                                    <th>Denomination</th>
                                    <th>Series</th>
                                    <th>Opening Ticket No.</th>
                                    <th>Closing Ticket No.</th>
                                    <th>Ticket Count</th>
                                    <th>Ticket Value</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$da)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{'Ticket'}}</td>
                                    <td>{{$da->conductor->crew_name.' ('.$da->conductor->crew_id.')'}}</td>
                                    <td>{{$da->denomination->description}}</td>
                                    <td>{{$da->series}}</td>
                                    <td>{{$da->start_sequence}}</td>
                                    <td>{{$da->end_sequence}}</td>
                                    <td>{{$da->qty}}</td>
                                    <td>{{$da->qty*$da->denomination->price}}</td>
                                    <td></td>
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
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var conductor_id = $('#conductor_id').val();
        var denom_id = $('#denomination_id').val();
        var series = $('#series').val();

        $.ajax({
            url: "{{route('reports.ppt.crew_stock.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                from_date: from_date,
                to_date: to_date,
                conductor_id: conductor_id,
                denomination_id: denom_id,
                series: series
            },
            success: function(response)
            {
                console.log(response);
                if(response.status == 'Ok')
                {
                    var data = response.data;
                    var totalTicketCount = 0;
                    var totalTicketValue = 0;
                    var reportData = [];
                    reportData.push([{'text':'S. No.', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Ticket Type', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Conductor Name (ID)', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Denomination', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Series', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Opening Ticket No.', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Closing Ticket No.', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Ticket Count', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Ticket Value', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Remarks', 'bold':true, 'style': 'tableHeaderStyle'}]);

                    data.map((d) => {
                            console.log(d);
                            totalTicketCount += parseInt(d.qty);
                            totalTicketValue += parseInt(d.qty*d.denomination.price);
                            reportData.push([{'text':'1'}, {'text':'Ticket'}, {'text':d.conductor.crew_name+' ('+d.conductor.crew_id+')'}, {'text':d.denomination.description}, {'text':d.series}, {'text':d.start_sequence?''+d.start_sequence:""}, {'text':d.end_sequence?''+d.end_sequence:""}, {'text':''+d.qty, 'alignment':'right'}, {'text':''+d.qty*d.denomination.price, 'alignment':'right'}, {'text': ''}]);
                    });
                    
                    reportData.push([{'text':'Grand Total', 'bold':true, 'style': 'tableHeaderStyle', 'colSpan':7, 'alignment': 'right'}, {}, {}, {}, {}, {}, {}, {'text':''+totalTicketCount+'', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':''+totalTicketValue+'', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'', 'bold':true, 'style': 'tableHeaderStyle'}]);

                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    /*console.log(metaData);
                    return;*/
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
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var conductor_id = $('#conductor_id').val();
        var denom_id = $('#denomination_id').val();
        var series = $('#series').val();

        var queryParams = "?depot_id="+depot_id
                        + "&denomination_id="+denom_id
                        + "&from_date="+from_date
                        + "&to_date="+to_date
                        + "&conductor_id="+conductor_id
                        + "&series="+series;

        var url = "{{route('reports.ppt.crew_stock.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });

    $(document).on('change', '#depot_id', function(){
        var depot_id = $('#depot_id').val();

        var url = "{{route('inventory.crewstock.getdepotwisecrew', ':id')}}";
        url = url.replace(':id', depot_id);

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(response)
            {
                var data = response;
                if(data.status == 'Ok')
                {
                    var crews = data.data;      
                    var options = "<option value=''>All</option>";
                    $.each(crews, function(index, crew){
                        options += '<option value="'+crew.id+'">'+crew.crew_name+'</option>'
                    });                           

                    $('#conductor_id').html(options);
                }else{
                    $('#conductor_id').html('');
                }
            },
            error: function(error)
            {
                console.log(error);
            }
        })
    });
});

</script>
@endpush

