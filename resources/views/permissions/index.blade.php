@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')

<div class="row">
    <div class="col-xs-12">
<!--<input type="checkbox" id="checkAll" onclick="checkAll(this,this.id);">Check All
<hr />
<input type="checkbox" class="checkAll">Item 1
<input type="checkbox" class="checkAll">Item 2
<input type="checkbox" class="checkAll">Item3
<input type="checkbox" class="checkAll1">Item3
<script>
    
    
function checkAll(id,cid) {
   alert(cid)
   $('.'+cid).not(id).prop('checked', id.checked);
}
</script>-->
        <div class="box">
            <div class="box-header">
            <h3 class="box-title">{{headingMain()}}</h3>
<!--                <a href="{{ route('permissions.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $value)
                        <tr>
                            <td>{{$value->name}}</td>
                            <td>{{$value->user_name}}</td>
                            <td> <button  class="btn btn-small btn-primary"  data-toggle="modal" data-target="#<?php echo $value->id ?>"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Permissions</button></td>
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
@include('partials.menuheader')
@include('partials.table_script') 
@stop