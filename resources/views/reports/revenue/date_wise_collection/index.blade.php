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
                'route' => 'reports.revenue.date_wise_collection.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "from_date");'
                ]) !!}
                @include('reports.revenue.date_wise_collection.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
                @isset($data)
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
                                    <!-- <th></th> -->
                                    <th></th>
                                    <th colspan="4" style="text-align: center;">PPT</th>
                                    <th colspan="7" style="text-align: center;">ETM</th>
                                    <th></th>
                                    <!-- <th></th> -->
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <!-- <th></th>
                                    <th></th> -->
                                    <!-- <th></th>
                                    <th></th> -->
                                </tr>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Date</th>
                                    <!-- <th>Route/Duty/Shift</th>
                                    <th>Abstract No.</th>
                                    <th>Crew ID</th> -->
                                    <th class="text-right">No. of Trips</th>
                                    <th class="text-right">Kms</th>
                                    <th class="text-right">EPKM</th>
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
                                    <!-- <th class="text-right">Fine Amt (Rs)</th> -->
                                    <th class="text-right">Lugg Amt (Rs)</th>
                                    <th class="text-right">Toll Amt (Rs)</th>
                                    <th class="text-right">Bhatta/Tea Allowance (Rs)</th>
                                    <th class="text-right">Incentives (Rs)</th>
                                    <th class="text-right">Total Amt (Rs)</th>
                                    <!-- <th class="text-right">Print Error Tkt</th>
                                    <th class="text-right">Print Error Amt (Rs)</th> --><!-- To be commented for now -->
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $key => $d)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{date('d-m-Y', strtotime($d->created_at))}}</td>
                                    <!-- <td>{{$d->route->route_name.'/'.$d->duty->duty_number.'/'.$d->shift->shift}}</td>
                                    <td>{{$d->abstract_no}}</td>
                                    <td>{{$d->conductor->crew_id}}</td> -->
                                    <td class="text-right">{{$d->trips->count()}}</td>
                                    @php
                                    $distance = $d->trips->pluck('route.distance')->sum();
                                    @endphp
                                    <td class="text-right">{{$distance}}</td>
                                    @php 
                                    $total = $d->ppt_amount + $d->ppp_amount + $d->tickets_amount + $d->pass_amount + $d->epurse_amount;

                                    $epkm = $total/$distance;

                                    @endphp
                                    <td class="text-right">{{number_format((float)$epkm, 2, '.', '')}}</td>
                                    <td class="text-right">{{$d->ppt_count?$d->ppt_count:0}}</td>
                                    <td class="text-right">{{number_format((float)$d->ppt_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$d->ppp_count?$d->ppp_count:0}}</td>
                                    <td class="text-right">{{number_format((float)$d->ppp_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$d->passenger_count}}</td>
                                    <td class="text-right">{{$d->tickets_count}}</td>
                                    <td class="text-right">{{number_format((float)$d->tickets_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$d->pass_count}}</td>
                                    <td class="text-right">{{number_format((float)$d->pass_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$d->epurse_count}}</td>
                                    <td class="text-right">{{number_format((float)$d->epurse_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$d->payouts->pluck('amount')->sum()}}</td>
                                    <!-- <td class="text-right">{{$d->passenger_count}}</td> -->
                                    <td class="text-right">{{number_format((float)$d->baggage_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->toll_amount, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->incentives, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$d->batta_tea_allowance, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$total, 2, '.', '')}}</td>
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
                        @if(count($data)>0)
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
            url: "{{route('reports.revenue.date_wise_collection.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                from_date: fromDate,
                to_date: toDate
            },
            success: function(response)
            {
                console.log(response);
                if(response.status == 'Ok')
                {
                    var columns = response.columns
                    var data = response.data;

                    var reportData = [];
                    if(data)
                    {
                        reportData.push([{'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'PPT', 'style': 'tableHeaderStyle', colSpan: 4, 'alignment':'center'}, {}, {}, {}, {'text':'ETM', 'style': 'tableHeaderStyle', colSpan: 7, 'alignment':'center'}, {}, {}, {}, {}, {}, {}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}]);
                        reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Date', 'style': 'tableHeaderStyle'}, {'text':'No of Trips', 'style': 'tableHeaderStyle'}, {'text':'Kms', 'style': 'tableHeaderStyle'}, {'text':'EPKM', 'style': 'tableHeaderStyle'}, {'text':'Tkt Cnt', 'style': 'tableHeaderStyle'}, {'text':'Tkt Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Cnt', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Passenger Cnt', 'style': 'tableHeaderStyle'}, {'text':'Tkt Cnt', 'style': 'tableHeaderStyle'}, {'text':'Tkt Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Cnt', 'style': 'tableHeaderStyle'}, {'text':'Pass Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'EPurse Cnt', 'style': 'tableHeaderStyle'}, {'text':'EPurse Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Payout Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Lugg Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Toll Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Butta/Tea Allowance (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Incentives (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Amt Payable/Adjustment Amt (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Amt Remitted/After Adjustment Amt (Rs)', 'style': 'tableHeaderStyle'}]);

                        var i = 1;
                        data.map(function(d){  
                            var tripsCount = 0;
                            var trips = d.trips;
                            if(trips)
                            {
                                tripsCount = trips.length;
                            }
                            var distance = trips.reduce(function(distance, trip){
                                return distance + parseInt(trip.route.distance);
                            }, 0);
                            var payouts = d.payouts;
                            var payout = payouts.reduce(function(payoutT, payout){
                                return payoutT + parseInt(payout.amount);
                            }, 0);
                            var amount_payable = 0;
                            var cash_remitted = 0;
                            if(d.cash_collection)
                            {
                                amount_payable = d.cash_collection.amount_payable;
                                cash_remitted = d.cash_collection.cash_remitted;
                            }
                            var ppt_count = 0;
                            var ppt_amount = 0;
                            var ppp_count = 0;
                            var ppp_amount = 0;
                            if(d.ppt_count)
                            {
                                ppt_count = d.ppt_count;
                            }
                            if(d.ppt_amount)
                            {
                                ppt_amount = d.ppt_amount;
                            }
                            if(d.ppp_count)
                            {
                                ppp_count = d.ppp_count;
                            }
                            if(d.ppp_amount)
                            {
                                ppp_amount = d.ppp_amount;
                            }

                            var batta_tea_allowance = 0;
                            var incentives = 0;
                            var passenger_count = 0;
                            var tickets_count = 0;
                            var tickets_amount = 0;
                            var pass_count = 0;
                            var pass_amount = 0;
                            var epurse_count = 0;
                            var epurse_amount = 0;
                            var baggage_amount = 0;
                            var toll_amount = 0;

                            if(d.batta_tea_allowance)
                            {
                                batta_tea_allowance = d.batta_tea_allowance;
                            }

                            if(d.incentives)
                            {
                                incentives = d.incentives;
                            }

                            if(d.passenger_count)
                            {
                                passenger_count = d.passenger_count;
                            }

                            if(d.tickets_count)
                            {
                                tickets_count = d.tickets_count;
                            }


                            if(d.tickets_amount)
                            {
                                tickets_amount = d.tickets_amount;
                            }

                            if(d.pass_count)
                            {
                                pass_count = d.pass_count;
                            }

                            if(d.pass_amount)
                            {
                                pass_amount = d.pass_amount;
                            }

                            if(d.epurse_count)
                            {
                                epurse_count = d.epurse_count;
                            }

                            if(d.epurse_amount)
                            {
                                epurse_amount = d.epurse_amount;
                            }

                            if(d.baggage_amount)
                            {
                                baggage_amount = d.baggage_amount;
                            }

                            if(d.toll_amount)
                            {
                                toll_amount = d.toll_amount;
                            }

                            var epkm = 0;
                            if(i%2 == 0){
                                reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+d.date}, {'text':''+tripsCount, alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(distance).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(epkm).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+ppt_count, alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(ppt_amount).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+ppp_count, alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(ppp_amount).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+passenger_count, alignment:'right', style:'oddRowStyle'}, {'text':''+tickets_count, alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(tickets_amount).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+pass_count, alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(pass_amount).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+epurse_count, alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(epurse_amount).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(payout).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(baggage_amount).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(toll_amount).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(batta_tea_allowance).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(incentives).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(amount_payable).toFixed(2), alignment:'right', style:'oddRowStyle'}, {'text':''+parseFloat(cash_remitted).toFixed(2), alignment:'right', style:'oddRowStyle'}]);
                            }else{                
                                reportData.push([{'text':''+i}, {'text':''+d.date}, {'text':''+tripsCount, alignment:'right'}, {'text':''+parseFloat(distance).toFixed(2), alignment:'right'}, {'text':''+parseFloat(epkm).toFixed(2), alignment:'right'}, {'text':''+ppt_count, alignment:'right'}, {'text':''+parseFloat(ppt_amount).toFixed(2), alignment:'right'}, {'text':''+ppp_count, alignment:'right'}, {'text':''+parseFloat(ppp_amount).toFixed(2), alignment:'right'}, {'text':''+passenger_count, alignment:'right'}, {'text':''+tickets_count, alignment:'right'}, {'text':''+parseFloat(tickets_amount).toFixed(2), alignment:'right'}, {'text':''+pass_count, alignment:'right'}, {'text':''+parseFloat(pass_amount).toFixed(2), alignment:'right'}, {'text':''+epurse_count, alignment:'right'}, {'text':''+parseFloat(epurse_amount).toFixed(2), alignment:'right'}, {'text':''+parseFloat(payout).toFixed(2), alignment:'right'}, {'text':''+parseFloat(baggage_amount).toFixed(2), alignment:'right'}, {'text':''+parseFloat(toll_amount).toFixed(2), alignment:'right'}, {'text':''+parseFloat(batta_tea_allowance).toFixed(2), alignment:'right'}, {'text':''+parseFloat(incentives).toFixed(2), alignment:'right'}, {'text':''+parseFloat(amount_payable).toFixed(2), alignment:'right'}, {'text':''+parseFloat(cash_remitted).toFixed(2), alignment:'right'}]);
                            }
                            i++;
                        })

                        console.log(reportData);
                        //return;
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
        var shift_id = $('#shift_id').val();
        var date = $('#date').val();
        if(!date)
        {
            alert('Please enter date.');
            return false;
        }

        var queryParams = "?depot_id="+depot_id
                        + "&shift_id="+shift_id
                        + "&date="+date;

        var url = "{{route('reports.revenue.date_wise_collection.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

