@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
 @include('partials.form_header')
         {!! Form::model($concession_fare_slabs, [
        'method' => 'PATCH',
        'route' => ['concession_fare_slabs.update', $concession_fare_slabs->id],
        'files'=>true,
        'class'=>'form-horizontal',
        'autocomplete'=>'0ff',
        'enctype' => 'multipart/form-data'
        ]) !!}
               @include('concession_fare_slabs.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
