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
                'route' => 'reports.etm.audit_status.store',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                
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
                                            {{'Completed'}}
                                        @elseif($da->status == 's')
                                            {{'Submitted'}}
                                        @else
                                            {{'Generated'}}
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
                        {{-- {{$data->links()}} --}}
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.39/vfs_fonts.js"></script>
<script type="text/javascript">
        function Export(metaData, reportName, data) {
            html2canvas(document.getElementById('afcsReportTable'), {
                onrendered: function (canvas) {
                    var docDefinition = {
                        watermark: {text: 'Qixtix Reports', color: 'blue', opacity: 0.3, bold: true, italics: false},
                        pageSize: 'A4',
                        pageOrientation: 'landscape',
                        pageMargins: [ 40, 100, 40, 60 ],
                        header: {
                            columns: [
                                {
                                    stack: [
                                        {
                                            columns: [{ image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAE4AAABZCAYAAACQeRI+AAAACXBIWXMAAAsTAAALEwEAmpwYAAAFHGlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDIgNzkuMTYwOTI0LCAyMDE3LzA3LzEzLTAxOjA2OjM5ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxOCAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDE4LTA5LTI3VDE4OjA5OjM3KzA1OjMwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAxOC0wOS0yN1QxODoxMDowOCswNTozMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAxOC0wOS0yN1QxODoxMDowOCswNTozMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo4Zjg0OTdmZC0wZDI3LTc1NGMtOGM3Zi1iMjY0NjBlNzkyZmEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OGY4NDk3ZmQtMGQyNy03NTRjLThjN2YtYjI2NDYwZTc5MmZhIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6OGY4NDk3ZmQtMGQyNy03NTRjLThjN2YtYjI2NDYwZTc5MmZhIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo4Zjg0OTdmZC0wZDI3LTc1NGMtOGM3Zi1iMjY0NjBlNzkyZmEiIHN0RXZ0OndoZW49IjIwMTgtMDktMjdUMTg6MDk6MzcrMDU6MzAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE4IChXaW5kb3dzKSIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6lUZKQAAADmklEQVR4nO2dzWvTYBzHP0nTvXRjIqI3RZzeBJUKOtT5ehcRDyoyQS/iwZNe/QO8iIfhRRFf8CB42HXg0NvOOpEhbCJzKOI2px1bu8ZDkrlhXdpfkj5p+/tAWF/y5PnyIX3yS9I9tVzXRakdByCfz98CzgEW8MtoovRiA93AODDq+C/uA/Ybi9RY7ARKtv9k3mSSBmMOKATiyiaTNBglYNkOXU2piIoTouKEBOLajaZoQIJy5DdQ9B8vG8piEgtY8v92V9MgEHcPeLlqA62GjbfzbAKeAJvDGgTixv2l1cnh1bSh4vTgsJYeIFPNit4eV5hLMkxEXGjrAidrOsgaHIBM/4DpHP8n20F57BXutwmgDG05yDhg+KqOA2D3HjAaYl3sDNaWHbhT7z2BSwtQXATb7CjjALiFWaMh1sV1IduOtW0PmV19LA8P4n5+C509RmM54asYxrKg5FdImaz/EbWS6u0HVV7wCMRdBk7hJVpIJlPNdOJdibgDvPNeqjiu7Qa287eAlZABvuPVcRuqaRCIOw5cFHaaNC9YEVeRG8DVOmVZIRhh07KXVaIU8n4x5P1EaIYC2Ehd0gzijKDihKg4ISqudizAUnG1kwPa0n/mEJ1p4CZeydURcVsOMAtMt4K4WeBZ3BtthY+qTfQ97R+ke9wI8BjYWGO7GWAAOCbsV0rsVwWk4uaBR8K2Z4TtUoX0oxrlPmxT3MNthTEuEVScEBUnRMUJUXFCVJwQFSdExQlRcUJUnBAVJ0TFCVFxQlScEBUnRMUJUXFCVJwQFSdExQlRcUJUnBAVJ0TFCVFxQlScEBUnRMUJUXFCVJwQqbgoEx40xWQJ0i8W5oDzyL6R2SXsM1VIxZ30l5ZFxzghKk6IihOi4oSoOCEqToiKE9II4lI5n10jiOs0HaASgbhUhvPZajpAJYJTrjd48iygQDz/bVcEeoE+oC3CdgoxZImdQNwDf0mCo8BdYK+w/ZfYksRIPca418BBYFDYPrEZqKJQr4PDInAdOAGM1anPRKn3UXUEOAQ8rHO/sWOiHJkDrgCngY8G+o8Fk3XcEHAYeGowgxjTBfBX4BJwAZgynKUmTIsLeA4cwZv9uiFIiziACeAscI21v5uTyl8jSpO4gPtAHhj1n4fNWRl2VpIjRfOOJM040A/cBj6FrDsD/MSbHHT1dNtlvJnyJ0ngCktaxYF343qI8IPGB2AY70CzWpyLN3f5JAmI+wPLpoofPiyxUAAAAABJRU5ErkJggg==',
                                            width: 20,
                                            margin: [90, 20, 0, 0],
                                            alignment: 'center'
                                            },
                                            {
                                                text: "Qixtix Ltd.",
                                                style: 'topHeader'
                                            }]
                                        },
                                        {
                                            text: reportName,
                                            style: 'middleHeader'
                                        },
                                        {
                                            columns: metaData
                                        }
                                    ],
                                    width: '*'
                                }
                            ],
                            margin: [40, 0, 30, 0]
                        },
                        footer: {
                            columns: [
                                'Left part',
                                { text: 'Right part', alignment: 'right' }
                            ]
                        },
                        content: [
                        {
                            table:{
                                headerRows: 1,
                                widths: '*',

                                body: data
                            }
                        }],
                        styles: {
                            topHeader: {
                                fontSize: 18,
                                bold: true,
                                alignment: 'center',
                                marginTop: 10
                            },
                            middleHeader: {
                                fontSize: 12,
                                alignment: 'center',
                                marginBottom: 10
                            }
                        }
                    };
                    pdfMake.createPdf(docDefinition).download(reportName+'.pdf');
                }
            });
        }
</script>
<script type="text/javascript">
$(document).ready(function(){
    /*$(document).on('click', '#exportAsPDF', function(){
        var data = $('#afcsReportTable tr').get().map(function(row) {
            return $(row).find('td,th').get().map(function(cell) {
                return $(cell).html().toString().trim();
            });
        });

        console.log(data);
        console.log(typeof(data))
        //return false;
        var metaData = ["First columns", "Second columns", "First columns", "Fourth columns", "Fifth columns"];
        var reportName = 'ETM Audit Status';
        Export(metaData, reportName, data);
    });*/


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
                    var data = response.data;
                    var metaData = ["First columns", "Second columns", "First columns", "Fourth columns", "Fifth columns"];
                    var reportName = 'ETM Audit Status';
                    Export(metaData, reportName, data);
                }                
            },
            error: function(error)
            {
                console.log(error);
            }
        })
    });
});

</script>
@endpush

