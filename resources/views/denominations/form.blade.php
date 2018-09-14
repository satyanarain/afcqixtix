@php $denomination_masters=displayList('denomination_masters','name')@endphp
<div class="form-group">
        {!! Form::label('denomination_master_id', Lang::get('Denomination Type'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7">
        <span id="denomination_masters">
            {!! Form::select('denomination_master_id',$denomination_masters,isset($denominations->denomination_master_id) ? $denominations->denomination_master_id : selected,['class' => 'form-control','required' => 'required','placeholder'=>"Select Denomination Type"]) !!}
        </span>
        </div>
  
   <div class="col-md-1 col-sm-1 text-left">
       
        <div class="btn btn-sm btn-default" onclick="AddNewShow('denomination_masters','denomination_master_id','Select Denomination Type')">Add New</div> 
    </div>

</div> 
<div class="form-group">
         {!! Form::label('description', Lang::get('Description'), ['class' => 'col-md-3 control-label']) !!}
          <div class="col-md-7 col-sm-12 required">
         {!! Form::text('description', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
         {!! Form::label('price', Lang::get('Price'), ['class' => 'col-md-3 control-label']) !!}
          <div class="col-md-7 col-sm-12 required">
         {!! Form::text('price', null, ['class' => 'col-md-6 form-control','required' => 'required','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>
</div>
<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required')) }}
    <div class="col-md-3" style="margin-right: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-left','onclick'=>'window.history.back();')) }}</div>
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div> 


