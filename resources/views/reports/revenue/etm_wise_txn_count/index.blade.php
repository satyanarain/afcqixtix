@extends('layouts.master')
@section('header')
<h1>ETM-wise Transaction Count Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>ETM-wise Transaction Count</a></li>
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
                'route' => 'reports.revenue.etm_wise_txn_count.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date");'
                ]) !!}
                @include('reports.revenue.etm_wise_txn_count.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Date</th>
                                    <th>ETM Number</th>
                                    <th>Route</th>
                                    <th>Duty</th>
                                    <th class="text-right">Ticket Count</th>
                                    <th class="text-right">Pass Count</th>
                                    <th class="text-right">EPurse Count</th>
                                    <th class="text-right">Passenger (Cash)</th>
                                    <th class="text-right">Passenger (Card)</th>
                                    <th class="text-right">Passenger (EPurse)</th>
                                    <th class="text-right">Concession</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$rdata)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{date('d-m-Y', strtotime($rdata->created_at))}}</td>
                                    <td>{{$rdata->etm->etm_no}}</td>
                                    <td>{{$rdata->route->route_name}}</td>
                                    <td>{{$rdata->duty->duty_number}}</td>
                                    <td class="text-right">{{$rdata->tickets_count}}</td>
                                    <td class="text-right">{{$rdata->pass_count}}</td>
                                    <td class="text-right">{{$rdata->epurse_count}}</td>
                                    <td class="text-right">{{$rdata->cash_passenger_count?$rdata->cash_passenger_count:'0'}}</td>
                                    <td class="text-right">{{$rdata->card_passenger_count?$rdata->card_passenger_count:'0'}}</td>
                                    <td class="text-right">{{$rdata->epurse_passenger_count?$rdata->epurse_passenger_count:'0'}}</td>
                                    <td class="text-right">{{calculateConcession($rdata->tickets)}}</td>
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
        var etm_no = $('#etm_no').val();
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
            url: "{{route('reports.revenue.etm_wise_txn_count.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                etm_no: etm_no,
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
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Date', 'style': 'tableHeaderStyle'}, {'text':'ETM Number', 'style': 'tableHeaderStyle'}, {'text':'Route', 'style': 'tableHeaderStyle'}, {'text':'Duty', 'style': 'tableHeaderStyle'}, {'text':'Ticket Count', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Pass Count', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'EPurse Count', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Passenger (Cash)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Passenger (Card)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Passenger (EPurse)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Concession', 'style': 'tableHeaderStyle', alignment:'right'}]);
                    var i = 1;
                    $.each(data, function(ind, d){  
                        
                        var tickets = d.tickets;
                        var concession = tickets.reduce(function(concessionAmt, ticket){
                            var conc = ticket.concession;
                            var concAmt = 0;
                            if(conc)
                            {
                                if(conc.flat_fare == "Yes")
                                {
                                    concAmt += parseInt(conc.flat_fare_amount);
                                }else{
                                    concAmt += parseInt(conc.percentage)/(100-parseInt(conc.percentage))*parseInt(ticket.total_amt);
                                }
                            }
                            return concessionAmt + concAmt;
                        }, 0);

                        var cash_passenger_count = 0;
                        if(d.cash_passenger_count)
                        {
                            cash_passenger_count = d.cash_passenger_count;
                        }
                        var card_passenger_count = 0;
                        if(d.card_passenger_count)
                        {
                            card_passenger_count = d.card_passenger_count;
                        }
                            var epurse_passenger_count = 0;
                        if(d.epurse_passenger_count)
                        {
                            epurse_passenger_count = d.epurse_passenger_count;
                        }

                    
                        if(i%2 == 0)
                        {
                            reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+(d.created_at).substr(0,10), style:'oddRowStyle'}, {'text':''+d.etm.etm_no, style:'oddRowStyle'}, {'text':''+d.route.route_name, style:'oddRowStyle'}, {'text':''+d.duty.duty_number, style:'oddRowStyle'}, {'text':''+d.tickets_count, style:'oddRowStyle', alignment:'right'}, {'text':''+d.pass_count, style:'oddRowStyle', alignment:'right'}, {'text':''+d.epurse_count, style:'oddRowStyle', alignment:'right'}, {'text':''+cash_passenger_count, style:'oddRowStyle', alignment:'right'}, {'text':''+card_passenger_count, style:'oddRowStyle', alignment:'right'}, {'text':''+epurse_passenger_count, style:'oddRowStyle', alignment:'right'}, {'text':''+concession, style:'oddRowStyle', alignment:'right'}]);
                        }else{
                            reportData.push([{'text':''+i}, {'text':''+(d.created_at).substr(0,10)}, {'text':''+d.etm.etm_no}, {'text':''+d.route.route_name}, {'text':''+d.duty.duty_number}, {'text':''+d.tickets_count, alignment:'right'}, {'text':''+d.pass_count, alignment:'right'}, {'text':''+d.epurse_count, alignment:'right'}, {'text':''+cash_passenger_count, alignment:'right'}, {'text':''+card_passenger_count, alignment:'right'}, {'text':''+epurse_passenger_count, alignment:'right'}, {'text':''+concession, alignment:'right'}]);
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
        var etm_no = $('#etm_no').val();
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
                        + "&etm_no="+etm_no;

        var url = "{{route('reports.revenue.etm_wise_txn_count.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

