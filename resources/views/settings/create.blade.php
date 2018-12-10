@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
  @include('partials.form_header')
                {!! Form::open([
                'route' => 'settings.store',
                'files'=>true,
                'class'=>'form-horizontal',
                'enctype' => 'multipart/form-data'
                 ]) !!}
                @include('settings.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

