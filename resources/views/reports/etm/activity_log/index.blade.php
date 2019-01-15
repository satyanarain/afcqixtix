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
                <h3 class="box-title">Create ETM Activity Log</h3>
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
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.etm.activity_log.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}

                @if(isset($data) && isset($flag) && $flag == 1)
                <div class="row" style="margin-top: 50px;" id="reportDataBox">
                    <div class="col-md-12">
                        <h4>
                            <button class="btn btn-primary pull-right" id="exportAsPDF">Export as PDF</button> 
                            <button class="btn btn-primary pull-right" style="margin-right: 10px;margin-bottom: 10px;" id="exportAsXLS">Export as XLS</button>
                        </h4>
                        <table class="table" id="afcsReportTable">
                            <thead>
                                <tr>
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
                                <tr>
                                    <td>{{$data->conductor->crew_name}}</td>
                                    <td>{{$data->route->route_name}}</td>
                                    <td>{{$data->duty->duty_number}}</td>
                                    <td>{{date('d-m-Y H:i:s', strtotime($data->etmLoginDetails->login_timestamp))}}</td>
                                    <td>{{$data->etmLoginDetails->logout_timestamp ? date('d-m-Y H:i:s', strtotime($data->etmLoginDetails->logout_timestamp)) : ''}}</td>
                                    <td>{{$dutyHours}}</td>
                                    <td>{{$totalTicket}}</td>
                                    <td>{{'0'}}</td>
                                    <td>{{$data->etmLoginDetails->battery_percentage}}</td>
                                    <td>{{$data->etmLoginDetails->battery_percentage}}</td>
                                </tr>
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
                    </div>
                </div>
                @elseif(isset($flag) && $flag == 0)
                <p class="alert alert-warning">No Activity Found!</p>
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
        var date = $('#date').val();

        $.ajax({
            url: "{{route('reports.etm.activity_log.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                date: date,
                etm_no: etm_no
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
                        reportData.push([{'text':'Conductor Name', 'style': 'tableHeaderStyle'}, {'text':'Route', 'style': 'tableHeaderStyle'}, {'text':'Duty', 'style': 'tableHeaderStyle'}, {'text':'Login On', 'style': 'tableHeaderStyle'}, {'text':'Logout On', 'style': 'tableHeaderStyle'}, {'text':'Duty Hours', 'style': 'tableHeaderStyle'}, {'text':'Tkt + Pass', 'style': 'tableHeaderStyle'}, {'text':'Error Tkt Prntd.', 'style': 'tableHeaderStyle'}, {'text':'Battery Percentage On Login', 'style': 'tableHeaderStyle'}, {'text':'Battery Percentage On Logout', 'style': 'tableHeaderStyle'}]);
                        
                        
                        var login_timestamp = "";
                        var logout_timestamp = "";
                        var battery_percentage_on_login = "";
                        var battery_percentage_on_logout = "";

                        if(d.etm_login_details)
                        {
                            if(d.etm_login_details.login_timestamp)
                            {
                                login_timestamp = d.etm_login_details.login_timestamp; 
                            }else {
                                login_timestamp = "";
                            }

                            if(d.etm_login_details.logout_timestamp)
                            {
                                logout_timestamp = d.etm_login_details.logout_timestamp; 
                            }else {
                                logout_timestamp = "";
                            }

                            battery_percentage_on_login = d.etm_login_details.battery_percentage;
                            battery_percentage_on_logout = d.etm_login_details.battery_percentage;
                        }
                        
                        reportData.push([{'text':''+d.conductor.crew_name}, {'text':d.route.route_name}, {'text':''+d.duty.duty_number}, {'text':''+login_timestamp}, {'text':''+logout_timestamp}, {'text':''+d.dutyHours}, {'text':''+d.totalTicket}, {'text':'0'}, {'text':''+battery_percentage_on_login}, {'text':''+battery_percentage_on_logout}]);

                        var metaData = response.meta;
                        var title = response.title;
                        var takenBy = response.takenBy;
                        var serverDate = response.serverDate;
                        Export(metaData, title, reportData, takenBy, serverDate, '*', 'lightHorizontalLines');  
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
        var date = $('#date').val();
        var etm_no = $('#etm_no').val();

        var queryParams = "?depot_id="+depot_id
                        + "&date="+date
                        + "&etm_no="+etm_no;

        var url = "{{route('reports.etm.activity_log.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
function validateForm()
{
    var date = $('#date').val();
    if(!date)
    {
        alert('Please enter date.');
        return false;
    }

    var etm_no = $('#etm_no').val();

    if(!etm_no)
    {
        alert('Please enter etm number.');
        return false;
    }

    return true;
}
</script>
@endpush

