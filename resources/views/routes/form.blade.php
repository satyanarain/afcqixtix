<div class="form-group">
        {!! Form::label('route', Lang::get('Route'), ['class' => 'control-label required']) !!}
        {!! Form::text('route', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
        {!! Form::label('path', Lang::get('Path'), ['class' => 'control-label required']) !!}
        {!! Form::text('path', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('direction', Lang::get('Direction'), ['class' => 'control-label required']) !!}<br>
    {!! Form::radio('direction', 1, ['class' => 'form-control']) !!} Up&nbsp;
    {!! Form::radio('direction', 0, ['class' => 'form-control']) !!} Down
    
</div>
<div class="form-group">
        {!! Form::label('default_path', Lang::get('Default Path'), ['class' => 'control-label']) !!}<br>
        {!! Form::checkbox('default_path',1,isset($routes->default_path) ? $routes->default_path : checked, ['class' => 'form-control1']) !!}
</div>
@php $stops=displayList('stops','stop')@endphp
<div class="form-group">
        {!! Form::label('stop_id', Lang::get('Stops'), ['class' => 'control-label required']) !!}
        {!! Form::select('stop_id',$stops,isset($routes->stop_id) ? $routes->stop_id : selected,['class' => 'form-control','required' => 'required']) !!}

</div>
<div class="form-group">
        {!! Form::label('stage_number', Lang::get('Stage Number'), ['class' => 'control-label required']) !!}
        {!! Form::text('stage_number', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('distance', Lang::get('Distance(km)'), ['class' => 'control-label required']) !!}
    {!! Form::text('distance', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('hot_key', Lang::get('Hot Key'), ['class' => 'control-label required']) !!}
    {!! Form::text('hot_key', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('is_this_by', Lang::get('Is this via stop of the path? '), ['class' => 'control-label required']) !!}<br>
    {!! Form::radio('is_this_by', 0, ['class' => 'form-control']) !!} No&nbsp;
    {!! Form::radio('is_this_by', 1, ['class' => 'form-control']) !!} Yes
    
</div>
{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
