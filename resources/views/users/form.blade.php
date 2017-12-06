<div class="form-group">
        {!! Form::label('name', Lang::get('user.headers.name'), ['class' => 'control-label required']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
@if($user->email!='')
<div class="form-group">
    {!! Form::label('email', Lang::get('user.headers.mail'), ['class' => 'control-label required']) !!}
    {!! Form::email('email', null, ['class' => 'form-control','readonly'=>'readonly']) !!}
</div>
@else
<div class="form-group">
    {!! Form::label('email', Lang::get('user.headers.mail'), ['class' => 'control-label required']) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>
@endif
<div class="form-group">
    {!! Form::label('address', Lang::get('user.headers.address'), ['class' => 'control-label required']) !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('country', Lang::get('user.headers.country'), ['class' => 'control-label required']) !!}
    {!! Form::select('country', $countries, isset($user->country) ? $user->country :null,
    ['class' => 'form-control', 'placeholder'=>'Select Country']) !!}
</div>
<div class="form-group">
    {!! Form::label('city', Lang::get('user.headers.city'), ['class' => 'control-label required']) !!}
    {!! Form::text('city',  null, ['class' => 'form-control']) !!}
</div> 
<div class="form-group">
 
       {!! Form::label('contact_number', Lang::get('user.headers.contact_number'), ['class' => 'control-label required']) !!}
    {!! Form::text('contact_number', null, ['class' => 'form-control']) !!}
</div>
 

<div class="form-group">
    {!! Form::label('city', Lang::get('user.headers.dob'), ['class' => 'control-label required']) !!}

    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('contact_number', null, ['class' => 'form-control pull-right','id'=>'datepicker']) !!}
     
    </div>
    <!-- /.input group -->
</div>


<div class="form-group">
 {!! Form::label('image_path', Lang::get('user.headers.image_path'), ['class' => 'control-label required']) !!}
 {!! Form::file('image_path', null, ['class' => 'form-control']) !!}
</div>

 {!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
