@extends('layouts.master')
@section('header')
<h1>Passes Validated Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Passes Validated</a></li>
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
                'route' => 'reports.etm.passes_validated_details.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date");'
                ]) !!}
                @include('reports.etm.passes_validated_details.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>From Stop</th>
                                    <th>To Stop</th>
                                    <th>Date and Time</th>
                                    <th>Adult Count</th>
                                    <th style="text-align: right;">Adult Amt (Rs.)</th>
                                    <th>Child Count</th>
                                    <th style="text-align: right;">Child Amt (Rs.)</th>
                                    <th style="text-align: right;">Concession (Rs.)</th>
                                    <th style="text-align: right;">Pass</th>
                                    <th style="text-align: right;">Cash</th>
                                    <th style="text-align: right;">E-Purse</th>
                                    <th style="text-align: right;">Total Amt. (Rs.)</th>
                                    <th>Card Number</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$da)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$da->fromStop->short_name}}</td>
                                    <td>{{$da->toStop->short_name}}</td>
                                    <td>{{date('d-m-Y H:i:s', strtotime($da->sold_at))}}</td>
                                    <td>{{$da->adults}}</td>
                                    <td style="text-align: right;">{{$da->adults_amt}}</td>
                                    <td>{{$da->childs}}</td>
                                    <td style="text-align: right;">{{$da->childs_amt}}</td>
                                    <td style="text-align: right;">{{$da->concession->flat_fare_amount}}</td>
                                    <td style="text-align: right;">{{'0.00'}}</td>
                                    <td style="text-align: right;">{{'0.00'}}</td>
                                    <td style="text-align: right;">{{'0.00'}}</td>
                                    <td style="text-align: right;">{{$da->adults_amt+$da->childs_amt-$da->concession->flat_fare_amount}}</td>
                                    <td>{{$da->card_number}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="14"><strong>No Record Found! &#9785</strong></td>
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
        var pass_id = $('#pass_id').val();
        var fromDate = $('#from_date').val();
        if(!fromDate)
        {
            return alert('Please enter from date.');
        }

        var toDate = $('#to_date').val();
        if(!toDate)
        {
            return alert('Please enter to date.');
        }

        var splitFrom = fromDate.split('-');
        var splitTo = toDate.split('-');

        //Create a date object from the arrays
        fDate = new Date(splitFrom[2], splitFrom[1]-1, splitFrom[0]);
        tDate = new Date(splitTo[2], splitTo[1]-1, splitTo[0]);

        if(fDate > tDate)
        {
            return alert('From Date must be smaller than or equal to To Date.');
        }

        $.ajax({
            url: "{{route('reports.etm.passes_validated_details.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                service_id: service_id,
                pass_id:pass_id,
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
                    if(data.length > 0)
                    {
                        reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'From Stop', 'style': 'tableHeaderStyle'}, {'text':'To Stop', 'style': 'tableHeaderStyle'}, {'text':'Date and Time', 'style': 'tableHeaderStyle'}, {'text':'Adult Count', 'style': 'tableHeaderStyle'}, {'text':'Adult Amt (Rs.)', 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Child Count', 'style': 'tableHeaderStyle'}, {'text':'Child Amt (Rs.)', 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Concession', 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Pass', 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Cash', 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'E-Purse', 'style': 'tableHeaderStyle'}, {'text':'Total Amt (Rs.)', 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Card Number', 'style': 'tableHeaderStyle'}]);
                        
                        var i = 1;
                        data.map((d) => {
                            console.log(d);
                            var fromStop = '';
                            var toStop = '';
                            var cardNumber = '';
                            var totalAmt = '0.00';
                            var concession = 0;
                            if(d.card_number)
                            {
                                cardNumber = d.card_number;
                            }else{
                                cardNumber = "N/A";
                            }
                            if(d.from_stop)
                            {
                                fromStop = d.from_stop.short_name;
                            }else{
                                fromStop = "N/A";
                            }
                            if(d.to_stop)
                            {
                                toStop = d.to_stop.short_name;
                            }else{
                                toStop = "N/A";
                            }

                            if(d.concession)
                            {
                                concession = d.concession.flat_fare_amount;
                            }else {
                                concession = '0.00';
                            }
                            totalAmt = d.childs_amt + d.adults_amt - concession;

                            reportData.push([{'text':''+i}, {'text':fromStop}, {'text':toStop}, {'text':d.sold_at}, {'text':''+d.adults}, {'text':''+d.adults_amt, 'alignment':'right'}, {'text':''+d.childs}, {'text':''+d.childs_amt, 'alignment':'right'}, {'text':''+concession, 'alignment':'right'}, {'text':'0.00', 'alignment':'right'}, {'text':'0.00', 'alignment':'right'}, {'text':'0.00', 'alignment':'right'}, {'text':''+totalAmt, 'alignment':'right'}, {'text':cardNumber}]);
                            i++;
                        });                            
                    }

                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    Export(metaData, title, reportData, takenBy, serverDate, 'auto', 'lightHorizontalLines');                    
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
        var pass_id = $('#pass_id').val();
        var fromDate = $('#from_date').val();
        if(!fromDate)
        {
            return alert('Please enter from date.');
        }

        var toDate = $('#to_date').val();
        if(!toDate)
        {
            return alert('Please enter to date.');
        }

        var splitFrom = fromDate.split('-');
        var splitTo = toDate.split('-');

        //Create a date object from the arrays
        fDate = new Date(splitFrom[2], splitFrom[1]-1, splitFrom[0]);
        tDate = new Date(splitTo[2], splitTo[1]-1, splitTo[0]);

        if(fDate > tDate)
        {
            return alert('From Date must be smaller than or equal to To Date.');
        }

        var queryParams = "?depot_id="+depot_id
                        + "&from_date="+fromDate
                        + "&service_id="+service_id
                        + "&pass_id="+pass_id
                        + "&to_date="+toDate;

        var url = "{{route('reports.etm.passes_validated_details.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

