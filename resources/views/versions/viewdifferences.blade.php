@extends('layouts.master')
@section('header')
<h1>Approve Master Log</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/versions">Versions</a></li>
    <li class="active">Approve Changes</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">Approve Master Log </h3>
               <button class="btn btn-success pull-right" onclick="window.history.back();" type="button">Back</button>
            </div>
             @include('partials.message')
            <!-- /.box-header -->
            <?php $count=1;foreach($differences as $key=>$difference)
            {?>
            <div class="form-group">
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#<?=$key?>"><?=strtoupper(str_replace('_',' ',$key))?></button>
            <div id="<?=$key?>" class="collapse">
                <div class="box-body">
                <table id="examfple<?=$count?>" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>Version</th>
                            <th>Change Type</th>
                            <th>Added/Change By</th>
                            {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($difference as $value)
                        <tr class="nor_f" id="<?php echo $key.$value->id ?>">
                            <td>{{$value->version_id}}</td>
                            <td><?php if($value->flag=='a'){echo 'Added';}elseif($value->flag=='u'){echo 'Changed';}elseif($value->flag=='d'){echo 'Deleted';}?></td>
                            <td>{{getCurrentLabel('users','id',$value->user_id,'name')}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('versions');
                                if(in_array('edit',$permission) && $value->approval_status=="p"){?>
                                    <a style="cursor: pointer;" title="Approve Changes" onclick="approveChange('<?php echo $key?>',<?php echo $value->id ?>)"><span class="glyphicon glyphicon-ok"></span></a>
                                    <a style="cursor: pointer;" title="Deny Changes" data-toggle="modal" data-target="#<?php echo $value->id ?>" onclick="commentBox('<?php echo $key?>',<?php echo $value->id ?>,'<?php echo $value->version_id?>')"><span class="glyphicon glyphicon-remove"></span></a>&nbsp;&nbsp;
                                <?php }
                                if(in_array('view',$permission)){?>
                                    <a style="cursor: pointer;" title="View Changes" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails('<?php echo $key?>',<?php echo $value->id ?>,'<?php echo $value->log_tablename?>');"><span class="glyphicon glyphicon-search"></span></a>
                                <?php }?>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
            </div>
            </div>
            <?php $count++;}?>
            
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@include('partials.versionheader')
@include('partials.version_script') 
@stop