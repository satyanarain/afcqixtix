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
                                <option value="{{$depot->id}}">{{$depot->name}}</option>
                            @endforeach
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>From Date</td>
                   <td>
                      <div class="input-group date">
                          <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" id="from_data" class="form-control w-50-percent multiple_date">
                      </div>
                   </td>
               </tr>
               <tr>
                   <td>To Date</td>
                   <td>
                        <div class="input-group date">
                          <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" id="to_date" class="form-control w-50-percent multiple_date">
                        </div>
                   </td>
               </tr>
               <tr>
                   <td>Route</td>
                   <td>
                       <select id="route" class="form-control w-50-percent">
                           <option value="">Select</option>
                           @foreach($routes as $route)
                                <option value="{{$route->id}}">{{$route->route}}</option>
                            @endforeach
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>Duty</td>
                   <td>
                       <select id="duty" class="form-control w-50-percent">
                           <option value="">Select</option>
                           @foreach($duties as $duty)
                                <option value="{{$duty->id}}">{{$duty->duty_number}}</option>
                            @endforeach
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>Login *</td>
                   <td>
                       <select id="status" class="form-control w-50-percent">
                           <option value="1">Logged In</option>
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>Trip</td>

                   <td>
                       <select id="trip" class="form-control w-50-percent">
                           <option value="">Select</option>
                           @foreach($trips as $key=>$trip)
                              <option value="{{$trip->id}}">
                                {{$trip->start_timestamp."-".$trip->fromStop->short_name."To".$trip->toStop->short_name}}
                              </option>
                           @endforeach
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>Ticket Types</td>
                   <td>
                       <select id="status" class="form-control w-50-percent">
                           <option value="1">Logged In</option>
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>
                   </td>
                   <td>
                        <button class="btn btn-success" id="viewHealthStatus">View</button>
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
                    <th>No. Adults Tkts</th>
                    <th>No. Adults Tkts</th>
                    <th>Pass Amt.</th>
                    <th>Total Amt.</th>
                  </tr>
                </thead>
                <tbody>
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
<script type="text/javascript">
  
</script>
@endpush