@extends('layouts.master')
@section('header')
<h1>Issues to Crew Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Issues to Crew</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create Issues to Crew</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.ppt.issues_to_crew.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.ppt.issues_to_crew.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Challan No. / Receipt No.</th>
                                    <th>Series</th>
                                    <th>Opening Ticket No.</th>
                                    <th>Closing Ticket No.</th>
                                    <th>Ticket Count</th>
                                    <th>Ticket Value</th>
                                    <th>Issued By</th>
                                    <th>Received By</th>
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
                                    <td>{{$da->challan_no}}</td>
                                    <td>{{$da->series}}</td>
                                    <td>{{$da->start_sequence}}</td>
                                    <td>{{$da->end_sequence}}</td>
                                    <td>{{$da->quantity}}</td>
                                    <td>{{$da->quantity*$da->denomination->price}}</td>
                                    <td>{{$da->issuedBy->name}}</td>
                                    <td>{{$da->conductor->crew_name.' ('.$da->conductor->crew_id.')'}}</td>
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
            url: "{{route('reports.ppt.issues_to_crew.getpdfreport')}}",
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
                    if(orderBy == 'created_at')
                    {
                        firstCol = 'Date';
                        secondCol = 'Denomination';
                    }else{
                        firstCol = 'Denomination';
                        secondCol = 'Date';
                    }
                    var reportData = [];
                    reportData.push([{'text':firstCol, 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Ticket Type', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':secondCol, 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Challan No. / Receipt No.', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Series', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Opening Ticket No.', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Closing Ticket No.', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Ticket Count', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Ticket Value', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'Issued By', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Received By', 'bold':true, 'style': 'tableHeaderStyle'}]);
                    
                    $.each(data, function(index, stock){
                        
                        if(stock.length > 0)
                        {
                            var totalTicketCount = 0;
                            var totalTicketValue = 0;
                            stock.map((d) => {
                                console.log(d);
                                totalTicketCount += parseInt(d.quantity);
                                totalTicketValue += parseInt(d.quantity*d.denomination.price);
                                if(orderBy == 'created_at')
                                {   
                                    var secondColVal = d.denomination.description;
                                }else{                                    
                                    var secondColVal = d.created_at;
                                }
                                reportData.push([{'text':index}, {'text':d.item.name}, {'text':secondColVal}, {'text':d.challan_no?d.challan_no:""}, {'text':d.series}, {'text':d.start_sequence?''+d.start_sequence:"", 'alignment':'right'}, {'text':d.end_sequence?''+d.end_sequence:"", 'alignment':'right'}, {'text':''+d.quantity, 'alignment':'right'}, {'text':''+d.quantity*d.denomination.price, 'alignment':'right'}, {'text': d.issued_by.name}, {'text': d.conductor.crew_name}]);
                            });
                            reportData.push([{'text':'Grand Total', 'bold':true, 'style': 'tableHeaderStyle', 'colSpan':7, 'alignment': 'right'}, {}, {}, {}, {}, {}, {}, {'text':''+totalTicketCount+'', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':''+totalTicketValue+'', 'bold':true, 'style': 'tableHeaderStyle', 'alignment':'right'}, {'text':'', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'', 'bold':true, 'style': 'tableHeaderStyle'}]);
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

        var url = "{{route('reports.ppt.issues_to_crew.getexcelreport')}}"+queryParams;

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

