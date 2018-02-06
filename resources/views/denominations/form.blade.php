@php $denomination_masters=displayList('denomination_masters','name')@endphp
<div class="col-sm-12">
    <div class="col-sm-6">
        {!! Form::label('denomination_master_id', Lang::get('Denomination Type'), ['class' => 'control-label required']) !!}
        <span id="denomination_masters">{!! Form::select('denomination_master_id',$denomination_masters,isset($denominations->denomination_master_id) ? $denominations->denomination_master_id : selected,['class' => 'form-control','required' => 'required','placeholder'=>"Select Denomination Type"]) !!}</span>

    </div>
    <div class="col-sm-6">
        </br>
        <div class="btn btn-success" onclick="AddNewShow('denomination_masters','denomination_master_id','Select Denomination Type')">Add New</div> 
    </div>

</div>   
 <div class="form-group">
         {!! Form::label('denomination', Lang::get('Denomination'), ['class' => 'control-label required']) !!}
         {!! Form::text('denomination', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
         {!! Form::label('description', Lang::get('Description'), ['class' => 'control-label required']) !!}
         {!! Form::text('description', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
         {!! Form::label('price', Lang::get('Price'), ['class' => 'control-label required']) !!}
         {!! Form::text('price', null, ['class' => 'form-control','required' => 'required','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}


