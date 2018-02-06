<div class="form-group">
         {!! Form::label('payout_reason', Lang::get('Payout Reason'), ['class' => 'control-label required']) !!}
         {!! Form::text('payout_reason', null, ['class' => 'form-control','required' => 'required']) !!}
          
 </div>
<div class="form-group">
         {!! Form::label('short_reason', Lang::get('Short Reason'), ['class' => 'control-label required']) !!}
         {!! Form::text('short_reason', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
         {!! Form::label('reason_description', Lang::get('Reason Description'), ['class' => 'control-label required']) !!}
         {!! Form::text('reason_description', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
    <div class="form-group">
    @if($payout_reasons->order_number!='')
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number',null, ['class' => 'form-control','readonly'=>readonly]) !!}
     @else
    @php $sql= maxId('payout_reasons','order_number') @endphp
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', $sql, ['class' => 'form-control','readonly'=>readonly]) !!}
  @endif
    </div>
</div>
{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
