@extends('layouts.master')
@section('header')
<h1>Consumption of PPT Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Consumption of PPT</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create Consumption of PPT</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.ppt.consumption.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.ppt.consumption.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Date</th>
                                    <th>Ticket Type</th>
                                    <th>Denomination</th>
                                    <th>Ticket Count</th>
                                    <th>Ticket Value</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$da)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{date('d/m/Y', strtotime($da->created_at))}}</td>
                                    <td>{{'Ticket'}}</td>
                                    <td>{{$da->denomination->description}}</td>
                                    <td>{{$da->quantity}}</td>
                                    <td>{{$da->quantity*$da->denomination->price}}</td>
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
        var orderBy = $('#order_by').val();
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
            url: "{{route('reports.ppt.consumption.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                denomination_id: denom_id,
                conductor_id:conductor_id,
                order_by: orderBy,
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
                    
                    firstCol = 'Date';
                    secondCol = 'Denomination';

                    var reportData = [];
                    reportData.push([{'text':firstCol, 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Ticket Type', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':secondCol, 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Ticket Count', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Ticket Value', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}]);
                    
                    $.each(data, function(index, stock){
                        
                        if(stock.length > 0)
                        {
                            var totalTicketCount = 0;
                            var totalTicketValue = 0;
                            stock.map((d) => {
                                console.log(d);
                                totalTicketCount += parseInt(d.quantity);
                                totalTicketValue += parseInt(d.quantity*d.denomination.price);
                                 
                                var secondColVal = d.denomination.description;
                                
                                reportData.push([{'text':index}, {'text':'Ticket'}, {'text':secondColVal}, {'text':''+d.quantity, 'alignment':'right'}, {'text':''+d.quantity*d.denomination.price, 'alignment':'right'}]);
                            });
                            reportData.push([{'text':'Grand Total', 'bold':true, 'style': 'tableHeaderStyle', 'colSpan':3, 'alignment': 'right'}, {}, {}, {'text':''+totalTicketCount+'', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':''+totalTicketValue+'', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}]);
                        }   
                    });

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
        var conductor_id = $('#conductor_id').val();
        var orderBy = $('#order_by').val();
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
                        + "&conductor_id="+conductor_id
                        + "&from_date="+fromDate
                        + "&to_date="+toDate
                        + "&order_by="+orderBy;

        var url = "{{route('reports.ppt.consumption.getexcelreport')}}"+queryParams;

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

