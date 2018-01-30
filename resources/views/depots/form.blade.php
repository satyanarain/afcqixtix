<div class="row fix-gutters-six">
<div class="col-sm-6">
<div class="form-group">
        {!! Form::label('name', Lang::get('Depot Name'), ['class' => 'control-label required']) !!}
        {!! Form::text('name', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
        {!! Form::label('depot_id', Lang::get('Depot ID'), ['class' => 'control-label required']) !!}
        {!! Form::text('depot_id', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    {!! Form::label('short_name', Lang::get('Short Name'), ['class' => 'control-label required']) !!}
    {!! Form::text('short_name', null, ['class' => 'form-control']) !!}
</div>
    </div>
<div class="col-sm-6">
<div class="form-group">
    {!! Form::label('depot_location', Lang::get('Depot Location'), ['class' => 'control-label required']) !!}
    {!! Form::text('depot_location', null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
      {!! Form::label('default_service', Lang::get('Default Service'), ['class' => 'control-label required']) !!}
      {!! Form::select('default_service',  ['A-G-Holidays' => "A-G-Holidays", 'Apple-Travels' => 'Apple-Travels'],isset($depot->default_service) ? $depot->default_service : selected,
    ['class' => 'form-control', 'placeholder'=>'Select Default Service','required' => 'required']) !!}
</div> 
</div> 
<div class="col-sm-12">
{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
</div> 
</div> 

