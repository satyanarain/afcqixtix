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
        {!! Form::label('from_date', Lang::get('From Date'), ['class' => 'control-label']) !!}    
        {!! Form::text('from_date', null, ['class' => 'multiple_date','readonly' => 'readonly', 'placeholder'=>'DD-MM-YY']) !!}
    </div>

    <div class="col-md-3">
        {!! Form::label('to_date', Lang::get('To Date'), ['class' => 'control-label']) !!}    
        {!! Form::text('to_date', null, ['class' => 'multiple_date','readonly' => 'readonly', 'placeholder'=>'DD-MM-YY']) !!}
    </div>

    <div class="col-md-3">
        @php $orders=['created_at'=>'By Date', 'denom_id'=>'By Denomination']@endphp
        {!! Form::label('order_by', Lang::get('Order By'), ['class' => 'control-label']) !!}
        {!! Form::select('order_by', $orders, null, ['class' => 'form-control','placeholder'=>"Select Order By"]) !!}  
    </div>

    <div class="col-md-3">
        <label>&nbsp;</label>
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
    </div>
</div>


