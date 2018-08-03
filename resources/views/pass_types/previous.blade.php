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
             {{-- createButton('create','Add') --}}
            </div>
<!--           @include('partials.message')-->
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Service Name')</th>
                            <th>@lang('Stage')</th>
                           <th>@lang('Adult Ticket Amount')</th>
                            <th>@lang('Child Ticket Amount')</th>
                            <th>@lang('Luggage Ticket Amount')</th>
                            <th>@lang('Created Date')</th>
                            <th>@lang('Updated Date')</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($pass_types as $value)
                        <tr class="nor_f">
                            <td>{{$value->name}}</td>
                            <td>{{$value->stage}}</td>
                            <td>{{$value->adult_ticket_amount}}
                            </td>
                            <td>{{$value->child_ticket_amount}}
                            </td>
                            <td>{{$value->luggage_ticket_amount}}
                            </td>
                            <td>{{dateView($value->created_at)}}
                            </td>
                            <td>{{dateView($value->updated_at)}}
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

@include('partials.pass_typesheader')
@include('partials.table_script')
@stop