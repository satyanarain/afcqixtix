<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary" style="min-width:10%;">
            <div class="box-body box-profile" style="padding:8px 0 1px 1px;">
            @include('partials.include')
              <input type="hidden" id="user_id" value="{{ $routes->id }}">
              <h3 class="profile-username text-center cursor-pointer" id="user_name">
                  <span id="user-name-span">{{ $routes->route }}</span> 
<!--                  <span id="edit-user-name" class="glyphicon glyphicon-pencil"></span>-->
              </h3>


              <p class="text-muted text-center"></p>
              <table width=90% class="table table-responsive">
                <tr>
                    <td style="text-align:left;padding-left:10%;padding-top:3%;"><b>Path</b></td>
                    <td style="text-align:left;padding-left:15%;padding-top:3%; ">{{ $routes->path }}</td>
                  </tr>
                    <tr>
                    <td style="text-align:left;padding-left:10%;padding-top:3%;"><b>Direction</b></td>
                    <td style="text-align:left;padding-left:15%;padding-top:3%; ">
                        @if($routes->direction==1)
                        {{ "Up" }}
                        @else
                        {{ "Down" }}
                        @endif
                    </td>
                  </tr>
                   <tr>
                    <td style="text-align:left;padding-left:10%;padding-top:3%;"><b>Default Path</b></td>
                    <td style="text-align:left;padding-left:15%;padding-top:3%; "><span></span>{{ $routes->default_path }}</span></td>
                   </tr>
                  <tr>
                    <td style="text-align:left;padding-left:10%;padding-top:3%;"><b>Stage Number</b></td>
                    <td style="text-align:left;padding-left:15%;padding-top:3%; "><span></span>{{ $routes->stage_number }}</span></td>
                   </tr>
                   <tr>
                    <td style="text-align:left;padding-left:10%;padding-top:3%;"><b>Distance</b></td>
                    <td style="text-align:left;padding-left:15%;padding-top:3%; "><span></span>{{ $routes->distance }}</span></td>
                   </tr>
                   <tr>
                    <td style="text-align:left;padding-left:10%;padding-top:3%;"><b>Hot Key</b></td>
                    <td style="text-align:left;padding-left:15%;padding-top:3%; "><span></span>{{ $routes->hot_key }}</span></td>
                   </tr>
                   <tr>
                    <td style="text-align:left;padding-left:10%;padding-top:3%;"><b>Is this via stop of the path? </b></td>
                    <td style="text-align:left;padding-left:15%;padding-top:3%; "><span></span> 
                         @if($routes->is_this_by==1)
                        {{ "Yes" }}
                        @else
                        {{ "No" }}
                        @endif
                        
                       </span></td>
                   </tr>
                  </table>
           
                
              </ul>

            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            
            @if($routes->user_type == 1 || $routes->user_type == 4 || $routes->user_type == 9)
              	<li class="active"><a href="#travel_detail" data-toggle="tab">Travel Profile</a></li>
              	<li><a href="#bank_detail" data-toggle="tab">Bank Details</a></li>
            @endif
            {{--@if(Entrust::hasRole('administrator'))
            	<li class="active"><a href="#travel_detail" data-toggle="tab">Travel Profile</a></li>
              	<li><a href="#bank_detail" data-toggle="tab">Bank Details</a></li>
            @endif
            @if(Entrust::hasRole('associate_user'))
              	<!-- <li class="active"><a href="#travel_detail" data-toggle="tab">Travel Profile</a></li> -->
              	<!-- <li><a href="#bank_detail" data-toggle="tab">Bank Details</a></li> -->
            @endif
            @if(Entrust::hasRole('client_user'))
              	<!-- <li class="active"><a href="#travel_detail" data-toggle="tab">Travel Profile</a></li>
              	<li><a href="#bank_detail" data-toggle="tab">Bank Details</a></li> -->
            @endif
            
            @if(Entrust::hasRole('kipg_general_user'))
              	<li class="active"><a href="#travel_detail" data-toggle="tab">Travel Profile</a></li>
              	<li><a href="#bank_detail" data-toggle="tab">Bank Details</a></li>
            @endif--}}
            
            </ul>
            <div class="tab-content">
	        	@if($routes->user_type == 1 || $routes->user_type == 4 || $routes->user_type == 9)
		        	   <div class="active tab-pane" id="travel_detail">
	                  	@include('users.travel')    
	              	</div>
	              	<div class="tab-pane" id="bank_detail">
	                  	@include('users.bank_detail')
	                </div>
            @endif
            {{--@if(Entrust::hasRole('kipg_general_user'))
              	<div class="active tab-pane" id="travel_detail">
                  	@include('users.travel')    
              	</div>
              	<div class="tab-pane" id="bank_detail">
                		@include('users.bank_detail')
              	</div>
            @endif--}}
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>