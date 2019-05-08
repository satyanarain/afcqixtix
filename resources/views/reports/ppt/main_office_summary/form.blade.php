<div class="row">
<div class="col-md-3">
    {!! Form::label('from_date', Lang::get('From'), ['class' => 'control-label']) !!}<span class="label-required">*</span>    
    {!! Form::text('from_date', date('d-m-Y'), ['class' => 'multiple_date','readonly' => 'readonly', 'placeholder'=>'DD-MM-YY']) !!}
</div>

<div class="col-md-3">
    {!! Form::label('to_date', Lang::get('To'), ['class' => 'control-label']) !!}<span class="label-required">*</span>    
    {!! Form::text('to_date', date('d-m-Y'), ['class' => 'multiple_date','readonly' => 'readonly', 'placeholder'=>'DD-MM-YY']) !!}
</div>
<div class="col-md-3">
    @php $denominations=displayList('denominations','description')@endphp
    {!! Form::label('denomination_id', Lang::get('Denomination'), ['class' => 'control-label']) !!}
    {!! Form::select('denomination_id', $denominations, null, ['class' => 'form-control','placeholder'=>"All"]) !!}  
</div>
<div class="col-md-3">
    {!! Form::label('series', Lang::get('Series No.'), ['class' => 'control-label']) !!}
    {!! Form::text('series', null, ['class' => 'form-control']) !!}
</div>

<div class="col-md-3">
    <label>&nbsp;</label>
    {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
</div>
</div>


