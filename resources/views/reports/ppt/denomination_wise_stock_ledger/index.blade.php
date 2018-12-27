@extends('layouts.master')
@section('header')
<h1>Denomination Wise Stock Ledger Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Denomination Wise Stock Ledger</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create Denomination Wise Stock Ledger</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.ppt.denomination_wise_stock_ledger.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.ppt.denomination_wise_stock_ledger.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>S. No.</th>
                                    <th>Ticket Type</th>
                                    <th>Denomination</th>
                                    <th>Date</th>
                                    <th>Challan No. / Receipt No.</th>
                                    <th>Series</th>
                                    <th>Opening Ticket No.</th>
                                    <th>Closing Ticket No.</th>
                                    <th style="text-align: right">Ticket Count</th>
                                    <th style="text-align: right">Ticket Value (Rs.)</th>
                                    <th>Transaction Type</th>
                                    <th style="text-align: right">Balance Count</th>
                                    <th style="text-align: right">Balance Value (Rs.)</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$da)
                                <tr>
                                    <td>{{$key+1}}</td>                                    
                                    <td>{{$da->item->name}}</td>
                                    <td>{{$da->denomination->description}}</td>
                                    <td>{{date('d/m/Y', strtotime($da->transaction_date))}}</td>
                                    <td>{{$da->challan_no}}</td>
                                    <td>{{$da->series}}</td>
                                    <td>{{$da->start_sequence}}</td>
                                    <td>{{$da->end_sequence}}</td>
                                    <td style="text-align: right">{{$da->item_quantity}}</td>
                                    <td style="text-align: right">{{$da->item_quantity*$da->denomination->price}}</td>
                                    <td>{{$da->transaction_type}}</td>
                                    <td style="text-align: right">{{$da->balance_quantity}}</td>
                                    <td style="text-align: right">{{$da->balance_quantity*$da->denomination->price}}</td>
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
        var denom_id = $('#denomination_id').val();
        var conductor_id = $('#conductor_id').val();
        var ledger = $('#ledger').val();
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
            url: "{{route('reports.ppt.denomination_wise_stock_ledger.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                denomination_id: denom_id,
                conductor_id: conductor_id,
                from_date: fromDate,
                to_date: toDate,
                ledger: ledger
            },
            success: function(response)
            {
                console.log(response);
                if(response.status == 'Ok')
                {
                    var data = response.data;
                    var reportData = [];
                    reportData.push([{'text':'Ticket Type', 'style': 'tableHeaderStyle'}, {'text':'Denomination', 'style': 'tableHeaderStyle'}, {'text':'Date', 'style': 'tableHeaderStyle'}, {'text':'Challan No. / Receipt No.', 'style': 'tableHeaderStyle'}, {'text':'Series', 'style': 'tableHeaderStyle'}, {'text':'Opening Ticket No.', 'style': 'tableHeaderStyle'}, {'text':'Closing Ticket No.', 'style': 'tableHeaderStyle'}, {'text':'Ticket Count', 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Ticket Value', 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Transaction Type', 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Balance Count', 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Balance Value', 'style': 'tableHeaderStyle', 'alignment':'right'}]);
                            
                    if(data.length > 0)
                    {
                        data.map((d) => {
                            console.log(d);                                    
                            reportData.push([{'text':d.item.name}, {'text':d.denomination.description}, {'text':d.transaction_date}, {'text':d.challan_no}, {'text':d.series}, {'text':''+d.start_sequence}, {'text':''+d.end_sequence}, {'text':''+d.item_quantity, 'alignment':'right'}, {'text':''+d.item_quantity*d.denomination.price, 'alignment':'right'}, {'text':d.transaction_type}, {'text':''+d.balance_quantity, 'alignment':'right'}, {'text':''+d.balance_quantity*d.denomination.price, 'alignment':'right'}]);
                        });
                    }
                    console.log(reportData);
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
        var denom_id = $('#denomination_id').val();
        var ledger = $('#ledger').val();
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
                        + "&denomination_id="+denom_id
                        + "&ledger="+ledger
                        + "&from_date="+fromDate
                        + "&to_date="+toDate;

        var url = "{{route('reports.ppt.denomination_wise_stock_ledger.getexcelreport')}}"+queryParams;

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

