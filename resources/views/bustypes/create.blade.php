@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
 @include('partials.form_header')
                {!! Form::open([
                'route' => 'bus_types.store',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                 'class'=>'form-horizontal'
                ]) !!}
                @include('bustypes.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@stop

