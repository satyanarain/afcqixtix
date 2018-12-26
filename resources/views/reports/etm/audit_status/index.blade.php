@extends('layouts.master')
@section('header')
<h1>Manage Audit Status Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Audit Status</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create Audit Status reports</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.etm.audit_status.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET'
                ]) !!}
                @include('reports.etm.audit_status.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>ETM No.</th>
                                    <th>Login Time</th>
                                    <th>Route-Duty-Shift</th>
                                    <th>Logout Time</th>
                                    <th>Conductor</th>
                                    <th>Vehicle No.</th>
                                    <th>Handed Over To</th>
                                    <th>Audited</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$da)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$da->etm->etm_no}}</td>
                                    <td>{{$da->etmLoginDetails->login_timestamp}}</td>
                                    <td>{{$da->route->route_name}} / {{$da->duty->duty_number}} / {{$da->shift->shift}}</td>
                                    <td>{{$da->etmLoginDetails->logout_timestamp}}</td>
                                    <td>{{$da->conductor->crew_name}} ({{$da->conductor->crew_id}})</td>
                                    <td>{{$da->vehicle->vehicle_registration_number}}</td>
                                    <td></td>
                                    <td>
                                        @if($da->status == 'c')
                                            {{'Yes'}}
                                        @elseif($da->status == 's')
                                            {{'No'}}
                                        @else
                                            {{'No'}}
                                        @endif
                                    </td>
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
                                    <td>o</td>
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
        var report_date = $('#report_date').val();
        var shift_id = $('#shift_id').val();
        var status_type = $('#status_type').val();
        var etm_no = $('#etm_no').val();

        $.ajax({
            url: "{{route('reports.etm.audit_status.getdata')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                report_date: report_date,
                shift_id: shift_id,
                status_type: status_type,
                etm_no: etm_no
            },
            success: function(response)
            {
                console.log(response);
                if(response.status == 'Ok')
                {
                    var columns = response.columns
                    var data = response.data;
                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    var reportData = [];
                    if(data.length > 1)
                    {
                        $.each(data, function(index, d){
                            if(index == 0)
                            {
                                reportData.push([{'text':d[0], 'style': 'tableHeaderStyle'}, {'text':d[1], 'style': 'tableHeaderStyle'},{'text':d[2], 'style': 'tableHeaderStyle'}, {'text':d[3], 'style': 'tableHeaderStyle'}, {'text':d[4], 'style': 'tableHeaderStyle'}, {'text':d[5], 'style': 'tableHeaderStyle'}, {'text':d[6], 'style': 'tableHeaderStyle'}, {'text':d[7], 'style': 'tableHeaderStyle'}, {'text':d[8], 'style': 'tableHeaderStyle'}])
                            }else{
                                reportData.push([{'text':d[0]}, {'text':d[1]},{'text':d[2]}, {'text':d[3]}, {'text':d[4]}, {'text':d[5]}, {'text':d[6]}, {'text':d[7]}, {'text':d[8]}])
                            }
                            
                        })
                        Export(metaData, title, reportData, takenBy, serverDate);
                    }else{
                        return alert('No records to download!');
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
        var report_date = $('#report_date').val();
        var shift_id = $('#shift_id').val();
        var status_type = $('#status_type').val();
        var etm_no = $('#etm_no').val();

        var queryParams = "?depot_id="+depot_id
                        + "&report_date="+report_date
                        + "&shift_id="+shift_id
                        + "&status_type="+status_type
                        + "&etm_no="+etm_no;

        var url = "{{route('reports.etm.audit_status.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

