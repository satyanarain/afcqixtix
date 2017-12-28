<!--SELECT `id`, `name`, `depot_id`, `short_name`, `depot_location`, `default_service`, `created_at`, `updated_at` FROM `depots` WHERE 1-->
<div class="form-group">
        {!! Form::label('name', Lang::get('Depot Name'), ['class' => 'control-label required']) !!}
        {!! Form::text('name', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('short_name', Lang::get('Short Name'), ['class' => 'control-label required']) !!}
    {!! Form::text('short_name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('depot_location', Lang::get('Depot Location'), ['class' => 'control-label required']) !!}
    {!! Form::text('depot_location', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
      {!! Form::label('default_service', Lang::get('Default Service'), ['class' => 'control-label required']) !!}
      {!! Form::select('default_service',  ['Service1' => "Service1", 'Service2' => 'Service2'],isset($depot->default_service) ? $depot->default_service : selected,
    ['class' => 'form-control', 'placeholder'=>'Select Default Service','required' => 'required']) !!}
</div> 

 {!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
