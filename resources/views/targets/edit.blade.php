@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
 @include('partials.form_header')
               {!! Form::model($targets, [
        'method' => 'PATCH',
        'route' => ['routes.duties.targets.update',$route_id,$duty_id,$targets->id],
        'files'=>true,
         'class'=>'form-horizontal',
        'enctype' => 'multipart/form-data'
        ]) !!}
               @include('targets.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
