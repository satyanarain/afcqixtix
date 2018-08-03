@foreach($denominations as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-bus"></span>&nbsp;Bus Type</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Denomination Type</b></td>
                        <td class="table_normal">{{ $value->denomination_master_id }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Description</b></td>
                        <td class="table_normal">{{ $value->description }}</td>
                    </tr>
                    <tr>
                        <td><b>Price</b></td>
                        <td class="table_normal">{{ $value->price }}</td>
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
<script>
function viewDetails(id,view_detail)
   {
   var urldata=   '/denominations/' + view_detail + '/' +id;
    $.ajax({
		type: "GET",
		url: urldata,
		cache: false,
		success: function(data){
                  $("#" + view_detail).modal('show');
                  $("#"+view_detail).html(data);
		}
	});
  }
</script>