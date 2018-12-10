<div class="modal fade" id="view_detail" role="dialog">
 </div>
 @push('scripts')
<script>
    
    function viewDetails(id,view_detail)
   {
   var urldata=   '/settings/' + view_detail + '/' +id;
    
    $.ajax({
		type: "GET",
		url: urldata,
		cache: false,
		success: function(data){
                   // alert(data);
                 $("#" + view_detail).modal('show');
                  $("#"+view_detail).html(data);
		}
	});
  
   }
   </script>
@endpush