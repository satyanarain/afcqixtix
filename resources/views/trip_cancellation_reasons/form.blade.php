@php $trip_cancellation_reason_category_masters=displayList('trip_cancellation_reason_category_masters','name')@endphp
<div class="form-group">
        {!! Form::label('trip_cancellation_reason_category_master_id', Lang::get('Trip Cancel Reason'), ['class' => 'control-label required']) !!}
        {!! Form::select('trip_cancellation_reason_category_master_id',$trip_cancellation_reason_category_masters,isset($trip_cancellation_reasons->trip_cancellation_reason_category_master_id) ? $trip_cancellation_reasons->trip_cancellation_reason_category_master_id : selected,['class' => 'form-control','required' => 'required','placeholder'=>"Select Trip Cancel Reason"]) !!}
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
    @if($trip_cancellation_reasons->order_number!='')
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number',null, ['class' => 'form-control','readonly'=>readonly]) !!}
     @else
    @php $sql= maxId('trip_cancellation_reasons','order_number') @endphp
     {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'control-label required']) !!}
    {!! Form::text('order_number', $sql, ['class' => 'form-control','readonly'=>readonly]) !!}
  @endif
    </div>
</div>
{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
