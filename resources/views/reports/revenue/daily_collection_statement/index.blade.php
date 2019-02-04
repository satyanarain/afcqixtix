@extends('layouts.master')
@section('header')
<h1>Daily Collection Statement Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Daily Collection Statement</a></li>
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
                'route' => 'reports.revenue.daily_collection_statement.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "", "", "", "", "", "", "date");'
                ]) !!}
                @include('reports.revenue.daily_collection_statement.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}

                <div class="row" style="margin-top: 50px;" id="reportDataBox">
                    <div class="col-md-12" style="overflow-y: auto;">
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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th colspan="4" style="text-align: center;">PPT</th>
                                    <th colspan="7" style="text-align: center;">ETM</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <!-- <th></th>
                                    <th></th> -->
                                </tr>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Route/Duty/Shift</th>
                                    <th>Abstract No.</th>
                                    <th>Crew ID</th>
                                    <th class="text-right">No. of Trips</th>
                                    <th class="text-right">Kms</th>
                                    <th class="text-right">Tkt Cnt</th>
                                    <th class="text-right">Tkt Amt (Rs)</th>
                                    <th class="text-right">Pass Sold Cnt</th>
                                    <th class="text-right">Pass Sold Amt (Rs)</th>
                                    <th class="text-right">Passenger Cnt</th>
                                    <th class="text-right">Tkt Cnt</th>
                                    <th class="text-right">Tkt Amt (Rs)</th>
                                    <th class="text-right">Pass Sold Cnt</th>
                                    <th class="text-right">Pass Sold Amt (Rs)</th>
                                    <th class="text-right">EPurse Cnt</th>
                                    <th class="text-right">EPurse Amt (Rs)</th>
                                    <th class="text-right">Payout Amt (Rs)</th>
                                    <th class="text-right">Fine Amt (Rs)</th>
                                    <th class="text-right">Lugg Amt (Rs)</th>
                                    <th class="text-right">Toll Amt (Rs)</th>
                                    <th class="text-right">Batta/Tea Allowance (Rs)</th>
                                    <th class="text-right">Incentives (Rs)</th>
                                    <th class="text-right">Amt Payable/Adjustment Amt (Rs)</th>
                                    <th class="text-right">Amt Remitted/After Adjustment Amt (Rs)</th>
                                    <!-- <th class="text-right">Print Error Tkt</th>
                                    <th class="text-right">Print Error Amt (Rs)</th> --><!-- To be commented for now -->
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $key => $d)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$d->route->route_name.'/'.$d->duty->duty_number.'/'.$d->shift->shift}}</td>
                                    <td>{{$d->abstract_no}}</td>
                                    <td>{{$d->conductor->crew_id}}</td>
                                    <td class="text-right">{{$d->trips->count()}}</td>
                                    <td class="text-right">{{$d->distance}}</td>
                                    <td class="text-right">{{$d->ppt_count}}</td>
                                    <td class="text-right">{{number_format((float)$d->ppt_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$d->ppp_count}}</td>
                                    <td class="text-right">{{number_format((float)$d->ppp_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$d->passenger_count}}</td>
                                    <td class="text-right">{{$d->tickets_count}}</td>
                                    <td class="text-right">{{number_format((float)$d->tickets_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$d->pass_count}}</td>
                                    <td class="text-right">{{number_format((float)$d->pass_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$d->epurse_count}}</td>
                                    <td class="text-right">{{number_format((float)$d->epurse_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$d->passenger_count}}</td>
                                    <td class="text-right">{{$d->passenger_count}}</td>
                                    <td class="text-right">{{number_format((float)$d->baggage_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->toll_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->incentives, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->batta_tea_allowance, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->cashCollection->amount_payable, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->cashCollection->cash_remitted, 2, '.', '')}}</td>
                                    <!-- <td class="text-right">{{number_format((float)$d->incentives, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->batta_tea_allowance, 2, '.', '')}}</td> -->
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="27" class="text-center"><strong>No Record Found!</strong></td>
                                </tr>
                            @endforelse
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
            url: "{{route('reports.revenue.daily_collection_statement.getpdfreport')}}",
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

        var url = "{{route('reports.revenue.daily_collection_statement.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

