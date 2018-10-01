@if(Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@elseif(Session::has('fail'))
<div class="alert alert-danger">{{Session::get('fail')}}</div>
@endif

<div class="form-group">
        {!! Form::label('name', Lang::get('user.headers.name'), ['class' => 'control-label']) !!}
        {!! Form::text('name', $user->name, ['class' => 'form-control','required' => 'required','readonly'=>'readonly','style'=>'border:none;']) !!}
    </div>

<div class="form-group">
    {!! Form::label('email', Lang::get('user.headers.userid'), ['class' => 'control-label']) !!}
    {!! Form::text('email', $user->email, ['class' => 'form-control','readonly'=>'readonly','style'=>'border:none;']) !!}
</div>

<div class="form-group">
{!! Form::label('currentpassword', Lang::get('user.headers.currentpassword'), ['class' => 'control-label']) !!}
    {{ Form::password('currentpassword', array('class' => 'form-control','required' => 'required','value'=>'')) }}

</div>

<div class="form-group">
    {!! Form::label('password', Lang::get('user.headers.newppassword'), ['class' => 'control-label']) !!}
   {{ Form::password('password', array('class' => 'form-control','required' => 'required')) }}
</div>
<div class="form-group">
    {!! Form::label('password_confirmation', Lang::get('user.headers.confirmpassword'), ['class' => 'control-label']) !!}
   {{ Form::password('password_confirmation', array('class' => 'form-control','required' => 'required')) }}
</div>
<div class="form-group">
    <div class="col-md-1" style="margin-left: 15px;">{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}</div>
    <div class="col-md-1" style="margin-left: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-right','onclick'=>'window.history.back();')) }}</div>
</div>