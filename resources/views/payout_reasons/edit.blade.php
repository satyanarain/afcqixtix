@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
  @include('partials.form_header')
      {!! Form::model($payout_reasons, [
        'method' => 'PATCH',
        'route' => ['payout_reasons.update', $payout_reasons->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
        'class'=>'form-horizontal',
        'autocomplete'=>'0ff'
        ]) !!}
               @include('payout_reasons.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
