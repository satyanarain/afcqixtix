<div class="row fix-gutters-six">
<div class="col-sm-6">
<div class="form-group">
        {!! Form::label('bus_type', Lang::get('Bus Type'), ['class' => 'control-label required']) !!}
        {!! Form::text('bus_type', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    {!! Form::label('abbreviation', Lang::get('Abbreviation'), ['class' => 'control-label required']) !!}
    {!! Form::text('abbreviation', null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    <div class="form-group">
    @if($bustypes->order_number!='')
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number',null, ['class' => 'form-control','readonly'=>readonly]) !!}
     @else
    @php $bus_type_value= maxId('bus_types','order_number') @endphp
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', $bus_type_value, ['class' => 'form-control','readonly'=>readonly]) !!}
  @endif
    </div>
</div>
<div class="col-sm-12">
<div class="form-group">
{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
</div>
</div>
</div>
</div>
<div>		
    
</div>
