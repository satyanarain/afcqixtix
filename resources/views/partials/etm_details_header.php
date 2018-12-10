</div>
<div class="modal fade" id="view_detail" role="dialog">
 </div>
 @push('scripts')
<script>
function viewDetails(id,view_detail)
   {
   var urldata=   '/etm_details/' + view_detail + '/' +id;
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
@endpush