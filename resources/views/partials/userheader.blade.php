<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary" style="min-width:10%;">
              <div class="box-body box-profile" style="padding:8px 0 1px 1px;">
                  <div>
                      @include('partials.include')
                      <input type="hidden" id="user_id" value="{{ $value->id }}">
                      <table width=90% class="table table-responsive">
                          <tr>
                              <td>Name</td>
                              <td class="table_normal">{{ $value->name }}</td>
                          </tr>
                           <tr>
                              <td>User Name</td>
                              <td class="table_normal">{{ $value->user_name }}</td>
                          </tr>
                          <tr>
                             <tr>
                              <td>Email</td>
                              <td class="table_normal">{{ $value->email }}</td>
                          </tr>
                          </tr>
                      </table>


                      </ul>
                  </div>
                  <!-- /.box-body -->
                </div>
              <!-- /.box -->

          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
     
              	<li class="active"><a href="#travel_detail" data-toggle="tab">User Details</a></li>
              	
            </ul>
            <div class="tab-content" >
	   <table width=90% class="table table-responsive" style="border-top:none;">
                          <tr style="border-top:none; margin-top:-5px;">
                              <td style="border-top:none;">Address</td>
                              <td class="table_normal" style="border-top:none;">{{ displayView($value->address) }}</td>
                          </tr>
                           <tr>
                              <td>Country</td>
                              <td class="table_normal">
                                {{  
                                  displayIdBaseName('countries', $value->country, 'country_name')
                               }}
                              </td>
                          </tr>
                          <tr>
                             <tr>
                              <td>City</td>
                              <td class="table_normal">{{ displayView($value->city) }}</td>
                          </tr>
                          <tr>
                             <tr>
                              <td>Mobile</td>
                              <td class="table_normal">{{ displayView($value->mobile) }}</td>
                          </tr>
                          <tr>
                             <tr>
                              <td>Date Of Borth</td>
                              <td class="table_normal">{{ dateView($value->date_of_birth) }}</td>
                          </tr>
                         <tr>
                              <td>Role</td>
                              <td class="table_normal">{{ dateView($value->role) }}</td>
                          </tr>
                              @include('partials.userhistory')
                          
                        </table>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>