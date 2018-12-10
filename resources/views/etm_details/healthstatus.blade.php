@extends('layouts.master')
@section('header')
<h1>ETM Health Status</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#" class="active">Health Status</a></li>
</ol>
@stop
@section('content')
<div class="row" id="app">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
            <h3 class="box-title">ETM Health Status Details</h3>
        
           <table class="table">
               <tr>
                   <td>Depot*</td>
                   <td>
                       <select id="depot_id" class="form-control w-50-percent">
                            <option>All</option>
                            @foreach($depots as $depot)
                                <option value="{{$depot->id}}">{{$depot->name}}</option>
                            @endforeach
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>ETM No.</td>
                   <td>
                       <input type="text" id="etm_no" class="form-control w-50-percent" onkeypress="return numvalidate(event)">
                   </td>
               </tr>
               <tr>
                   <td>Status</td>
                   <td>
                       <select id="status" class="form-control w-50-percent">
                           <option value="1">Logged In</option>
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>
                        <a href="{{url('etm/parameters')}}" target="_blank" class="btn btn-primary">Parameters</a>
                   </td>
                   <td>
                        <button class="btn btn-success" id="viewHealthStatus">View</button>
                   </td>
               </tr>
           </table>
            <!-- /.box-header -->
            <div class="box-body">
                <leaderboard></leaderboard>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
</div>
@stop

@push('healthstatusscripts')
<script src="{{ asset(elixir('js/app.js')) }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click', '#viewHealthStatus', function(){
        var depot_id = $('#depot_id').val();
        if(!depot_id)
        {
            return alert('Please select a valid depot!');
        }

        var etm_no = $('#etm_no').val();
        if(!etm_no)
        {
            etm_no = 0;
        }

        var loginlogout = $('#status').val();

        getUpdatedStatus(depot_id, etm_no, loginlogout);
        
    });

    $(document).on('change', '#depot_id', function(){
        var depot_id = $('#depot_id').val();
        if(!depot_id)
        {
            return alert('Please select a valid depot!');
        }

        var etm_no = $('#etm_no').val();
        if(!etm_no)
        {
            etm_no = 0;
        }

        var loginlogout = $('#status').val();

        getUpdatedStatus(depot_id, etm_no, loginlogout);
        
    });

    $(document).on('blur', '#etm_no', function(){
        var depot_id = $('#depot_id').val();
        if(!depot_id)
        {
            return alert('Please select a valid depot!');
        }

        var etm_no = $('#etm_no').val();
        if(!etm_no)
        {
            etm_no = 0;
        }

        var loginlogout = $('#status').val();

        getUpdatedStatus(depot_id, etm_no, loginlogout);
        
    });
});

function getUpdatedStatus(depotId, etmNo, status=1)
{
      var url = "{{route('getetmhealthstatusdata', ['depot_id', 'etm_no', 'loginlogout'])}}";

        var mapObj = {
           depot_id: depotId,
           etm_no: etmNo,
           loginlogout: status
        };
        url = url.replace(/depot_id|etm_no|loginlogout/gi, function(matched){
          return mapObj[matched];
        });

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(response)
            {
                console.log(response);
            },
            error: function(error)
            {
                console.log(error);
            }
        });
}
function numvalidate(e) 
{
    var key;
    var keychar;
    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;
    keychar = String.fromCharCode(key);
    keychar = keychar.toLowerCase();
    // control keys
    if ((key == null) || (key == 0) || (key == 8) || (key == 9)
    || (key == 13) || (key == 27))
        return true;
    else if (!(("1234567890").indexOf(keychar) > -1)) {
        return false;
    }
}
</script>
@endpush

