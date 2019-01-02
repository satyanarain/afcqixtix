@extends('layouts.master')
@section('header')
<h1>Passes Validated Details Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Passes Validated Details</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create Passes Validated Details</h3>
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
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.etm.passes_validated_details.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}

                @if(isset($data))
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-12">
                        <h4>
                            <button class="btn btn-primary pull-right" id="exportAsPDF">Export as PDF</button> 
                            <button class="btn btn-primary pull-right" style="margin-right: 10px;margin-bottom: 10px;" id="exportAsXLS">Export as XLS</button>
                        </h4>
                        <table class="table" id="afcsReportTable">
                            <thead>
                                <tr>
                                    <th>From Stop</th>
                                    <th>To Stop</th>
                                    <th>Date and Time</th>
                                    <th>Adult Count</th>
                                    <th style="text-align: right;">Adult Amount (Rs.)</th>
                                    <th>Child Count</th>
                                    <th style="text-align: right;">Child Amount (Rs.)</th>
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
                                    <td style="text-align: right;">{{'0.00'}}</td>
                                    <td>{{$da->card_number}}</td>
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
                        reportData.push([{'text':'From Stop', 'style': 'tableHeaderStyle'}, {'text':'To Stop', 'style': 'tableHeaderStyle'}, {'text':'Date and Time', 'style': 'tableHeaderStyle'}, {'text':'Adult Count', 'style': 'tableHeaderStyle'}, {'text':'Adult Amount (Rs.)', 'style': 'tableHeaderStyle'}, {'text':'Child Count', 'style': 'tableHeaderStyle'}, {'text':'Child Amount (Rs.)', 'style': 'tableHeaderStyle'}, {'text':'Concession', 'style': 'tableHeaderStyle'}, {'text':'Pass', 'style': 'tableHeaderStyle'}, {'text':'Cash', 'style': 'tableHeaderStyle'}, {'text':'E-Purse', 'style': 'tableHeaderStyle'}, {'text':'Total Amt (Rs.)', 'style': 'tableHeaderStyle'}, {'text':'Card Number', 'style': 'tableHeaderStyle'}]);
                        
                        
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

                            reportData.push([{'text':fromStop}, {'text':toStop}, {'text':d.sold_at}, {'text':''+d.adults}, {'text':''+d.adults_amt, 'alignment':'right'}, {'text':''+d.childs}, {'text':''+d.childs_amt}, {'text':''+concession}, {'text':'0.00'}, {'text':'0.00'}, {'text':'0.00'}, {'text':totalAmt}, {'text':cardNumber}]);
                        });                            
                    }

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
                        + "&to_date="+toDate;

        var url = "{{route('reports.etm.passes_validated_details.getexcelreport')}}"+queryParams;

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
