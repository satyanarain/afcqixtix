@extends('layouts.master')
@section('header')
<h1>ETM Health Status Parameters</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#" class="active">Health Status Parameters</a></li>
</ol>
@stop
@section('content')
<div class="row">
  <div class="col-xs-12">
    <form action="{{url('etm/parameters')}}" method="POST">
    <div class="box">
      <div class="box-header">
        @include('partials.message')
        <table class="table">
           <tr>
             <td class="w-33-percent">Status</td>
             <td class="w-33-percent">
               <select name="color_id" id="color_id" class="form-control w-50-percent">
                <option value="">Select</option>
                @foreach($colors as $color)
                <option value="{{$color->id}}">{{$color->name}}</option>
                @endforeach
              </select>
            </td>
            <td class="w-33-percent"></td>
          </tr>
        </table>
        <h3 class="box-title">Details <span>Modified:</span></h3>
        <table class="table">
         <tr>
           <td class="w-33-percent">Battery level (%) *</td>
           <td class="w-33-percent">
              <input type="text" name="battery_percentage_min" id="battery_percentage_min" class="form-control w-50-percent" onkeypress="return numvalidate(event)">
          </td>
          <td class="w-33-percent">
              <input type="text" name="battery_percentage_max" id="battery_percentage_max" class="form-control w-50-percent" onkeypress="return numvalidate(event)">
          </td>
        </tr>
        <tr>
         <td>GPRS signal strength (1-5) *</td>
         <td>
           <input type="text" name="gprs_level_min" id="gprs_level_min" class="form-control w-50-percent" onkeypress="return numvalidate(event)">
         </td>
         <td>
           <input type="text" name="gprs_level_max" id="gprs_level_max" class="form-control w-50-percent" onkeypress="return numvalidate(event)">
         </td>
       </tr>
       <tr>
         <td>Last communicated (minutes) *</td>
         <td>
           <input type="text" name="last_communicated_min" id="last_communicated_min" class="form-control w-50-percent" onkeypress="return numvalidate(event)">
         </td>
         <td>
           <input type="text" name="last_communicated_max" id="last_communicated_max" class="form-control w-50-percent" onkeypress="return numvalidate(event)">
         </td>
       </tr>
       <tr>
         <td>Last ticket issued (minutes) *</td>
         <td>
           <input type="text" name="last_ticket_issued_min" id="last_ticket_issued_min" class="form-control w-50-percent" onkeypress="return numvalidate(event)">
         </td>
         <td>
           <input type="text" name="last_ticket_issued_max" id="last_ticket_issued_max" class="form-control w-50-percent" onkeypress="return numvalidate(event)">
         </td>
       </tr>
       <tr>
         <td>
          <button class="btn btn-success">Save</button>
          <button class="btn btn-danger">Cancel</button>
        </td>
        <td>
        </td>
      </tr>
    </table>
  </div>
</div>
</form>
</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(document).on('change', '#color_id', function(){
    var color_id = $(this).val();

    if(!color_id)
    {
      return alert('Please select a valid status');
    }
    var url = "{{route('etm.getparametersbystatus', ':id')}}";

    url = url.replace(':id', color_id);

    $.ajax({
      url: url,
      type: "GET",
      dataType: "JSON",
      success: function( response )
      {
        if(response.status == 'Ok')
        {
          var data = response.data;
          if(data)
          {
            $('#battery_percentage_min').val(data.battery_percentage_min);
            $('#battery_percentage_max').val(data.battery_percentage_max);
            $('#gprs_level_min').val(data.gprs_level_min);
            $('#gprs_level_max').val(data.gprs_level_max);
            $('#last_communicated_min').val(data.last_communicated_min);
            $('#last_communicated_max').val(data.last_communicated_max);
            $('#last_ticket_issued_min').val(data.last_ticket_issued_min);
            $('#last_ticket_issued_max').val(data.last_ticket_issued_max);
          }else{
            $('#battery_percentage_min').val('');
            $('#battery_percentage_max').val('');
            $('#gprs_level_min').val('');
            $('#gprs_level_max').val('');
            $('#last_communicated_min').val('');
            $('#last_communicated_max').val('');
            $('#last_ticket_issued_min').val('');
            $('#last_ticket_issued_max').val('');
          }
        }else{
          $('#battery_percentage_min').val('');
          $('#battery_percentage_max').val('');
          $('#gprs_level_min').val('');
          $('#gprs_level_max').val('');
          $('#last_communicated_min').val('');
          $('#last_communicated_max').val('');
          $('#last_ticket_issued_min').val('');
          $('#last_ticket_issued_max').val('');
        }
      },
      error: function( error )
      {
        console.log(error);
      }
    });
});

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