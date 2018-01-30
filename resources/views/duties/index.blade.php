@extends('layouts.master')
@section('header')
<h1>Duty Management {{--headingBold()--}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">{{headingMain()}}</h3>
            {{ createButton('create','Add') }}
            </div>
          @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Route')</th>
                            <th>@lang('Duty Number')</th>
                           <th>@lang('Start Time')</th>
                            <th>@lang('Shift')</th>
                           {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($duties as $value)
                        <tr class="nor_f">
                            <td>{{$value->route}}</td>
                            <td>{{$value->duty_number}}
                            </td>
                            <td>{{$value->start_time}}
                            </td>
                            <td>{{$value->shift}}
                            </td>
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
@include('partials.dutiesheader')
@include('partials.table_script')
@stop