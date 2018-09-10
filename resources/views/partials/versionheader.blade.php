<div class="modal fade" id="view_detail" role="dialog">
 </div>
<script>
function viewDetails(tablename,id,logtable)
{
    var urldata=   '/versions/view_detail/' + tablename + '/' +id+'/'+logtable;

    $.ajax({
            type: "GET",
            url: urldata,
            cache: false,
            success: function(data){
               // alert(data);
             $("#view_detail").modal('show');
              $("#view_detail").html(data);
            }
    });

}
function approveChange(tablename,id)
{
     jQuery.ajax({
         url: "/versions/approve_change/"+id,
         type: "POST",
         data: {
             "table"    : tablename,
             "id"            : id,
         },
         headers: {
             "x-access-token": window.Laravel.csrfToken
         },
         contentType: "application/x-www-form-urlencoded",
         cache: false
     })
     .done(function(data, textStatus, jqXHR) {
         $("#" + tablename+id).fadeOut(300, function(){ $(this).remove();});
     })
     .fail(function(jqXHR, textStatus, errorThrown) {

     })   
}
</script>