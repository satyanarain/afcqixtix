@foreach($routes as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view">
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
               <h4 class="viewdetails_details"><span class="fa fa-map-marker"></span>&nbsp;{{ PopUpheadingMain($result) }}</h4>
            </div>
            <div class="modal-body-view">
                <table class="table table-responsive.view">
                    <tr>
                        <td><b>Path</b></td>
                        <td class="table_normal">{{ $value->path }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Direction</b></td>
                        <td class="table_normal">    @if($value->direction==1)
                        {{ "Up" }}
                        @else
                        {{ "Down" }}
                        @endif</span></td>
                    </tr>
                    <tr>
                        <td><b>Default Path</b></td>
                        <td class="table_normal">{{ $value->default_path }}</td>
                    </tr>
                    <tr>
                        <td><b>Stage Number</b></td>
                        <td class="table_normal">{{ $value->stage_number }}</td>
                    </tr>
                    <tr>
                        <td><b>Stage Number</b></td>
                        <td class="table_normal">{{ $value->stage_number }}</td>
                    </tr>
                    <tr>
                        <td><b>Distance</b></td>
                        <td class="table_normal">{{ $value->distance }}</td>
                    </tr>
                    <tr>
                        <td><b>Hot key</b></td>
                        <td class="table_normal">{{ $value->hot_key }}</td>
                    </tr>
                    <tr>
                        <td><b>Is this via stop of the path?</b></td>
                        <td class="table_normal">
                         @if($value->is_this_by==1)
                        {{ "Yes" }}
                        @else
                        {{ "No" }}
                        @endif
                        
                        </td>
                    </tr>
                </table>  

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endforeach

