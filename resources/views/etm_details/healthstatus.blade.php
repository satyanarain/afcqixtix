@extends('layouts.master')
@section('header')
<h1>ETM Health Status</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#" class="active">Health Status</a></li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
            <h3 class="box-title">ETM Health Status Details</h3>
        
           <table class="table">
               <tr>
                   <td>Depot*</td>
                   <td>
                       <select class="form-control w-50-percent">
                            <option>Please select a depot</option>
                            @foreach($depots as $depot)
                                <option value="{{$depot->id}}">{{$depot->name}}</option>
                            @endforeach
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>ETM No.</td>
                   <td>
                       <input type="text" name="etm_no" class="form-control w-50-percent">
                   </td>
               </tr>
               <tr>
                   <td>Status</td>
                   <td>
                       <select class="form-control w-50-percent">
                           <option>Logged In</option>
                           <option>Logged Out</option>
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>
                        <button class="btn btn-primary">Parameters</button>
                   </td>
                   <td>
                        <button class="btn btn-success">View</button>
                   </td>
               </tr>
           </table>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <td>ETM No. / Abstract</td>
                            <td>Conductor (ID) / Driver (ID)</td>
                            <td>Login At / Logout At</td>
                            <td>Mobile No.</td>
                            <td>Route-Duty-Shift</td>
                            <td>Bus No.</td>
                            <th>Last Ticket Issued</th>
                            <td>Last Communicated</td>
                            <td>GPRS Level</td>
                            <th>Battery % </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statusData as $value)
                        <tr class="nor_f">
                            <td>{{$value->etm_no." / ".$value->abstract_no}}</td>
                            <td>{{$value->conductor_name." (".$value->conductor_id.") / ".$value->driver_name." (".$value->driver_name.")"}}</td>
                            <td>{{$value->login_timestamp." / ".$value->logout_timestamp}}</td>
                            <td>
                                {{$value->mobile}}
                            </td>
                            <td>
                                {{$value->route."-".$value->duty_number."-".$value->shift}}
                            </td>
                            <td>{{$value->vehicle_registration_number}}
                            </td>
                            <td>
                                {{$value->last_ticket_issued}}
                            </td>
                            <td>{{$value->last_communicated}}</td>
                            <td>
                                {{$value->gprs_level}}
                            </td>
                            <td>
                                {{$value->battery_percentage}}
                            </td>
                         </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
</div>

@include('partials.table_script_order')
@stop