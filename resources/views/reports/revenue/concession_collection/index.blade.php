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
                'route' => 'reports.revenue.concession_collection.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date", "", "", "", "service_id");'
                ]) !!}
                @include('reports.revenue.concession_collection.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Concession Type</th>
                                    <th class="text-right">Passenger Count</th>
                                    <th class="text-right">Actual Fare</th>
                                    <th class="text-right">Fare Charged</th>
                                    <th class="text-right">Rebate Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$rdata)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$rdata->concession->description}}</td>
                                    <td class="text-right">{{$rdata->passenger_count}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->actual_fare, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->charged_fare, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata->concession_amount, 2, '.', '')}}</td>
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
        var service_id = $('#service_id').val();
        var concession_id = $('#concession_id').val();
        var conductor_id = $('#conductor_id').val();
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
            url: "{{route('reports.revenue.concession_collection.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                service_id: service_id,
                from_date: fromDate,
                to_date: toDate,
                concession_id: concession_id,
                conductor_id: conductor_id
            },
            success: function(response)
            {
                if(response.status == 'Ok')
                {
                    var data = response.data;
                    console.log(data)
                    var reportData = [];
                    var widths = [22, "*", "*", "*", "*", "*", "*", "*", "*", "*"];
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Concession Type', 'style': 'tableHeaderStyle'}, {'text':'Passenger count', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Actual Fare', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Charged Fare', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Rebate Amount', 'style': 'tableHeaderStyle', alignment:'right'}]);
                    var i = 1;
                    $.each(data, function(ind, d){                      
                        if(i%2 == 0)
                        {
                            reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+d.concession.description, style:'oddRowStyle'}, {'text':''+d.passenger_count, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.actual_fare).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.charged_fare).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(d.concession_amount).toFixed(2), style:'oddRowStyle', alignment:'right'}]);
                        }else{
                            reportData.push([{'text':''+i}, {'text':''+d.concession.description}, {'text':''+d.passenger_count, alignment:'right'}, {'text':''+parseFloat(d.actual_fare).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.charged_fare).toFixed(2), alignment:'right'}, {'text':''+parseFloat(d.concession_amount).toFixed(2), alignment:'right'}]);   
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
        var service_id = $('#service_id').val();
        var concession_id = $('#concession_id').val();
        var conductor_id = $('#conductor_id').val();
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
                        + "&concession_id="+concession_id
                        + "&conductor_id="+conductor_id
                        + "&service_id="+service_id;

        var url = "{{route('reports.revenue.concession_collection.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

