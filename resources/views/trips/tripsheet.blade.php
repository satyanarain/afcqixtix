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
                   <td style="width: 20%;">Depot</td>
                   <td>
                       <select id="depot_id" class="form-control w-50-percent">
                            <option value="">Select</option>
                            @foreach($depots as $depot)
                                <option value="{{$depot->id}}">{{ucfirst($depot->name)}}</option>
                            @endforeach
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>From Date</td>
                   <td>
                      <div class="input-group date w-50-percent">
                          <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" id="from_date" value="{{date('Y-m-d 00:00')}}" class="form-control w-100-percent">
                      </div>
                   </td>
               </tr>
               <tr>
                   <td>To Date</td>
                   <td>
                        <div class="input-group date w-50-percent">
                          <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" id="to_date" value="{{date('Y-m-d H:i')}}" class="form-control w-100-percent">
                        </div>
                   </td>
               </tr>
               <tr>
                   <td>Route</td>
                   <td>
                       <select id="route" class="form-control w-50-percent">
                           <option value="">Select</option>
                           @foreach($routes as $route)
                                <option value="{{$route->id}}">{{$route->route_name}}</option>
                            @endforeach
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>Duty</td>
                   <td>
                       <select id="duty" class="form-control w-50-percent">
                           <option value="">Select</option>
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>Login *</td>
                   <td>
                       <select id="logins" class="form-control w-50-percent">
                           <option value="">Select</option>
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>Trip</td>
                   <td>
                       <select id="trip" class="form-control w-50-percent">
                           <option value="">Select</option>
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>Ticket Types</td>
                   <td>
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
               </tr>
               <tr>
                   <td>
                   </td>
                   <td>
                        <button class="btn btn-success" id="viewTripSheetDetails">View</button>
                   </td>
               </tr>
             </table>
            <div class="box-body">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Trip No.</th>
                    <th>From Stop</th>
                    <th>To Stop</th>
                    <th>Ticket</th>
                    <th>Tkt Issued At</th>
                    <th>No. Adult Tkts</th>
                    <th>No. Child Tkts</th>
                    <th>Pass Amt.</th>
                    <th>Total Amt.</th>
                  </tr>
                </thead>
                <tbody id="tripsheetbody">
                  <tr>
                    <th>No Items Found!</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
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
                      tableData += '<td>'+tdata.adults+'</td>'
                      tableData += '<td>'+tdata.childs+'</td>'
                      tableData += '<td style="text-align:right;">'+0.00+'</td>'
                      tableData += '<td style="text-align:right;">'+parseFloat(tdata.total_amt).toFixed(2)+'</td>'
                      tableData += '</tr>'
                  })
                  $('#tripsheetbody').html(tableData);
                }else{
                  tableData = "<tr><th>No Items Found!</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>"
                  $('#tripsheetbody').html(tableData);
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
})
</script>
@endpush