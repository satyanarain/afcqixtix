@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">{{headingMain()}}</h3>
               <?php $permission_status = checkPermission('etm_details','create');
                    if($permission_status)
                        createButton('create','Add');
                    elseif($permission_status)
                        createDisableButton('create','Add');
                ?>
            </div>
          <div class="box-body">
            <div class="col-xs-12">
                <div class="form-group ">
                    <div class="col-sm-3">
                        @php $depots=displayList('depots','name');@endphp
                        {!! Form::select('depot_id', $depots,null,
                        ['id'=>'depot_id','data-column'=>0,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Depot','required' => 'required','onchange'=>'fillDropdown("vehicle_id","vehicles","vehicle_registration_number","depot_id")']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::select('vehicle_id', null,null,
                        ['id'=>'vehicle_id','data-column'=>1,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Vehicle','required' => 'required']) !!}
                    </div>
                    <div class="col-sm-3">
                        @php $routes=displayList('route_master','route_name');@endphp
                       {!! Form::select('route_id', $routes,isset($waybills->route_id) ? $waybills->route_id : selected,
                        ['id'=>'route_id','data-column'=>2,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Route','required' => 'required','onchange'=>'fillDropdown("duty_id","duties","duty_number","route_id")']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::select('duty_id', null,null,
                        ['id'=>'duty_id','data-column'=>3,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Duty','required' => 'required']) !!}
                    </div>
                </div>
            </div>
          </div>
          <div class="box-body">
            <div class="col-xs-12">
                <div class="form-group ">
                    <div class="col-sm-3">
                        @php $routes=displayList('bus_types','bus_type');@endphp
                       {!! Form::select('bus_type_id', $routes,isset($waybills->route_id) ? $waybills->route_id : selected,
                        ['id'=>'bus_type_id','data-column'=>4,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Bus Type','required' => 'required','onchange'=>'fillDropdown("service_id","services","name","bus_type_id")']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::select('service_id', null,null,
                        ['id'=>'service_id','data-column'=>5,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Service','required' => 'required']) !!}
                    </div>
                    <div class="col-sm-3">
                        @php $shifts=displayList('shifts','shift');@endphp
                       {!! Form::select('shift_id', $shifts,null,
                        ['id'=>'shift_id','data-column'=>6,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Shift','required' => 'required']) !!}
                    </div>
                </div> 
<!--                  <input data-column="2" type="text" name="name" class="search-input-text">-->
            </div>
          </div>
          <div class="box-body"></div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="waybill-grid" class="table table-bordered table-striped" style="width: 100%">
<!--                    <thead>
        <tr>
            <th>Employee name</th>
            <th>Salary</th>
            <th>Age</th>
        </tr>
    </thead>
    <thead>
        <tr>
            <td><input type="text" data-column="0"  class="search-input-text"></td>
            <th><input type="text" data-column="1"  class="search-input-text"></td>
            <td>
                <select data-column="2"  class="search-input-select">
                    <option value="">(Select a range)</option>
                    <option value="19-30">19 - 30</option>
                    <option value="31-66">31 - 66</option>
                </select>
            </td>
        </tr>
    </thead>-->
                    <thead>
                        <tr>
                            <th class=""></th>
                            <th>@lang('Depot Name')</th>
                            <th>@lang('Date')</th>
                            <th>@lang('Shift')</th>
                            <th>@lang('Route Name')</th>
                            <th>@lang('Status')</th>
                              {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        
                        </tbody>
                    </table>
                
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
<div class="modal fade" id="view_detail" role="dialog"></div>
<script type="text/javascript" language="javascript" >
$(document).ready(function() {
    var token = window.Laravel.csrfToken;
    //alert(token);
    //var dat = $("#filter-waybill").serialize();
    //alert(dat);
    var dataTable = $('#waybill-grid').DataTable( {
                buttons: [
            'pageLength',
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                     columns: ':visible'
                }
            },
                  {
            extend: 'colvis',
            columns: ':gt(0)'
        }

        ],
       // "pageLength": 1000,
         "order": [[ 0, "desc" ]],
         "aoColumnDefs": [
        {
        'bSortable' : false,
        'aTargets' : [ 'action', 'text-holder' ]
    } ] ,
        oLanguage: {
        //sProcessing: "<img  src='../dist/img/gvtc_loader.gif' style='z-index:9999 !important; position: absolute;'>"
        },
        processing : true, 
        "scrollX": true,
        "destroy":true,
        "serverSide": true,
        //"lengthMenu": [[50, 100, 500, 1000, -1], [50, 100, 500, 1000, "All"]],
        dom: 'lBfrtip',        
        "ajax":{
               // url :"/data.php", // json datasource
               url :"{{ route('waybills/getfiltereddata') }}", // json datasource
               //route('distribution/getdata'),
                //url :"passes/searchdata", // json datasource
                type: "POST",  // method  , by default get
                data:{'_token':token},
                error: function(){  // error handling
                        $(".employee-grid-error").html("");
                        $("#waybill-grid").append('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                        $("#employee-grid_processing").css("display","none");

                }
        }
} ).clear();


    $('.search-input-text').on( 'keyup click', function () {   // for text boxes
    var i =$(this).attr('data-column');  // getting column index
    var v =$(this).val();  // getting search input value
    dataTable.columns(i).search(v).draw();
    } );
    $('.search-input-select').on( 'change', function () {   // for select box
        var i =$(this).attr('data-column');
        var v =$(this).val();
        dataTable.columns(i).search(v).draw();
    } );
} );
</script>
<script>
function viewDetails(id,view_detail)
   {
   var urldata=   '/waybills/' + view_detail + '/' +id;
    $.ajax({
		type: "GET",
		url: urldata,
		cache: false,
		success: function(data){
                  $("#" + view_detail).modal('show');
                  $("#"+view_detail).html(data);
		}
	});
  
   }
   
</script>
@include('partials.table_script')

@stop