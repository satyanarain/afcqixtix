@foreach($depots as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view">
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
               <h4 class="viewdetails_details"><span class="fa fa-bus"></span>&nbsp;{{ PopUpheadingMain($result) }}</h4>
            </div>
            <div class="modal-body-view">
                <table class="table table-responsive.view">
                    <tr>
                        <td><b>Depot Name</b></td>
                        <td class="table_normal">{{ $value->name }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Depot ID</b></td>
                        <td class="table_normal">{{ $value->depot_id }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Short Name</b></td>
                        <td class="table_normal">{{ $value->short_name }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Depot Location</b></td>
                        <td class="table_normal">{{ $value->depot_location }}</td>
                    </tr>
                    <tr>
                        <td><b>Default Service</b></td>
                        <td class="table_normal">{{ $value->default_service }}</td>
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
<!--<div class="modal fade" id="view_detail" role="dialog">
 </div>-->
<script>
//  function orderList(order_id,order_list)
//   {
//       
//     alert("7878");
//   var urldata=   '/depots/' + order_list;
//    
//    $.ajax({
//		type: "GET",
//		url: urldata,
//		cache: false,
//		success: function(data){
//                  $("#" + order_id).modal('show');
//                  $("#"+order_list).html(data);
//		}
//	});
//  
//   }

</script>