@extends('layouts.master')
@section('header')
<h1>Trip Sheet</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#" class="active">Trip Sheet</a></li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
            <h3 class="box-title">Trip Sheet Details</h3>
        
           <table class="table">
               <tr>
                   <td style="width: 33.33%;">
                        <label for="depot_id">Depot</label><span class="label-required">*</span>
                        <select id="depot_id" class="form-control w-50-percent">
                            <option value="">Select</option>
                            @foreach($depots as $depot)
                                <option value="{{$depot->id}}">{{ucfirst($depot->name)}}</option>
                            @endforeach
                        </select>
                   </td>
                   <td style="width: 33.33%;">
                      <label for="from_date">From</label><span class="label-required">*</span>
                      <div class="input-group date w-50-percent">
                          <input type="text" id="from_date" value="{{date('Y-m-d 00:00')}}" class="form-control w-100-percent">
                      </div>
                   </td>
                   <td style="width: 33.33%;">
                        <label for="to_date">To</label><span class="label-required">*</span>
                        <div class="input-group date w-50-percent">
                          <input type="text" id="to_date" value="{{date('Y-m-d H:i')}}" class="form-control w-100-percent">
                        </div>
                   </td>
               </tr>
               <tr>                   
                   <td>
                        <label for="route">Route</label><span class="label-required">*</span>
                        <select id="route" class="form-control w-50-percent">
                           <option value="">Select</option>
                           @foreach($routes as $route)
                                <option value="{{$route->id}}">{{$route->route_name}}</option>
                            @endforeach
                        </select>
                   </td>
                   <td>
                        <label for="duty">Duty</label><span class="label-required">*</span>
                        <select id="duty" class="form-control w-50-percent">
                           <option value="">Select</option>
                        </select>
                   </td>
                   <td>
                        <label for="logins">Login*</label><span class="label-required">*</span>
                        <select id="logins" class="form-control w-50-percent">
                           <option value="">Select</option>
                        </select>
                   </td>
               </tr>
               <tr>
                   <td>
                        <label for="trip">Trip</label><span class="label-required">*</span>
                        <select id="trip" class="form-control w-50-percent">
                           <option value="">Select</option>
                        </select>
                   </td>

                   <td style="padding-top: 32px;">
                        <label for="">&nbsp;</label>
                        <div class="form-group" style="display: inline-block;margin-right: 40px;">
                          <input type="checkbox" checked id="ticket_types_normal" name="ticket_types">
                          <label for="ticket_types_normal">Normal</label>
                        </div>

                        <div class="form-group" style="display: inline-block;margin-right: 40px;">
                          <input type="checkbox" id="ticket_types_cancel" name="ticket_types">
                          <label for="ticket_types_cancel">Cancel</label>
                        </div>

                        <div class="form-group" style="display: inline-block;margin-right: 40px;">
                          <input type="checkbox" id="ticket_types_fine" name="ticket_types">
                          <label for="ticket_types_fine">Fine</label>
                        </div>
                   </td>

                   <td style="padding-top: 32px;">
                      <button class="btn btn-success" id="viewTripSheetDetails">View</button>
                      <span id="exportButtons" style="display: none;">
                         <button class="btn btn-primary" id="exportAsPDF">Export PDF</button>
                         <button class="btn btn-info" id="exportAsXLS">Export XLSX</button>
                      </span>
                   </td>
               </tr>
             </table>
            <div class="box-body">
              <table class="table table-striped table-bordered" id="example1">
                <thead>
                  <tr>
                    <th>Trip No.</th>
                    <th>From Stop</th>
                    <th>To Stop</th>
                    <th>Ticket</th>
                    <th>Tkt Issued At</th>
                    <th style="text-align:right;">No. Adult Tkts</th>
                    <th style="text-align:right;">No. Child Tkts</th>
                    <th style="text-align:right;">Pass Amt.</th>
                    <th style="text-align:right;">Total Amt.</th>
                  </tr>
                </thead>
                <tbody id="tripsheetbody">
                  <tr>
                    <th colspan="9" class="text-center bold">No Items Found!</th>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
@include('partials.report_script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('#from_date').datetimepicker();
    $('#to_date').datetimepicker();

    $(document).on('change', '#route', function(){
        var route = $('#route').val();
        if(!route)
        {
          return alert('Please select a route.');
        }


        $.ajax({
            url: "{{route('getdutiesbyroute')}}",
            type: "POST",
            data:{
              route: route
            },
            dataType: "JSON",
            success: function(response){
              console.log(response)
              if(response.status == 'Ok')
              {
                var data = response.data;
                var optionsStr = '<option value="">Select</option>';
                if(data.length > 0)
                {
                  $.each(data, function(index, duty){
                      optionsStr += '<option value="'+duty.id+'">'+duty.duty_number+'</option>'
                  })
                  $('#duty').html(optionsStr);
                }else{
                  $('#duty').html(optionsStr);
                }
              }
            },
            error: function(error){
              console.log(error);
            } 
        });
    });

    $(document).on('change', '#duty', function(){
        var route = $('#route').val();
        if(!route)
        {
          return alert('Please select a route.');
        }

        var duty = $('#duty').val();
        if(!duty)
        {
          return alert('Please select a duty.');
        }

        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();


        $.ajax({
            url: "{{route('gettripsbyrouteandduty')}}",
            type: "POST",
            data:{
              route: route,
              duty: duty,
              from_date: from_date,
              to_date: to_date
            },
            dataType: "JSON",
            success: function(response){
              console.log(response)
              if(response.status == 'Ok')
              {
                var data = response.data;
                var optionsStr = '<option value="">Select</option>';
                if(data.length > 0)
                {
                  var selectedRoute = $('#route :selected').text();
                  var selectedDuty = $('#duty :selected').text();
                  $.each(data, function(index, login){
                      optionsStr += '<option value="'+login.id+'">'+login.login_timestamp+' - '+selectedRoute+'/'+selectedDuty+" - "+login.conductor.crew_name+ ' ('+login.conductor.crew_id + ')'+'</option>'
                  })
                  $('#logins').html(optionsStr);
                }else{
                  $('#logins').html(optionsStr);
                }
              }
            },
            error: function(error){
              console.log(error);
            } 
        });
    }); 

    $(document).on('click', '#viewTripSheetDetails', function(){
        var depot_id = $('#depot_id').val();
        if(!depot_id)
        {
          return alert('Please select a depot.');
        }

        var from_date = $('#from_date').val();
        if(!from_date)
        {
          return alert('Please enter from date.');
        }

        var to_date = $('#to_date').val();
        if(!to_date)
        {
          return alert('Please enter to date.');
        }

        var route = $('#route').val();
        if(!route)
        {
          return alert('Please select a route.');
        }

        var duty = $('#duty').val();
        if(!duty)
        {
          return alert('Please select a duty.');
        }

        var logins = $('#logins').val();
        if(!logins)
        {
          return alert('Please select a login.');
        }

        var trip = $('#trip').val();
        if(!trip)
        {
          return alert('Please select a trip.');
        }

        $.ajax({
            url: "{{route('getticketsbyparams')}}",
            type: "POST",
            data:{
              depot_id: depot_id,
              route: route,
              duty: duty,
              from_date: from_date,
              to_date: to_date,
              logins: logins,
              trip: trip
            },
            dataType: "JSON",
            success: function(response){
              console.log(response)
              if(response.status == 'Ok')
              {
                var data = response.data;
                var tableData = '';
                if(data.length > 0)
                {
                  $.each(data, function(index, tdata){
                      tableData += '<tr>'
                      tableData += '<td>'+tdata.trip_id+'</td>'
                      tableData += '<td>'+tdata.from_stop.short_name+'</td>'
                      tableData += '<td>'+tdata.to_stop.short_name+'</td>'
                      tableData += '<td>'+tdata.ticket_number+'</td>'
                      tableData += '<td>'+tdata.sold_at+'</td>'
                      tableData += '<td style="text-align:right;">'+tdata.adults+'</td>'
                      tableData += '<td style="text-align:right;">'+tdata.childs+'</td>'
                      tableData += '<td style="text-align:right;">'+'0.00'+'</td>'
                      tableData += '<td style="text-align:right;">'+parseFloat(tdata.total_amt).toFixed(2)+'</td>'
                      tableData += '</tr>'
                  })
                  $('#tripsheetbody').html(tableData);
                  $('#exportButtons').show();
                }else{
                  tableData = "<tr><th colspan='9' class='text-center'>No Items Found!</th></tr>"
                  $('#tripsheetbody').html(tableData);
                  $('#exportButtons').hide();
                }
              }
            },
            error: function(error){
              console.log(error);
            } 
        });        
    }); 


    $(document).on('change', '#logins', function(){
        var logins = $('#logins').val();
        if(!logins)
        {
          return alert('Please select a login.');
        }

        $.ajax({
            url: "{{route('gettripsbylogin')}}",
            type: "POST",
            data:{
              logins: logins
            },
            dataType: "JSON",
            success: function(response){
              console.log(response)
              if(response.status == 'Ok')
              {
                var data = response.data;
                var optionsStr = '<option value="">Select</option>';
                if(data.length > 0)
                {
                  $.each(data, function(index, trip){
                      optionsStr += '<option value="'+trip.trip_id+'">'+trip.start_timestamp+' - '+trip.from_stop.short_name+' To '+trip.to_stop.short_name+'</option>'
                  })
                  $('#trip').html(optionsStr);
                }else{
                  $('#trip').html(optionsStr);
                }
              }
            },
            error: function(error){
              console.log(error);
            } 
        });
    }); 


    $(document).on('click', '#exportAsPDF', function(){
        $('#map1').show();
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

        var route_id = $('#route').val();
        if(!route_id)
        {
            alert('Please select a route.');
            return false;
        }

        var duty_id = $('#duty').val();
        if(!duty_id)
        {
            alert('Please select a duty.');
            return false;
        }

        $.ajax({
            url: "{{route('reports.revenue.trip_sheet.getpdfreport')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                depot_id: depot_id,
                from_date: fromDate,
                to_date: toDate,
                route_id: route_id,
                duty_id: duty_id
            },
            success: function(response)
            {
                if(response.status == 'Ok')
                {
                    var data = response.data;
                    console.log(data)
                    var reportData = [];
                    var widths = ['*', 100, 35, 20, 40, 20, 40, "*", 40, 40, 50, "*", "*", "*", "*"];
                    reportData.push([{'text':'Ticket No.', 'style': 'tableHeaderStyle'}, {'text':'End Stop', 'style': 'tableHeaderStyle'}, {'text':'Time', 'style': 'tableHeaderStyle'}, {'text':'Adults Count', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Adult Amt (Rs)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Child Count', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Child Amt (Rs)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Concession (Rs)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Pass', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Cash', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'E-Purse', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Total Amt (Rs)', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Pass Type', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'Card Number', 'style': 'tableHeaderStyle', alignment:'right'}, {'text':'E-Purse Balance', 'style': 'tableHeaderStyle', alignment:'right'}]);
                    $.each(data, function(ind, d){ 
                        var trips = d.trips;
                        //console.log(trips);
                        if(trips)
                        {
                          $.each(trips, function(trindex, trip){
                            var tickets = trip.tickets;
                            if(tickets.length)
                            {
                              reportData.push([{'text':'Trip No. : '+trip.trip_id, style:'subHeaderStyle'}, {'text':''+trip.start_timestamp, style:'subHeaderStyle', colSpan:2}, {}, {'text':'Route : ', style:'subHeaderStyle', alignment:'right'}, {'text':'Path : '+trip.direction, style:'subHeaderStyle', alignment:'right'}, {'text':trip.from_stop.stop+' To '+trip.to_stop.stop, style:'subHeaderStyle', colSpan:2}, {}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}]);
                              reportData.push([{'text':'Stage : '+trip.from_stop.stop, style:'subHeaderStyle', colSpan:2}, {}, {'text':'', style:'subHeaderStyle'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}, {'text':'', style:'subHeaderStyle', alignment:'right'}]);
                            }
                            if(tickets)
                            {
                              var i = 1;
                              $.each(tickets, function(tiindex, ticket){
                                var toStop = ticket.to_stop;
                                if(toStop)
                                {
                                  toStop = toStop.stop;
                                }
                                if(i%2 == 0)
                                {
                                    reportData.push([{'text':''+ticket.ticket_number, style:'oddRowStyle'}, {'text':''+toStop, style:'oddRowStyle'}, {'text':''+ticket.sold_at, style:'oddRowStyle', alignment:'right'}, {'text':''+ticket.adults, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(ticket.adults_amt).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+ticket.childs, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(ticket.childs_amt).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(ticket.concession_amt).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':'', style:'oddRowStyle', alignment:'right'}, {'text':'', style:'oddRowStyle', alignment:'right'}, {'text':'', style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(ticket.total_amt).toFixed(2), style:'oddRowStyle', alignment:'right'}, {'text':'', style:'oddRowStyle', alignment:'right'}, {'text':''+ticket.card_number, style:'oddRowStyle', alignment:'right'}, {'text':''+parseFloat(ticket.epurse_balance).toFixed(2), style:'oddRowStyle', alignment:'right'}]);
                                }else{
                                    reportData.push([{'text':''+ticket.ticket_number}, {'text':''+toStop}, {'text':''+ticket.sold_at, alignment:'right'}, {'text':''+ticket.adults, alignment:'right'}, {'text':''+parseFloat(ticket.adults_amt).toFixed(2), alignment:'right'}, {'text':''+ticket.childs, alignment:'right'}, {'text':''+parseFloat(ticket.childs_amt).toFixed(2), alignment:'right'}, {'text':''+parseFloat(ticket.concession_amt).toFixed(2), alignment:'right'}, {'text':''+parseFloat(0).toFixed(2), alignment:'right'}, {'text':''+parseFloat(0).toFixed(2), alignment:'right'}, {'text':''+parseFloat(0).toFixed(2), alignment:'right'}, {'text':''+parseFloat(ticket.total_amt).toFixed(2), alignment:'right'}, {'text':''}, {'text':''+ticket.card_number, alignment:'right'}, {'text':''+parseFloat(ticket.epurse_balance).toFixed(2), alignment:'right'}]);
                                }
                                i++;
                              })
                            }
                          })
                        }
                    })
                
                    var metaData = response.meta;
                    var title = response.title;
                    var takenBy = response.takenBy;
                    var serverDate = response.serverDate;

                    $('#map1').hide();
                    Export(metaData, title, reportData, takenBy, serverDate, widths, 'noBorders', 1);                                      
                }                
            },
            error: function(error)
            {
                $('#map1').hide();
                console.log(error);
            }
        })
    });

    $(document).on('click', '#exportAsXLS', function(){
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

        var route_id = $('#route').val();
        if(!route_id)
        {
            alert('Please select a route.');
            return false;
        }

        var duty_id = $('#duty').val();
        if(!duty_id)
        {
            alert('Please select a duty.');
            return false;
        }

        var queryParams = "?depot_id="+depot_id
                        + "&from_date="+fromDate
                        + "&to_date="+toDate
                        + "&route_id="+route_id
                        + "&duty_id="+duty_id;

        var url = "{{route('reports.revenue.trip_sheet.getexcelreport')}}"+queryParams;

        window.open(url,'_blank');
    });
})
</script>
@endpush