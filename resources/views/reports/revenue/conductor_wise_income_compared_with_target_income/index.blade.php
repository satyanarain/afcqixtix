@extends('layouts.master')
@section('header')
<h1>Conductor-wise Income Compared With Target Income Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Conductor-wise Income Compared With Target Income</a></li>
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
                'route' => 'reports.revenue.conductor_wise_income_compared_with_target_income.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date");'
                ]) !!}
                @include('reports.revenue.conductor_wise_income_compared_with_target_income.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Conductor ID</th>
                                    <th>Conductor Name</th>
                                    <th class="text-right">No. of Duties</th>
                                    <th class="text-right">KMS</th>
                                    <th class="text-right">Self EPKM</th>
                                    <th class="text-right">Traget EPKM</th>
                                    <th class="text-right">Variance</th>
                                    <th class="text-right">Profit/Loss</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$d)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$d->crew_id}}</td>
                                    <td>{{$d->crew_name}}</td>
                                    <td class="text-right">{{$d->no_of_duties}}</td>
                                    <td class="text-right">{{$d->distance}}</td>
                                    <td class="text-right">{{number_format((float)$d->actualEPKM, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->targetEPKM, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->variance, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->profit, 2, '.', '')}}</td>
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
            url: "{{route('reports.revenue.conductor_wise_income_compared_with_target_income.getpdfreport')}}",
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
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Conductor ID', 'style': 'tableHeaderStyle'}, {'text':'Conductor Name', 'style': 'tableHeaderStyle'}, {'text':'No. of Duties', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'KMS', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Self EPKM', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Traget EPKM', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Variance', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Profit/Loss', 'style': 'tableHeaderStyle', alignment:'right'}]);
                    var i = 1;
                    $.each(data, function(ind, d){               
                        if(i%2 == 0)
                        {
                            reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+d.crew_id, style:'oddRowStyle'}, {'text':''+d.crew_name, style:'oddRowStyle'}, {'text':''+d.no_of_duties, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.distance).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.actualEPKM).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.targetEPKM).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.variance).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.profit).toFixed(2), style:'oddRowStyle', alignment:'right'}]);
                        }else{
                            reportData.push([{'text':''+i}, {'text':''+d.crew_id}, {'text':''+d.crew_name}, {'text':''+d.no_of_duties, alignment:'right'}, {'text':''+parseFloat(d.distance).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.actualEPKM).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.targetEPKM).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.variance).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.profit).toFixed(2), alignment:'right'}]);
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

        var url = "{{route('reports.revenue.conductor_wise_income_compared_with_target_income.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

