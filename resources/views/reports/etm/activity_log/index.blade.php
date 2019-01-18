@extends('layouts.master')
@section('header')
<h1>ETM Activity Log Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>ETM Activity Log</a></li>
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
                'route' => 'reports.etm.activity_log.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date", "etm_no");'
                ]) !!}
                @include('reports.etm.activity_log.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Conductor Name</th>
                                    <th>Route</th>
                                    <th>Duty</th>
                                    <th>Login On</th>
                                    <th>Logout On</th>
                                    <th>Duty Hours</th>
                                    <th>Tkt + Pass</th>
                                    <th>Error Tkts Prntd.</th>
                                    <th>Battery Percentage on Login</th>
                                    <th>Battery Percentage on Logout</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$da)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$da->conductor->crew_name}}</td>
                                    <td>{{$da->wayBill->route->route_name}}</td>
                                    <td>{{$da->wayBill->duty->duty_number}}</td>
                                    <td>{{date('d-m-Y H:i:s', strtotime($da->login_timestamp))}}</td>
                                    <td>{{$da->logout_timestamp ? date('d-m-Y H:i:s', strtotime($da->logout_timestamp)) : ''}}</td>
                                    <td>{{$da->dutyHours}}</td>
                                    <td>{{$da->totalTicket}}</td>
                                    <td>{{'0'}}</td>
                                    <td>{{$da->battery_percentage}}</td>
                                    <td>{{$da->battery_percentage}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="12"><strong>No Record Found! &#9785</strong></td>
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
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();

        $.ajax({
            url: "{{route('reports.etm.activity_log.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                from_date: from_date,
                to_date: to_date,
                etm_no: etm_no
            },
            success: function(response)
            {
                console.log(response);
                if(response.status == 'Ok')
                {
                    var data = response.data;
                    var reportData = [];
                    
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Conductor Name', 'style': 'tableHeaderStyle'}, {'text':'Route', 'style': 'tableHeaderStyle'}, {'text':'Duty', 'style': 'tableHeaderStyle'}, {'text':'Login On', 'style': 'tableHeaderStyle'}, {'text':'Logout On', 'style': 'tableHeaderStyle'}, {'text':'Duty Hours', 'style': 'tableHeaderStyle'}, {'text':'Tkt + Pass', 'style': 'tableHeaderStyle'}, {'text':'Error Tkt Prntd.', 'style': 'tableHeaderStyle'}, {'text':'Battery Percentage On Login', 'style': 'tableHeaderStyle'}, {'text':'Battery Percentage On Logout', 'style': 'tableHeaderStyle'}]);
                        
                    $.each(data, function(index, d){  
                        var login_timestamp = "";
                        var logout_timestamp = "";
                        var battery_percentage_on_login = "";
                        var battery_percentage_on_logout = "";
                        
                        if(d.login_timestamp)
                        {
                            login_timestamp = d.login_timestamp; 
                        }else {
                            login_timestamp = "";
                        }

                        if(d.logout_timestamp)
                        {
                            logout_timestamp = d.logout_timestamp; 
                        }else {
                            logout_timestamp = "";
                        }

                        battery_percentage_on_login = d.battery_percentage;
                        battery_percentage_on_logout = d.battery_percentage;
                        
                        reportData.push([{'text':''+(index+1)}, {'text':''+d.conductor.crew_name}, {'text':d.way_bill.route.route_name}, {'text':''+d.way_bill.duty.duty_number}, {'text':''+login_timestamp}, {'text':''+logout_timestamp}, {'text':''+d.dutyHours}, {'text':''+d.totalTicket}, {'text':'0'}, {'text':''+battery_percentage_on_login}, {'text':''+battery_percentage_on_logout}]);
                    });

                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    Export(metaData, title, reportData, takenBy, serverDate, '*', 'lightHorizontalLines');                 
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
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();

        var queryParams = "?depot_id="+depot_id
                        + "&from_date="+from_date
                        + "&to_date="+to_date
                        + "&etm_no="+etm_no;

        var url = "{{route('reports.etm.activity_log.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

