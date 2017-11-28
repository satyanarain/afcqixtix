<!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
              {{--$totalAssociatesCount--}}
				      </h3>

              <p>@lang('dashboard.vendors.total_vendors')</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-font resource-info-icon"></i>
            </div>
            <a href="{{--route('associates.index')--}}" class="small-box-footer">@lang('dashboard.vendors.view_all') <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{--$totalUsersCount--}}</h3>

              <p>@lang('dashboard.users.total_users')</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-user resource-info-icon"></i>
            </div>
            <a href="{{--route('users.index')--}}" class="small-box-footer">@lang('dashboard.users.view_all') <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{--$totalCompaniesCount--}}</h3>

              <p>@lang('dashboard.clients.total_clients')</p>
            </div>
            <div class="icon">
              <i class="fa fa-building-o resource-info-icon"></i>
            </div>
            <a href="{{--route('clients.index')--}}" class="small-box-footer">@lang('dashboard.clients.view_all') <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{--$notification_count--}}</h3>

              <p>Total Notifications</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Total Notifications <i class="fa fa-sms"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->