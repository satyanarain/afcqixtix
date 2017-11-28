<!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 style="font-size:18px;">{{str_limit($associate->name, 50)}}</h3>
            </div>
            <a href="{{route('associates.show', $user->associate_id)}}" class="small-box-footer">View Associate Profile <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        {{--<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$totalUsersCount}}</h3>


              <p>@lang('dashboard.users.total_users')</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('users.index')}}" class="small-box-footer">@lang('dashboard.users.view_all') <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$totalCompaniesCount}}</h3>

              <p>@lang('dashboard.clients.total_clients')</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="{{route('clients.index')}}" class="small-box-footer">@lang('dashboard.clients.view_all') <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>0</h3>

              <p>More Info</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">@lang('dashboard.time.info') <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>--}}
        <!-- ./col -->
      </div>
      <!-- /.row -->

@include('pages.servicescount')


{{--Associate document modal--}}

  <div class="modal" id="associateDocumentModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Associate Country Master Documents</h4>
        </div>
        <div class="modal-body">
          <p> Associate country master documents are not uploaded yet, <a style="color: blue;" href="{{route('associates.adddocuments', $associate->id)}}"> Click here to upload country master documents</a></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
@push('scripts')
<script>
$(document).ready(function(){
    $.ajax({
        type:'post',
        url:'{{route('checkassociate.document')}}',
        data:{
        	associate_id:{{$associate->id}}
        },
        success:function(response){
          if(response == 'NO'){
          	$('#associateDocumentModal').modal('show'); 
          }else{
          	//alert('document uploaded');
          }
        }
    });
});
</script>
@endpush