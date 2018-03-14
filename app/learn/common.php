<div id="b" style="position:absolute; top:50px"><i class="fa fa-bus" style="font-size:48px;color:red"></i></div>-->
<script type="text/javascript">
$(document).ready(function() {
    
    function beeLeft() {
        $("#b").animate({left: "-=300"}, 1500, "swing", beeRight);
    }
    function beeRight() {
        $("#b").animate({left: "+=300"}, 1500, "swing", beeLeft);
    }
    
    beeRight();
    
});

 $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password'=>'required'
        ]);
     $user = new User;
     $user->name=$request->get('name');
     $user->email=$request->get('email');
     $user->password=$request->get('password');
    $user->verification_token = md5(uniqid('KP'));
    $user->save();
    $activation_link = route('user.activate', ['email' => $user->email, 'verification_token' => urlencode($user->verification_token)]);
    Mail::send('users.email.welcome', ['name' => $user->name, 'activation_link' => $activation_link], function ($message) use($user,$activation_link)
       {
          $message->to($user->email, $user->name)->subject('Welcome to Expertphp.in!');    
        });
        
        
        
$g_allow_signup = ON; //allows the users to sign up for a new account
$g_enable_email_notification = ON; //enables the email messages
$g_phpMailer_method = PHPMAILER_METHOD_MAIL;
$g_smtp_host = 'mail.opiant.online';
$g_smtp_username = 'info@opiant.online'; //replace it with your gmail address
$g_smtp_password = 'Password@123'; //replace it with your gmail password
$g_webmaster_email      = 'info@opiant.online';
$g_from_email           = 'info@opiant.online';
# $g_email_receive_own	= OFF;
# $g_email_send_using_cronjob = OFF;
 'trip_cancellation_reason_category_master_id' => 'required|unique:trip_cancellation_reasons,trip_cancellation_reason_category_master_id'
 
 <div class="form-group ">
    {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-5 required">
        @php $depots=displayList('depots','name');@endphp
       <span id="denomination_masters"> {!! Form::select('depot_id', $depots,isset($crew_details->depot_id) ? $crew_details->depot_id : selected,
        ['class' => 'col-md-6 form-control', 'placeholder'=>'Select Depot','required' => 'required']) !!}</span>
    </div>
    <div class="col-md-1 col-sm-1 text-left">
        <div class="btn btn-sm btn-default" onclick="AddNewShow('depots', 'denomination_master_id', 'Select Denomination Type')">New</div> 
    </div>
</div>
<div class="col-md-1 col-sm-1 text-left">
<a href="https://demo.snipeitapp.com/modals/model" data-toggle="modal" data-target="#createModal" data-select="model_select_id" class="btn btn-sm btn-default">New</a>
<span class="mac_spinner" style="padding-left: 10px; color: green; display:none; width: 30px;"><i class="fa fa-spinner fa-spin"></i> </span>
</div>
$name = $request->name;
      $sql=Depot::where([['name',$name],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Name has already been taken.']);
      } else {
          
      }
    
         'class'=>'form-horizontal',
         'autocomplete'=>'0ff',
      @include('partials.form_header')
      
      
      
<div class="form-group">
        {!! Form::label('name', Lang::get('Depot Name'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('name', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>



<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required')) }}
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div> 

use App\Traits\activityLog;
<?php $this->userHistory($value->user_name,$value->created_at,$value->updated_at) ; ?>
       public function update($id, UpdateDutyRequest $request) {
      $duties = Duty::findOrFail($id);
      $route = $request->route_id;
      $duty_number = $request->duty_number;
      $sql=Duty::where([['route_id',$request->route_id],['duty_number',$request->duty_number],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
      return redirect('duties/'.$id.'/edit')->withErrors(['This route and duty number has already been taken.']);
      } else {
        $this->duties->update($id, $request);
        return redirect()->route('duties.index');
      }
    }
    
    <script>
        $(document).ready(function() {
	  $('#example').DataTable( {
            "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[1,'asc']],
      "info": true,
      "autoWidth": false,  
         dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: false
        } ]
    } );
} );

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'
        ]
    } );
} );

$(document).ready(function() {

    var table= $('#example1').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'desc']],
      "info": true,
      "autoWidth": false,
    "colVis": [{
            exclude: [ 0 ]
        }],
  dom: 'Bfrtip',
    lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            'pageLength'
        ]
    } );

    
} );

</script>

<script type="text/javascript" src="jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
 
<script type="text/javascript">
    $(document).ready(function() {
        $('#FlagsExport').DataTable({
            "pageLength": 50,
            dom: 'Bfrtip',
            buttons: ['copy','csv','excel','pdf','print']
        });
    });
</script>