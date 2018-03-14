@extends('layouts.master')
@section('header')
<h1>Role and Permission Management {{--headingBold()--}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">List of All Role and Permissions</h3>
            {{ createButton('create','Add') }}
            </div>
          @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Description</th>
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $value)
                        <tr>
                            <td>{{$value->role}}</td>
                            <td>{{$value->description}}</td>
                            
                        {{ actionEdit('edit',$value->id)}}
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