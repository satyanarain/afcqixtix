@extends('layouts.master')
@section('header')
<h1>Depot Stock Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Depot Stock</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create Depot Stock</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.ppt.depot_stock.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET'
                ]) !!}
                @include('reports.ppt.depot_stock.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Ticket Type</th>
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
                                    <td>No Record Found!</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>o</td>
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
        var denom_id = $('#denomination_id').val();
        var series = $('#series').val();

        $.ajax({
            url: "{{route('reports.ppt.depot_stock.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                denomination_id: denom_id,
                series: series
            },
            success: function(response)
            {
                console.log(response);
                if(response.status == 'Ok')
                {
                    var columns = response.columns
                    var data = response.data;
                    var totalTicketCount = 0;
                    var totalTicketValue = 0;
                    var reportData = [];
                    reportData.push([{'text':'S. No.', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Ticket Type', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Denomination', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Series', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Opening Ticket No.', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Closing Ticket No.', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Ticket Count', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Ticket Value', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Remarks', 'bold':true, 'style': 'tableHeaderStyle'}]);
                    if(data.length > 0)
                    {
                        data.map((d) => {
                            console.log(d);
                            totalTicketCount += parseInt(d[6]);
                            totalTicketValue += parseInt(d[7]);
                            reportData.push([{'text':d[0]}, {'text':d[1]}, {'text':d[2]}, {'text':d[3]}, {'text':d[4]}, {'text':d[5]}, {'text':d[6], 'alignment':'right'}, {'text':d[7], 'alignment':'right'}, {'text': ''}]);
                        })
                    }

                    console.log(totalTicketValue);
                    console.log(totalTicketCount);

                    reportData.push([{'text':'Grand Total', 'bold':true, 'style': 'tableHeaderStyle', 'colSpan':6, 'alignment': 'right'}, {}, {}, {}, {}, {}, {'text':''+totalTicketCount+'', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':''+totalTicketValue+'', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'', 'bold':true, 'style': 'tableHeaderStyle'}]);
                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    Export(metaData, title, reportData, takenBy, serverDate);
                    
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
        var denom_id = $('#denomination_id').val();
        var series = $('#series').val();

        var queryParams = "?depot_id="+depot_id
                        + "&denomination_id="+denom_id
                        + "&series="+series;

        var url = "{{route('reports.ppt.depot_stock.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

