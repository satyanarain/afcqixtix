<div class="form-group">
        {!! Form::label('bus_type', Lang::get('Bus Type'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('bus_type', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
        {!! Form::label('abbreviation', Lang::get('Abbreviation'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('abbreviation', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
   @if($bustypes->order_number!='')
        {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('order_number', null, ['class' => 'col-md-6 form-control','readonly' => 'readonly']) !!}
        </div>
         @else
         @php $bus_type_value= maxId('bus_types','order_number') @endphp
         {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('order_number', $bus_type_value, ['class' => 'col-md-6 form-control','readonly' => 'readonly',]) !!}
        </div>
         @endif
</div>

<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required')) }}
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div>


