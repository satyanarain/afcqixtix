@extends('layouts.master')
@section('header')
<h1>Route-wise Revenue Collection Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Route-wise Revenue Collection</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create Route-wise Revenue Collection Report</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.revenue.route_wise_collection.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.revenue.route_wise_collection.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}

                <div class="row" style="margin-top: 50px;" id="reportDataBox">
                    <div class="col-md-12">
                        @if(count($finalData))
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
                                    <th colspan="4" style="text-align: center;">ETM</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Route</th>
                                    <th>Date</th>
                                    <th>Duty No.</th>
                                    <th>No. of Trips</th>
                                    <th>Crew ID</th>
                                    <th>Ticket Count</th>
                                    <th>Ticket Amount (Rs)</th>
                                    <th>Pass Sold Count</th>
                                    <th>Pass Sold Amount (Rs)</th>
                                    <th>Ticket Count</th>
                                    <th>Ticket Amount (Rs)</th>
                                    <th>Pass Sold Count</th>
                                    <th>Pass Sold Amount (Rs)</th>
                                    <th>Payout Amount (Rs)</th>
                                    <th>Fine Amount (Rs)</th>
                                    <th>Dist. (Kms)</th>
                                    <th>Cash (Rs)</th>
                                    <th>E-Purse (Rs)</th>
                                    <th>Total Amount (Rs)</th>
                                    <th>Concession Amount (Rs)</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($routes as $key=>$route)
                            @php $routeData = $finalData[$route];@endphp
                            @foreach($routeData as $keyi=> $rdata)
                                <tr>
                                    <td>{{$keyi+1}}</td>
                                    <td>{{$rdata['route']}}</td>
                                    <td>{{$rdata['date']}}</td>
                                    <td>{{$rdata['duty']}}</td>
                                    <td class="text-right">{{$rdata['trips']}}</td>
                                    <td>{{$rdata['crew_id']}}</td>
                                    <td class="text-right">{{$rdata['TPT']}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['TPTS'], 2, '.', '')}}</td>
                                    <td class="text-right">{{$rdata['TPP']}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['TPPS'], 2, '.', '')}}</td>
                                    <td class="text-right">{{$rdata['totalETMTkts']}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['totalETMTktsSum'], 2, '.', '')}}</td>
                                    <td class="text-right">{{$rdata['totalETMPassCnt']}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['totalETMPassSum'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['payout'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['penalty_amount'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['distance'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['totalCash'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['EP'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['totalAmt'], 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$rdata['cnci'], 2, '.', '')}}</td>
                                </tr>
                            @endforeach
                            @endforeach
                            @if(!count($finalData))
                                <tr>
                                    <td colspan="20" class="text-center">No Records Found!</td>
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
        var route_id = $('#route_id').val();
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
            url: "{{route('reports.revenue.route_wise_collection.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                route_id: route_id,
                from_date: fromDate,
                to_date: toDate
            },
            success: function(response)
            {
                if(response.status == 'Ok')
                {
                    var routes = response.routes;
                    var d = response.data;
                    console.log(d[1])
                    var reportData = [];
                    reportData.push([{'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'PPT', 'style': 'tableHeaderStyle', colSpan: 4, 'alignment':'center'}, {}, {}, {}, {'text':'ETM', 'style': 'tableHeaderStyle', colSpan: 4, 'alignment':'center'}, {}, {}, {}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}, {'text':'', 'style': 'tableHeaderStyle'}]);
                    reportData.push([{'text':'Route', 'style': 'tableHeaderStyle'}, {'text':'Date', 'style': 'tableHeaderStyle'}, {'text':'Duty No.', 'style': 'tableHeaderStyle'}, {'text':'No. of Trips', 'style': 'tableHeaderStyle'}, {'text':'Crew ID', 'style': 'tableHeaderStyle'}, {'text':'Ticket Count', 'style': 'tableHeaderStyle'}, {'text':'Ticket Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Count', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Ticket Count', 'style': 'tableHeaderStyle'}, {'text':'Ticket Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Count', 'style': 'tableHeaderStyle'}, {'text':'Pass Sold Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Payout Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Fine Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Dist. (Kms)', 'style': 'tableHeaderStyle'}, {'text':'Cash (Rs)', 'style': 'tableHeaderStyle'}, {'text':'EPurse (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Total Amount (Rs)', 'style': 'tableHeaderStyle'}, {'text':'Concession Amount (Rs)', 'style': 'tableHeaderStyle'}]);
                    $.each(routes, function(index, route){
                        var routeData = d[route];
                        console.log(route);
                        if(routeData)
                        {
                            $.each(routeData, function(ind, d){
                                reportData.push([{'text':d.route}, {'text':''+d.date}, {'text':''+d.duty}, {'text':''+d.trips}, {'text':''+d.crew_id}, {'text':''+d.TPT}, {'text':''+parseFloat(d.TPTS).toFixed(2)}, {'text':''+d.TPP}, {'text':''+parseFloat(d.TPPS).toFixed(2)}, {'text':''+d.totalETMTkts}, {'text':''+parseFloat(d.totalETMTktsSum).toFixed(2)}, {'text':''+d.totalETMPassCnt}, {'text':''+parseFloat(d.totalETMPassSum).toFixed(2)}, {'text':''+parseFloat(d.payout).toFixed(2)}, {'text':''+parseFloat(d.penalty_amount).toFixed(2)}, {'text':''+parseFloat(d.distance).toFixed(2)}, {'text':''+parseFloat(d.totalCash).toFixed(2)}, {'text':''+parseFloat(d.EP).toFixed(2)}, {'text':''+parseFloat(d.totalAmt).toFixed(2)}, {'text':''+parseFloat(d.cnci).toFixed(2)}]);
                            })
                        }
                    })
                
                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    Export(metaData, title, reportData, takenBy, serverDate, 'auto', '');  
                                    
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
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var route_id = $('#route_id').val();

        var queryParams = "?depot_id="+depot_id
                        + "&from_date="+from_date
                        + "&to_date="+to_date
                        + "&route_id="+route_id;

        var url = "{{route('reports.revenue.route_wise_collection.getexcelreport')}}"+queryParams;

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

