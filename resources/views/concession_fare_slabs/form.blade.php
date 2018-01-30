@php $services=displayList('services','name')@endphp
<div class="form-group">
        {!! Form::label('service_id', Lang::get('Service'), ['class' => 'control-label required']) !!}
        {!! Form::select('service_id',$services,isset($concession_fare_slabs->service_id) ? $concession_fare_slabs->service_id : selected,['class' => 'form-control','required' => 'required','onchange'=>'findDuty(this.value)','placeholder'=>"Select Service"]) !!}

</div>
<div class="form-group">
        {!! Form::label('percentage', Lang::get('Percentage'), ['class' => 'control-label required']) !!}<br>
         {!! Form::number('percentage', null, ['class' => 'form-control','required' => 'required','onkeypress'=>'return isNumberKey(event)']) !!}
</div>
<div class="form-group">
        {!! Form::label('stage_from', Lang::get('Stage From'), ['class' => 'control-label required','onkeypress'=>'return isNumberKey(event)']) !!}<br>
         {!! Form::text('stage_from', null, ['class' => 'form-control','required' => 'required','onkeypress'=>'return isNumberKey(event)']) !!}
</div>
<div class="form-group">
        {!! Form::label('stage_to', Lang::get('Stage To'), ['class' => 'control-label required','onkeypress'=>'return isNumberKey(event)']) !!}<br>
         {!! Form::text('stage_to', null, ['class' => 'form-control','required' => 'required','onkeypress'=>'return isNumberKey(event)']) !!}
</div>
<div class="form-group">
        {!! Form::label('fare', Lang::get('Fare'), ['class' => 'control-label required','onkeypress'=>'return isNumberKey(event)']) !!}<br>
         {!! Form::text('fare', null, ['class' => 'form-control','required' => 'required','onkeypress'=>'return isNumberKey(event)']) !!}
</div>
{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
