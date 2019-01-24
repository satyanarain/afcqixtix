<div class="row">
<div class="col-md-3">
    @php $depots_value=displayList('depots','name')@endphp
    {!! Form::label('depot_id', Lang::get('Depot*'), ['class' => 'control-label']) !!}
    {!! Form::select('depot_id',$depots_value,isset($depot->depot_id) ? $depot->depot_id : selected,['class' => ' form-control', 'placeholder'=>"Select Depot"]) !!}
</div> 
<div class="col-md-3">
    {!! Form::label('from_date', Lang::get('From*'), ['class' => 'control-label']) !!}
    {!! Form::text('from_date', date('d-m-Y'), ['class' => 'form-control multiple_date']) !!}
</div>

<div class="col-md-3">
    {!! Form::label('to_date', Lang::get('To*'), ['class' => 'control-label']) !!}
    {!! Form::text('to_date', date('d-m-Y'), ['class' => 'form-control multiple_date']) !!}
</div>

<div class="col-md-3">
    @php $shifts_value=displayList('shifts','shift')@endphp
    {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'control-label']) !!}
    {!! Form::select('shift_id',$shifts_value,isset($depot->shift_id) ? $shifts_value->shift_id : selected,['class' => 'form-control','placeholder'=>"All"]) !!}  
</div>

<div class="col-md-3">
    <?php 
       $status_type=array('c'=>"Audited", 'u'=>"Un-audited");
    ?>
     
    {!! Form::label('status_type', Lang::get('Status Type'), ['class' => 'control-label']) !!}
    {!! Form::select('status_type',$status_type,isset($status_type->status_uype) ? $status_type->status_type : selected,['class' => 'form-control','placeholder'=>"Select Status Type"]) !!}
</div>

<div class="col-md-3">
    {!! Form::label('etm_no', Lang::get('ETM No.'), ['class' => 'control-label']) !!}
    {!! Form::text('etm_no', null, ['class' => 'form-control']) !!}
</div>

<div class="col-md-3">
    <label>&nbsp;</label>
    {{ Form::submit('Submit', array('class' => 'btn btn-success pull-left', 'style'=>'margin-top: 26px;')) }}
</div>
</div>


