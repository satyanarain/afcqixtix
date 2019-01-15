@extends('layouts.master')
@section('header')
<h1>ETM Not Sync Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>ETM Not Sync</a></li>
            </ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">Create ETM Not Sync Report</h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'reports.etm.not_sync.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('reports.etm.not_sync.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>ETM No.</th>
                                    <th>Last Manual Sync On</th>
                                    <th>Login Crew Name (Crew ID)</th>
                                    <th>Login Timestamp</th>
                                    <th>Logout Timestamp</th>
                                    <th style="text-align: right;">No. of Days</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $da)
                                <tr>
                                    <td>{{$da->etm->etm_no}}</td>
                                    <td>{{$da->last_manual_sync}}</td>
                                    <td>{{$da->conductor->crew_name.' ('.$da->conductor->crew_id.')'}}</td>
                                    <td>{{date('d-m-Y h:i A', strtotime($da->login_timestamp))}}</td>
                                    <td>{{date('d-m-Y h:i A', strtotime($da->logout_timestamp))}}</td>
                                    <td style="text-align: right;">{{$da->no_of_days}}</td>
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

        var date = $('#date').val();
        if(!date)
        {
            return alert('Please enter till date.');
        }
        var etm_no = $('#etm_no').val();

        $.ajax({
            url: "{{route('reports.etm.not_sync.getpdfreport')}}",
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
                    var data = response.data;

                    var reportData = [];
                    if(data.length > 0)
                    {
                        reportData.push([{'text':'ETM No.', 'style': 'tableHeaderStyle'}, {'text':'Last Manual Sync On', 'style': 'tableHeaderStyle'}, {'text':'Login Crew Name (Crew ID)', 'style': 'tableHeaderStyle'}, {'text':'Login Timestamp', 'style': 'tableHeaderStyle'}, {'text':'Logout Timestamp', 'style': 'tableHeaderStyle'}, {'text':'No. of Days', 'style': 'tableHeaderStyle', 'alignment':'right'}]);
                        
                        
                        data.map((d) => {
                            reportData.push([{'text':''+d.etm.etm_no}, {'text':''+d.last_manual_sync}, {'text':''+d.conductor.crew_name+' ('+d.conductor.crew_id+')'}, {'text':d.login_timestamp}, {'text':''+d.logout_timestamp}, {'text':''+d.no_of_days, 'alignment':'right'}]);
                        });                            
                    }

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
        var date = $('#date').val();
        if(!date)
        {
            return alert('Please enter till date.');
        }

        var etm_no = $('#etm_no').val();

        var queryParams = "?depot_id="+depot_id
                        + "&date="+date
                        + "&etm_no="+etm_no;

        var url = "{{route('reports.etm.not_sync.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
function validateForm()
    {
        var date = $('#date').val();
        if(!date)
        {
            alert('Please enter till date.');
            return false;
        }

        return true;
    }
</script>
@endpush

