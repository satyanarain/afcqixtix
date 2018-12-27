<div class="row">
<div class="col-md-3">
    @php $depots_value=displayList('depots','name')@endphp
    {!! Form::label('depot_id', Lang::get('Depot'), ['class' => 'control-label']) !!}
    {!! Form::select('depot_id',$depots_value,isset($depot->depot_id) ? $depot->depot_id : selected,['class' => ' form-control','required' => 'required','placeholder'=>"Select Depot"]) !!}
</div> 
<div class="col-md-3">
    @php $denominations=displayList('denominations','description')@endphp
    {!! Form::label('denomination_id', Lang::get('Denomination'), ['class' => 'control-label']) !!}
    {!! Form::select('denomination_id', $denominations, null, ['class' => 'form-control','placeholder'=>"Select Denomination"]) !!}  
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


