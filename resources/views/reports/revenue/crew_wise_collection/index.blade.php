@extends('layouts.master')
@section('header')
<h1>Crew-wise Revenue Collection Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Crew-wise Revenue Collection</a></li>
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
                'route' => 'reports.revenue.crew_wise_collection.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.revenue.crew_wise_collection.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}

                <div class="row" style="margin-top: 50px;" id="reportDataBox">
                    <div class="col-md-12">
                        <h4>
                            <button class="btn btn-primary pull-right" id="exportAsPDF">Export as PDF</button> 
                            <button class="btn btn-primary pull-right" style="margin-right: 10px;margin-bottom: 10px;" id="exportAsXLS">Export as XLS</button>
                        </h4>
                        <table class="table table-bordered" id="afcsReportTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th colspan="4" style="text-align: center;">PPT</th>
                                    <th colspan="5" style="text-align: center;">ETM</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Depot</th>
                                    <th>No. of Duties</th>
                                    <th>No. of Trips</th>
                                    <th>Dist. (Kms)</th>
                                    <th>Ticket Count</th>
                                    <th>Ticket Amount (Rs)</th>
                                    <th>Pass Sold Count</th>
                                    <th>Pass Sold Amount (Rs)</th>
                                    <th>Ticket Count</th>
                                    <th>Passenger Count</th>
                                    <th>Ticket Amount (Rs)</th>
                                    <th>Pass Sold Count</th>
                                    <th>Pass Sold Amount (Rs)</th>
                                    <th>Payout Amount (Rs)</th>
                                    <th>Fine Amount (Rs)</th>
                                    <th>Cash (Rs)</th>
                                    <th>E-Purse (Rs)</th>
                                    <th>Total Amount (Rs)</th>
                                    <th>Concession Amount (Rs)</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($consolidatedData) > 0)
                                <tr>
                                    <td>{{$depotName}}</td>
                                    <td>{{$consolidatedData['duties']}}</td>
                                    <td>{{$consolidatedData['trips']}}</td>
                                    <td>{{number_format((float)$consolidatedData['distance'], 2, '.', '')}}</td>
                                    <td>{{$consolidatedData['totalPaperTkts']}}</td>
                                    <td>{{number_format((float)$consolidatedData['totalPaperTktsSum'], 2, '.', '')}}</td>
                                    <td>{{$consolidatedData['totalPaperPass']}}</td>
                                    <td>{{number_format((float)$consolidatedData['totalPaperPassSum'], 2, '.', '')}}</td>
                                    <td>{{$consolidatedData['totalETMTkts']}}</td>
                                    <td>{{$consolidatedData['totalETMTotalPsnger']}}</td>
                                    <td>{{number_format((float)$consolidatedData['totalETMTktsSum'], 2, '.', '')}}</td>
                                    <td>{{$consolidatedData['totalETMPassCnt']}}</td>
                                    <td>{{number_format((float)$consolidatedData['totalETMPassSum'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$consolidatedData['payout'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$consolidatedData['penalty_amount'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$consolidatedData['totalCash'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$consolidatedData['epurseAmt'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$consolidatedData['totalAmt'], 2, '.', '')}}</td>
                                    <td>{{number_format((float)$consolidatedData['concession'], 2, '.', '')}}</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="18">No Record Found!</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
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
            url: "{{route('reports.revenue.crew_wise_collection.getpdfreport')}}",
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
                        reportData.push([{'text':'Depot', 'style': 'tableHeaderStyle'}, {'text':'No. of Duties', 'style': 'tableHeaderStyle'}, {'text':'No. of Trips', 'style': 'tableHeaderStyle'}, {'text':'Dist. (Kms)', 'style': 'tableHeaderStyle'}, {'text':'Ticket Count', 'style': 'tableHeaderStyle'}, {'text':'Ticket Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Count', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Ticket Count', 'style': 'tableHeaderStyle'}, {'text':'Passenger Count', 'style': 'tableHeaderStyle'}, {'text':'Ticket Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Count', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Payout Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Fine Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Cash (Rs)', 'style': 'tableHeaderStyle'}, {'text':'EPurse (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Total Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Concession Amount (Rs)', 'style': 'tableHeaderStyle'}]);
                        
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

        var url = "{{route('reports.revenue.crew_wise_collection.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
function validateForm()
    {
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

        return true;
    }
</script>
@endpush

