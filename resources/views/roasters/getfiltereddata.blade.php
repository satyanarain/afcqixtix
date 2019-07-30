@extends('layouts.master')
@section('header')
<h1>Roasters</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('roasters.index')}}">Filter Roaster</a></li>
    <li class="active">Roster</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">View Rosters</h3>
            </div>

          <div class="box-body"></div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%">

                    <thead>
                        <tr>
                            <th class="">S.No.</th>
                            <th>@lang('Depot Name')</th>
                            <th>@lang('Date')</th>
                            <th>@lang('Shift')</th>

                              {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roasters as $key=>$value)
                        <tr class="nor_f">
                            <td class="">{{$key+1}}</td>
                            <td>{{$value->depot_name}}</td>
                            <td>{{$value->dated_on}}</td>
                            <td>{{$value->shift}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('roasters');
                                if(in_array('edit',$permission)){?>
                                    <a href="<?php echo route('roasters.edit',$value->id)?>" title="Edit Roaster"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }else{?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }
                                if(in_array('view',$permission)){?>
                                    <a href="<?php echo route('roasters.show',$value->id)?>" title="View Roaster"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }?>

                            </td>
                           </tr>
                        @endforeach
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
@stop
@push('scripts')
<script type="text/javascript" language="javascript" >
$(document).ready(function() {
    var token = window.Laravel.csrfToken;
    //alert(token);
    //var dat = $("#filter-waybill").serialize();
    //alert(dat);



});
</script>
@endpush
