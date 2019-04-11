<div class="modal fade" id="view_detail" role="dialog"></div>
@push('scripts')
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

function denyChange(tablename,id,version_id)
{
    var commentbox = $("#commentbox").val();
    var APP_URL = {!! json_encode(url('/')) !!}
     jQuery.ajax({
         url: "/versions/deny_change/"+id,
         type: "POST",
         data: {
             "table"    : tablename,
             "id"            : id,
             "version_id" : version_id,
             "comment" : commentbox
         },
         beforeSend: function(){
                $("#commentbox").css("background","#FFF url("+APP_URL+"/images/LoaderIcon.gif) no-repeat 165px");
        },
         headers: {
             "x-access-token": window.Laravel.csrfToken
         },
         contentType: "application/x-www-form-urlencoded",
         cache: false
     })
     .done(function(data, textStatus, jqXHR) {
        $("#view_detail").modal('show');
        $("#view_detail").html('<div class="modal-dialog">\n\
                                <div class="modal-content">\n\
                                    <div class="modal-header-view">\n\
                                        <h4 class="viewdetails_details">Write Your Comment</h4>\n\
                                    </div>\n\
                                    <div class="modal-body-view">\n\
                                        '+data+'\n\
                                    </div>\n\
                                </div>\n\
                            </div>');
        $("#" + tablename+id).fadeOut(300, function(){ $(this).remove();});
     })
     .fail(function(jqXHR, textStatus, errorThrown) {

     })   
}

function commentBox(tablename,id,version_id){
    $("#view_detail").modal('show');
    $("#view_detail").html('<div class="modal-dialog">\n\
                                <div class="modal-content">\n\
                                    <div class="modal-header-view">\n\
                                        <h4 class="viewdetails_details">Write Your Comment</h4>\n\
                                    </div>\n\
                                    <div class="modal-body-view">\n\
                                        <textarea name="comment" id="commentbox" row="15" cols="80"></textarea><br>\n\
                                        <input type="submit" class="btn btn-info" onclick="denyChange(\''+tablename+'\',\''+id+'\',\''+version_id+'\')">\n\
                                       \n\
                                    </div>\n\
                                </div>\n\
                            </div>');
}
</script>
@endpush