<!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           
          <div class="small-box bg-aqua">
              <a href="{{route('clientdocuments.show', $user->client_id)}}" class="small-box-footer">
            <div class="inner">
              <h3 style="font-size:18px;">{{str_limit($client->client_name, 50)}}</h3>
            </div>
           View Client Profile <i class="fa fa-arrow-circle-right"></i>
            </a>  
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
        <a href="{{route('clients.index')}}" class="small-box-footer">
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
            @lang('dashboard.clients.view_all') <i class="fa fa-arrow-circle-right"></i>
          </div>
        </div>
        </a>
        
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