@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
@include('partials.form_header')
               {!! Form::model($waybills, [
        'method' => 'PATCH',
        'route' => ['waybills.update', $waybills->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
         'class'=>'form-horizontal'
        ]) !!}
               @include('waybills.editform', ['submitButtonText' => Lang::get('ETM_details.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
