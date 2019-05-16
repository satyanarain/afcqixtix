@extends('layouts.master')
@section('header')
<h1>Trip-wise Collection Report</h1>
<ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Trip-wise Collection</a></li>
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
                'route' => 'reports.revenue.trip_wise_collection.displaydata',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'autocomplete'=>'off',
                'method'=> 'GET',
                'onsubmit'=>'return validateForm("depot_id", "from_date", "to_date");'
                ]) !!}
                @include('reports.revenue.trip_wise_collection.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

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
                        <table class="table table-bordered" id="afcsReportTable">
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Trip No.</th>
                                    <th>From Stop</th>
                                    <th>To Stop</th>
                                    <th>Schld. Time</th>
                                    <th>Trip Start Time</th>
                                    <th>Trip End Time</th>
                                    <th class="text-right">Psngr Count</th>
                                    <th class="text-right">Total Amount</th>
                                    <th class="text-right">Ticket Count</th>
                                    <th class="text-right">Ticket Amount</th>
                                    <th class="text-right">Pass Count</th>
                                    <th class="text-right">Pass Amount</th>
                                    <th class="text-right">EPurse Count</th>
                                    <th class="text-right">EPurse Amount</th>
                                    <th class="text-right">Conc</th>
                                    <th class="text-right">Kms</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $keyo=>$d)
                            <tr>
                                <td class="text-left" colspan="16"><strong>Route - {{$d->route->route_name}}, Duty - {{$d->duty->duty_number}}, Crew - {{$d->conductor->crew_name.' ('.$d->conductor->crew_id.')'}}, ETM - {{$d->etm->etm_no}}, Vehicle No. - {{$d->vehicle->vehicle_registration_number}}, Driver - {{$d->driver->crew_name.' ('.$d->driver->crew_id.')'}}</strong></td>
                            </tr>
                            @php $trips = $d->trips;@endphp
                            @foreach($trips as $keyi=>$trip)
                                <tr>
                                    <td>{{$keyi+1}}</td>                                    
                                    <td>{{$trip->trip_id}}</td>
                                    <td>{{$trip->fromStop->short_name}}</td>
                                    <td>{{$trip->toStop->short_name}}</td>
                                    <td>{{$trip->schedule_time}}</td>
                                    <td>{{date('d-m-Y H:i:s', strtotime($trip->start_timestamp))}}</td>
                                    <td>{{date('d-m-Y H:i:s', strtotime($trip->end_timestamp))}}</td>   
                                    @php 
                                        $counts = $trip->counts;
                                        $passengersCount = 0;
                                        $totalAmount = 0;
                                        $concessionAmount = 0;
                                        $ticketCount = 0;
                                        $ticketAmount = 0;
                                        $passCount = 0;
                                        $passAmount = 0;
                                        $epurseCount = 0;
                                        $epurseAmount = 0;
                                        foreach($counts as $keyc=>$count)
                                        {
                                            $passengersCount += $count->passenger_count;
                                            $totalAmount += $count->ticket_amount;
                                            $concessionAmount += $count->concession_amount;
                                            if($count->ticket_type == 'Ticket')
                                            {
                                                $ticketCount += $count->passenger_count;
                                                $ticketAmount += $count->ticket_amount;
                                            }
                                            

                                            if($count->ticket_type == 'Pass' || $count->ticket_type == 'ETMPass')
                                            {
                                                $passCount += $count->passenger_count;
                                                $passAmount += $count->ticket_amount;
                                            }

                                            if($count->ticket_type == 'EPurse')
                                            {
                                                $epurseCount += $count->passenger_count;
                                                $epurseAmount += $count->ticket_amount;
                                            }
                                        }
                                    @endphp            
                                    <td class="text-right">{{$passengersCount}}</td>
                                    <td class="text-right">{{number_format((float)$totalAmount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$ticketCount}}</td>
                                    <td class="text-right">{{number_format((float)$ticketAmount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$passCount}}</td>
                                    <td class="text-right">{{number_format((float)$passAmount, 2, '.', '')}}</td>
                                    <td class="text-right">{{$epurseCount}}</td>
                                    <td class="text-right">{{number_format((float)$epurseAmount, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$concessionAmount, 2, '.', '')}}</td>
                                    <td class="text-right">{{number_format((float)$trip->distance, 2, '.', '')}}</td>
                                </tr>
                            @endforeach
                            @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="16"><strong>No Record Found! &#9785</strong></td>
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

        var duty_id = $('#duty_id').val();
        var route_id = $('#route_id').val();        

        $.ajax({
            url: "{{route('reports.revenue.trip_wise_collection.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                route_id: route_id,
                from_date: fromDate,
                to_date: toDate,
                depot_id: depot_id,
                duty_id: duty_id
            },
            success: function(response)
            {
                if(response.status == 'Ok')
                {
                    var data = response.data;
                    console.log(data)
                    var reportData = [];
                    reportData.push([{'text':'S. No.', 'style': 'tableHeaderStyle'}, {'text':'Trip No.', 'style': 'tableHeaderStyle'}, {'text':'From Stop', 'style': 'tableHeaderStyle'}, {'text':'To Stop', 'style': 'tableHeaderStyle'}, {'text':'Schld Time', 'style': 'tableHeaderStyle'}, {'text':'Trip Start Time', 'style': 'tableHeaderStyle'}, {'text':'Trip End Time', 'style': 'tableHeaderStyle'}, {'text':'Psngr Count', 'style': 'tableHeaderStyle'}, {'text':'Total Amount', 'style': 'tableHeaderStyle'}, {'text':'Ticket Count', 'style': 'tableHeaderStyle'}, {'text':'Ticket Amount', 'style': 'tableHeaderStyle'}, {'text':'Pass Count', 'style': 'tableHeaderStyle'}, {'text':'Pass Amount', 'style': 'tableHeaderStyle'}, {'text':'EPurse Count', 'style': 'tableHeaderStyle'}, {'text':'EPurse Amount', 'style': 'tableHeaderStyle'}, {'text':'Conc', 'style': 'tableHeaderStyle'}, {'text':'Kms', 'style': 'tableHeaderStyle'}]);

                    $.each(data, function(ind, waybill){  
                        console.log(waybill);
                        reportData.push([{'text':'Route - '+waybill.route.route_name+', Duty - '+waybill.duty.duty_number+', Crew - '+waybill.conductor.crew_name+' ('+waybill.conductor.crew_id+'), ETM - '+waybill.etm.etm_no+', Vehicle No. - '+waybill.vehicle.vehicle_registration_number+', Driver - '+waybill.driver.crew_name+' ('+waybill.driver.crew_id+')', alignment:'left', bold:true, colSpan:17}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}]);
                        var trips = waybill.trips;
                        if(trips)
                        {
                            var i = 1;
                            trips.map(function(trip){
                                var counts = trip.counts;
                                var passengersCount = 0;
                                var totalAmount = 0;
                                var concessionAmount = 0;
                                var ticketCount = 0;
                                var ticketAmount = 0;
                                var passCount = 0;
                                var passAmount = 0;
                                var epurseCount = 0;
                                var epurseAmount = 0;
                                counts.map(function(count){
                                    passengersCount += parseInt(count.passenger_count);
                                    totalAmount += parseFloat(count.ticket_amount);
                                    concessionAmount += count.concession_amount ? parseFloat(count.concession_amount) : 0;
                                    if(count.ticket_type == 'Pass' || count.ticket_type == 'ETMPass')
                                    {
                                        passCount += parseInt(count.passenger_count);
                                        passAmount += parseFloat(count.ticket_amount);
                                    }else if(count.ticket_type == 'Ticket'){
                                        ticketCount += parseInt(count.passenger_count);
                                        ticketAmount += parseFloat(count.ticket_amount);
                                    }else if(count.ticket_type == 'EPurse')
                                    {
                                        epurseCount += parseInt(count.passenger_count);
                                        epurseAmount += parseFloat(count.ticket_amount);
                                    }else{

                                    }
                                })
                                if(i%2 == 0)
                                {
                                    reportData.push([{'text':''+i, style:'oddRowStyle'}, {'text':''+trip.trip_id, style:'oddRowStyle'}, {'text':''+trip.from_stop.short_name, style:'oddRowStyle'}, {'text':''+trip.to_stop.short_name, style:'oddRowStyle'}, {'text':''+trip.schedule_time, style:'oddRowStyle'}, {'text':''+trip.start_timestamp, style:'oddRowStyle'}, {'text':''+trip.end_timestamp, style:'oddRowStyle'}, {'text':''+passengersCount, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(totalAmount).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+ticketCount, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(ticketAmount).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+passCount, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(passAmount).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+epurseCount, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(epurseAmount).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(concessionAmount).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(trip.distance).toFixed(2), alignment:'right', style:'oddRowStyle'}]);
                                }else{
                                    reportData.push([{'text':''+i}, {'text':''+trip.trip_id}, {'text':''+trip.from_stop.short_name}, {'text':''+trip.to_stop.short_name}, {'text':''+trip.schedule_time}, {'text':''+trip.start_timestamp}, {'text':''+trip.end_timestamp}, {'text':''+passengersCount, alignment:'right'}, {'text':''+parseFloat(totalAmount).toFixed(2), alignment:'right'}, {'text':''+ticketCount, alignment:'right'}, {'text':''+parseFloat(ticketAmount).toFixed(2), alignment:'right'}, {'text':''+passCount, alignment:'right'}, {'text':''+parseFloat(passAmount).toFixed(2), alignment:'right'}, {'text':''+epurseCount, alignment:'right'}, {'text':''+parseFloat(epurseAmount).toFixed(2), alignment:'right'}, {'text':''+parseFloat(concessionAmount).toFixed(2), alignment:'right'}, {'text':''+parseFloat(trip.distance).toFixed(2), alignment:'right'}]);
                                }
                                i++;
                            })
                        }
                    })
                
                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;
                    Export(metaData, title, reportData, takenBy, serverDate, 'auto', 'noBorders');  
                                    
                }                
            },
            error: function(error)
            {
                console.log(error);
            }
        })
    });

    $(document).on('click', '#exportAsXLS', function(){
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

        var depot_id = $('#depot_id').val();
        var route_id = $('#route_id').val();
        var duty_id = $('#duty_id').val(); 

        var queryParams = "?depot_id="+depot_id
                        + "&from_date="+fromDate
                        + "&to_date="+toDate
                        + "&route_id="+route_id
                        + "&duty_id="+duty_id;

        var url = "{{route('reports.revenue.trip_wise_collection.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
});
</script>
@endpush

