@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
@include('partials.form_header')
               {!! Form::model($etm_details, [
        'method' => 'PATCH',
        'route' => ['etm_details.update', $etm_details->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
         'class'=>'form-horizontal'
        ]) !!}
               @include('etm_details.form', ['submitButtonText' => Lang::get('etm_details.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
