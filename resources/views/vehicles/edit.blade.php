@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
 @include('partials.form_header')
               {!! Form::model($vehicles, [
        'method' => 'PATCH',
        'route' => ['vehicles.update', $vehicles->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
        'class'=>'form-horizontal'
        ]) !!}
               @include('vehicles.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
