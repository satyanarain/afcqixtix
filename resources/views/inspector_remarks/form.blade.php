<div class="form-group">
         {!! Form::label('inspector_remark', Lang::get('Inspector Remark'), ['class' => 'control-label required']) !!}
         {!! Form::text('inspector_remark', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
         {!! Form::label('short_remark', Lang::get('Short Remark'), ['class' => 'control-label required']) !!}
         {!! Form::text('short_remark', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
         {!! Form::label('remark_description', Lang::get('Remark Description'), ['class' => 'control-label required']) !!}
         {!! Form::text('remark_description', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    <div class="form-group">
    @if($inspector_remarks->order_number!='')
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number',null, ['class' => 'form-control','readonly'=>readonly]) !!}
     @else
    @php $sql= maxId('inspector_remarks','order_number') @endphp
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', $sql, ['class' => 'form-control','readonly'=>readonly]) !!}
  @endif
    </div>
</div>
{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
