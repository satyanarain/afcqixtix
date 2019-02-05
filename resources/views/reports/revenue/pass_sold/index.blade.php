@extends('layouts.master')
@section('header')
<h1>Pass Sold Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Pass Sold</a></li>
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
                'route' => 'reports.revenue.pass_sold.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date");'
                ]) !!}
                @include('reports.revenue.pass_sold.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}

                @isset($data)
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
                                    <th>Date</th>
                                    <th>Stop</th>
                                    <th>Service Type</th>
                                    <th>Pass Type</th>
                                    <th>Pass Count</th>
                                    <th>Cash (Rs)</th>
                                    <th>Credit (Rs)</th>
                                    <th>EPurse (Rs)</th>
                                    <th>Amount (Rs)</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $key=>$d)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$data['duties']}}</td>
                                    <td>{{$data['trips']}}</td>
                                    <td>{{number_format((float)$data['totalETMPassSum'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$data['payout'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$data['penalty_amount'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$data['totalCash'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$data['epurseAmt'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$data['totalAmt'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$data['concession'], 2, '.', '')}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center"><strong>No Record Found!</strong></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        @if(count($data) > 0)
                            <div class="pull-right"> 
                                {{$data->appends(request()->input())->links()}}
                            </div>
                        @endif
                    </div>
                </div>
                @endisset
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

        var splitFrom = fromDate.split('-');
        var splitTo = toDate.split('-');

        console.log(splitFrom)

        //Create a date object from the arrays
        fromDate = new Date(splitFrom[2], splitFrom[1]-1, splitFrom[0]);
        toDate = new Date(splitTo[2], splitTo[1]-1, splitTo[0]);

        if(fromDate > toDate)
        {
            alert('From Date must be smaller than or equal to To Date.');
            return false;
        }

        $.ajax({
            url: "{{route('reports.revenue.pass_sold.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                from_date: fromDate,
                to_date: toDate,
                conductor_id: conductor_id
            },
            success: function(response)
            {
                console.log(response);
                if(response.status == 'Ok')
                {
                    var columns = response.columns
                    var d = response.data;

                    var reportData = [];
                    if(d)
                    {
                        reportData.push([{'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'PPT', 'style': 'tableHeaderStyle', colSpan: 4, 'alignment':'center'}, {}, {}, {}, {'text':'ETM', 'style': 'tableHeaderStyle', colSpan: 5, 'alignment':'center'}, {}, {}, {}, {}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}]);
                        reportData.push([{'text':'Depot', 'style': 'tableHeaderStyle'}, {'text':'No. of Duties', 'style': 'tableHeaderStyle'}, {'text':'No. of Trips', 'style': 'tableHeaderStyle'}, {'text':'Dist. (Kms)', 'style': 'tableHeaderStyle'}, {'text':'Tkt Cnt', 'style': 'tableHeaderStyle'}, {'text':'Tkt Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Cnt', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Tkt Cnt', 'style': 'tableHeaderStyle'}, {'text':'Passenger Cnt', 'style': 'tableHeaderStyle'}, {'text':'Ticket Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Cnt', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Payout Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Fine Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Cash (Rs)', 'style': 'tableHeaderStyle'}, {'text':'EPurse (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Total Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Conc Amt (Rs)', 'style': 'tableHeaderStyle'}]);
                        
                        reportData.push([{'text':response.depotName}, {'text':''+d.duties}, {'text':''+d.trips}, {'text':''+parseFloat(d.distance).toFixed(2)}, {'text':''+d.totalPaperTkts}, {'text':''+parseFloat(d.totalPaperTktsSum).toFixed(2)}, {'text':''+d.totalPaperPass}, {'text':''+parseFloat(d.totalPaperPassSum).toFixed(2)}, {'text':''+d.totalETMTkts}, {'text':''+d.totalETMTotalPsnger}, {'text':''+parseFloat(d.totalETMTktsSum).toFixed(2)}, {'text':''+d.totalETMPassCnt}, {'text':''+parseFloat(d.totalETMPassSum).toFixed(2)}, {'text':''+parseFloat(d.payout).toFixed(2)}, {'text':''+parseFloat(d.penalty_amount).toFixed(2)}, {'text':''+parseFloat(d.totalCash).toFixed(2)}, {'text':''+parseFloat(d.epurseAmt).toFixed(2)}, {'text':''+parseFloat(d.totalAmt).toFixed(2)}, {'text':''+parseFloat(d.concession).toFixed(2)}]);

                        var metaData = response.meta;
                        var title = response.title;
                        var takenBy = response.takenBy;
                        var serverDate = response.serverDate;
                        Export(metaData, title, reportData, takenBy, serverDate, 'auto', '');  
                    }else{
                        alert('No record found');
                    }                  
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
                        + "&conductor_id="+conductor_id
                        + "&from_date="+fromDate
                        + "&to_date="+toDate;

        var url = "{{route('reports.revenue.pass_sold.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

