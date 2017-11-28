<!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
              {{$totalAssociatesCount}}
				      </h3>

              <p>@lang('dashboard.vendors.total_vendors')</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-book-outline"></i>
            </div>
            <a href="{{route('associates.index')}}" class="small-box-footer">@lang('dashboard.vendors.view_all') <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
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
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

<!-- Info boxes -->
<div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-stats-bars"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Trademarks</span>
            <h1 class="info-box-number">{{$totalTrademarksCount}}</h1>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="ion ion-stats-bars"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Patents</span>
            <h1 class="info-box-number">0</h1>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="ion ion-stats-bars"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Geographical Indications</span>
            <h1 class="info-box-number">{{ $totalGeographicalIndicationCount }}</h1>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="ion ion-stats-bars"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Domain Names</span>
            <h1 class="info-box-number">0</h1>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
     
</div>

<div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-stats-bars"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Custom Recordals</span>
            <h1 class="info-box-number">0</h1>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="ion ion-stats-bars"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Copyrights</span>
            <h1 class="info-box-number">0</h1>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="ion ion-stats-bars"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Industrial Designs</span>
            <h1 class="info-box-number">0</h1>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
</div>

<!-- end row-->

<!-- Calendar -->
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
          @include('calendar.calendar')
    </div><!-- end .col -->
</div><!-- end row-->
  