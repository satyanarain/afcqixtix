@extends('layouts.master')
@section('header')
<h1>Crew Summary Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Crew Summary</a></li>
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
                'route' => 'reports.ppt.crew_summary.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date");'
                ]) !!}
                @include('reports.ppt.crew_summary.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                                    <th>Crew Name (ID)</th>
                                    <th>Item Type</th>
                                    <th>Denomination</th>
                                    <th>Series</th>
                                    <th class="text-right">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key=>$da)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$da->conductor->crew_name.' ('.$da->conductor->crew_id.')'}}</td>
                                    <td>{{$da->item->description}}</td>
                                    <td>{{$da->denomination->description}}</td>
                                    <td>{{$da->series}}</td>
                                    <td class="text-right">{{$da->qty}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="10"><strong>No Record Found! &#9785</strong></td>
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
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var conductor_id = $('#conductor_id').val();
        var denom_id = $('#denomination_id').val();
        var series = $('#series').val();

        $.ajax({
            url: "{{route('reports.ppt.crew_summary.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                from_date: from_date,
                to_date: to_date,
                conductor_id: conductor_id,
                denomination_id: denom_id,
                series: series
            },
            success: function(response)
            {
                console.log(response);
                if(response.status == 'Ok')
                {
                    var data = response.data;
                    var reportData = [];
                    reportData.push([{'text':'S. No.', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Conductor Name (ID)', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Item Type', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Denomination', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Series', 'bold':true, 'style': 'tableHeaderStyle'}, {'text':'Quantity', 'bold':true, 'style': 'tableHeaderStyle', alignment:'right'}]);
                    var i = 1;
                    data.map((d) => {
                        
                        reportData.push([{'text':''+i}, {'text':d.conductor.crew_name+' ('+d.conductor.crew_id+')'}, {'text':d.item.description}, {'text':d.denomination.description}, {'text':d.series}, {'text':''+d.qty, 'alignment':'right'}]);
                        i++;
                    });

                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    /*console.log(metaData);
                    return;*/
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
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var conductor_id = $('#conductor_id').val();
        var denom_id = $('#denomination_id').val();
        var series = $('#series').val();

        var queryParams = "?depot_id="+depot_id
                        + "&denomination_id="+denom_id
                        + "&from_date="+from_date
                        + "&to_date="+to_date
                        + "&conductor_id="+conductor_id
                        + "&series="+series;

        var url = "{{route('reports.ppt.crew_summary.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });

    $(document).on('change', '#depot_id', function(){
        var depot_id = $('#depot_id').val();

        var url = "{{route('inventory.crewstock.getdepotwisecrew', ':id')}}";
        url = url.replace(':id', depot_id);

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(response)
            {
                var data = response;
                if(data.status == 'Ok')
                {
                    var crews = data.data;      
                    var options = "<option value=''>All</option>";
                    $.each(crews, function(index, crew){
                        options += '<option value="'+crew.id+'">'+crew.crew_name+'</option>'
                    });                           

                    $('#conductor_id').html(options);
                }else{
                    $('#conductor_id').html('');
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

