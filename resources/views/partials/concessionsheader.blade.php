@foreach($concessions as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>
                <h4 class="viewdetails_details"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{ PopUpheadingMain($result) }}</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Service</b></td>
                        <td class="table_normal">{{ $value->name}}</span></td>
                    </tr>
                    <tr>
                        <td><b>Percentage</b></td>
                       <td class="table_normal">{{ $value->percentage}}</td>
                    </tr>
                    <tr>
                        <td><b>From Stage</b></td>
                        <td class="table_normal">{{ $value->stage_from}}</td>
                    </tr>
                    <tr>
                        <td><b>To Stage</b></td>
                        <td class="table_normal">{{ $value->stage_to}}</td>
                    </tr>
                    <tr>
                        <td><b>Fare</b></td>
                        <td class="table_normal">{{ $value->fare }}</td>
                    </tr>
                    @include('partials.userhistory')
                     </table>  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endforeach
  
                    