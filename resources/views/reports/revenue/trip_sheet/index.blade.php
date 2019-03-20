@extends('layouts.master')
@section('header')
<h1>Trip Sheet Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Trip Sheet</a></li>
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
                'route' => 'reports.revenue.trip_sheet.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date");'
                ]) !!}
                @include('reports.revenue.trip_sheet.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th></th>
                                    <th></th>
                                    <th class="text-center" colspan="4">KMS</th>
                                    <th class="text-center" colspan="4">Income</th>
                                    <th class="text-center" colspan="4">EPKM</th>
                                </tr>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Date</th>
                                    <th class="text-right">L. Year</th>
                                    <th class="text-right">Actual</th>
                                    <th class="text-right">Variance</th>
                                    <th class="text-right">%</th>
                                    <th class="text-right">L. Year</th>
                                    <th class="text-right">Actual</th>
                                    <th class="text-right">Variance</th>
                                    <th class="text-right">%</th>
                                    <th class="text-right">L. Year</th>
                                    <th class="text-right">Actual</th>
                                    <th class="text-right">Variance</th>
                                    <th class="text-right">%</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$d)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$d['date']}}</td>
                                    <td class="text-right">{{number_format((float)$d['lastYear']['distance'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d['currentYear']['distance'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d['kms']['variance'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d['kms']['percentage'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d['lastYear']['totalAmount'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d['currentYear']['totalAmount'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d['income']['variance'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d['income']['percentage'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d['lastYear']['epkm'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d['currentYear']['epkm'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d['epkm']['variance'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d['epkm']['percentage'], 2, '.', '')}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="14"><strong>No Record Found! &#9785</strong></td>
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

    var depot_id = $('#depot_id').val();
    if(depot_id)
    {
        var crew_id = "{{isset($_GET['crew_id']) ? $_GET['crew_id'] : ''}}";
        getConductorsByDepotId(depot_id, 'depot_id', "All", crew_id);
    }

    $(document).on('change', '#depot_id', function(){
        var depot_id = $(this).val();
        if(depot_id)
        {
            getConductorsByDepotId(depot_id, 'etm_no', "All");
        }
    });


    $(document).on('click', '#exportAsPDF', function(){
        var depot_id = $('#depot_id').val();
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
            url: "{{route('reports.revenue.trip_sheet.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
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
                    reportData.push([{'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'KMS', 'style': 'tableHeaderStyle', alignment:'center', colSpan:4}, {}, {}, {}, {'text':'Income', 'style': 'tableHeaderStyle', alignment:'center', colSpan:4}, {}, {}, {}, {'text':'EPKM', 'style': 'tableHeaderStyle', alignment:'center', colSpan:4}, {}, {}, {}]);
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Date', 'style': 'tableHeaderStyle'}, {'text':'L. Year', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Actual', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Variance', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'%', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'L. Year', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Actual', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Variance', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'%', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'L. Year', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Actual', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Variance', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'%', 'style': 'tableHeaderStyle', alignment:'right'}]);
                    var i = 1;
                    $.each(data, function(ind, d){               
                        if(i%2 == 0)
                        {
                            reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+d.date, style:'oddRowStyle'}, {'text':''+parseFloat(d.lastYear.distance).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.currentYear.distance).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.kms.variance).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.kms.percentage).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.lastYear.totalAmount).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.currentYear.totalAmount).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.income.variance).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.income.percentage).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.lastYear.epkm).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.currentYear.epkm).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.epkm.variance).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.epkm.percentage).toFixed(2), style:'oddRowStyle', alignment:'right'}]);
                        }else{
                            reportData.push([{'text':''+i}, {'text':''+d.date}, {'text':''+parseFloat(d.lastYear.distance).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.currentYear.distance).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.kms.variance).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.kms.percentage).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.lastYear.totalAmount).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.currentYear.totalAmount).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.income.variance).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.income.percentage).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.lastYear.epkm).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.currentYear.epkm).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.epkm.variance).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.epkm.percentage).toFixed(2), alignment:'right'}]);
                        }
                        i++;
                    })
                
                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    Export(metaData, title, reportData, takenBy, serverDate, '*', 'noBorders', 2);                                      
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
                        + "&to_date="+toDate;

        var url = "{{route('reports.revenue.trip_sheet.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

