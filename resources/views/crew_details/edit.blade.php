@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
@include('partials.form_header')
               {!! Form::model($crew_details, [
        'method' => 'PATCH',
        'route' => ['crew_details.update', $crew_details->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
         'class'=>'form-horizontal'
        ]) !!}
               @include('crew_details.form', ['submitButtonText' => Lang::get('crew_details.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
