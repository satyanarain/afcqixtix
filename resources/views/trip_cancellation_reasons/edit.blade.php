@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
 @include('partials.form_header')
       {!! Form::model($trip_cancellation_reasons, [
        'method' => 'PATCH',
        'route' => ['trip_cancellation_reasons.update', $trip_cancellation_reasons->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
         'class'=>'form-horizontal',
         'autocomplete'=>'0ff'
        ]) !!}
               @include('trip_cancellation_reasons.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
