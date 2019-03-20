@extends('layouts.master')
@section('header')
<h1>Manage ETM</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">ETM Details</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">List of All ETM</h3>
               <?php $permission_status = checkPermission('etm_details','create');
               $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen)
                        createButton('create','Add ETM');
                    elseif($permission_status)
                        createDisableButton('create','Add ETM');
                ?>
            </div>
            <div class="box-body">
            <div class="col-xs-12">
                <div class="form-group ">
                    <div class="col-sm-3 no-padding">
                        @php $depots=displayList('depots','name');@endphp
                        {!! Form::select('depot_id', $depots,null,
                        ['id'=>'depot_id','data-column'=>0,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Depot','required' => 'required']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::select('etm_status', array('1'=>'In Use','2'=>'Not in Use'),null,
                        ['id'=>'etm_status','data-column'=>1,'class' => 'search-input-select col-md-6 form-control', 'placeholder'=>'Select Status','required' => 'required']) !!}
                    </div>
                    
                    
                </div>
            </div>
          </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table style="width: 100%;" id="etm-grid" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class=""></th>
                            <th>@lang('Depot Name')</th>
                            <th>@lang('ETM No.')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('SIM No.')</th>
                            {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                        
                    </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

<!-- /.row -->
@include('partials.etm_details_header')

@endsection

@push('scripts')
    <script type="text/javascript" language="javascript" >
$(document).ready(function() {
    var token = window.Laravel.csrfToken;
    //alert(token);
    //var dat = $("#filter-waybill").serialize();
    //alert(dat);
    var dataTable = $('#etm-grid').DataTable( {
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
               url :"{{ route('etm_details.getfiltereddata') }}", // json datasource
               //route('distribution/getdata'),
                //url :"passes/searchdata", // json datasource
                type: "POST",  // method  , by default get
                data:{'_token':token},
                error: function(){  // error handling
                        $(".employee-grid-error").html("");
                        $("#etm-grid").append('<tbody class="employee-grid-error"><tr><th colspan="6">No data found in the server</th></tr></tbody>');
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
function statusUpdate(id)
{
 $.ajax({
    type:'get',
    url:'/user/statusupdate/'+id,
   success:function(data)
    {
   
    if(data==1)
    {
    $("#"+id).removeClass('btn-danger');   
    $("#"+id).addClass('btn-success');  
    $("#ai"+id).html('Active');    
    }else{
    $("#"+id).removeClass('btn-success');   
    $("#"+id).addClass('btn-danger');    
    $("#ai"+id).html('Inactive');    
    }
    
    }
});
}
</script>
@endpush