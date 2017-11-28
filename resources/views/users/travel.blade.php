<div class="col-lg-12 currenttask">
{{--<div class="well well-sm" style="margin-top:2%;">
    <h1  style="display: inline-block;margin:0px">Travel Details</h1>
    <a href="{{ route('users.createtravelprofile', $user->id)}}"><button class="kiperda-add pull-right-button">
        <span class="glyphicon glyphicon-plus"></span> </button>
    </a>
</div>--}}


<div class="well well-sm" style="margin-top:2%">
    <h1 style="display: inline-block;margin:0px;">Travel Details</h1> 
    <a href="{{ route('users.createtravelprofile', $user->id)}}" class="kiperda-add pull-right-button">
        <span class="glyphicon glyphicon-plus"></span>@lang('user.travel.headers.add_travel')
    </a>
    <a style="margin-right: 8px;" href="{{route('users.printtraveldetails', $user->id)}}" class="btn kiperda-add pull-right-button print_travel_details"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
</div>


    <table  class="table table-striped table-bordered nowrap" width="100%" cellspacing="0" id="travel_detail_table">
        <thead>
          <tr>
              <th>@lang('user.travel.headers.country')</th>
              <th>@lang('user.travel.visa_number')</th>
              <th>@lang('user.travel.passport_expires_on')</th>
              <th>@lang('user.travel.passport_number')</th>
              <th>Travel From Date</th>
              <th>Travel To Date</th>
              <th>Edit</th>
              <th>View</th>
              @if(Entrust::hasRole('group_admin'))
                <th>Delete</th>
              @endif
          </tr>
        </thead>
        <tbody>

            @foreach($travels as $travel)
            <tr>
                <td>{{$travel->country_name}}</td>
                <td>{{$travel->visa_number}}</td>
                <td>{{$travel->passport_expires_on}}</td>
                <td>{{$travel->passport_number}}</td>
                <td>{{$travel->travel_from_date}}</td>
                <td>{{$travel->travel_to_date}}</td>
                <td><a href="{{route('users.edittravelprofile', $travel->id)}}" class="kiperda-edit"><span class="glyphicon glyphicon-pencil"></span> Edit</a></td>
                <td><a href="{{route('users.showtravelprofile', ['user_id'=>$user->id, 'travel_id'=>$travel->id])}}" class="kiperda-view"><span class="glyphicon glyphicon-search"></span> View</a></td>
                @if(Entrust::hasRole('group_admin'))
                  <td><a href="{{route('users.deletetravelprofile', ['user_id'=>$user->id, 'travel_id'=>$travel->id])}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>
                @endif
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
      
@push('scripts')
<script>
$(function() {
    var table = $('#travel_detail_table').DataTable({
        responsive: true,
});
new $.fn.dataTable.FixedHeader( table );
});

</script>
@endpush   