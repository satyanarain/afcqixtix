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
               <?php $permission_status = checkPermission('bus_types','create');
                     $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen)
                        createButton('create','Add','order','order_id');
                    elseif($permission_status)
                        createDisableButton('create','Add');?>
             </div>
            @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                             <th>@lang('Order Number')</th>
                            <th>@lang('Bus Type')</th>
                            
                            <th>@lang('Abbreviation')</th>
                            
                           {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bustypes as $value)
                        <tr class="nor_f">
                            <td>{{$value->order_number}}
                            </td>
                            <td>{{$value->bus_type}}</td>
                             
                            <td>{{$value->abbreviation}}
                            </td>
                            <td>
                                <?php $permission = getAllModulePermission('bus_types');
                                if(in_array('edit',$permission) && $checkVersionOpen){
                                    echo '<a  href="'.route("bus_types.edit",$value->id).'" class="" title="Edit" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                                }elseif(in_array('edit',$permission)){?>
                                        <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission))
                                    echo '<a style="cursor: pointer;" title="View" data-toggle="modal" data-target="#'.$value->id.'"  onclick="viewDetails('.$value->id.',\'view_detail\')"><span class="glyphicon glyphicon-search"></span></a>';
                                ?>
                                <?php $permission = getAllModulePermission('services');
                                if(in_array('view',$permission)){?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo route('bus_types.services.index',$value->id)?>" title="Manage Services" class="" ><span class="fa fa-briefcase"></span></a>
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
 </div>

<!-- /.row -->

@include('partials.bustypes_order_header')
@include('partials.table_script_order')
@stop