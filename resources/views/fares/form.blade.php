@php $services=displayList('services','name')@endphp


<div class="form-group">
        {!! Form::label('service_id', Lang::get('Service'), ['class' => 'control-label required']) !!}
        {!! Form::select('service_id',$services,isset($fares->service_id) ? $fares->service_id : selected,['class' => 'form-control','required' => 'required','onchange'=>'findDuty(this.value)','placeholder'=>"Select Service"]) !!}

</div>

<div class="form-group">
        {!! Form::label('stage', Lang::get('Stage'), ['class' => 'control-label required']) !!}<br>
         {!! Form::text('stage', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
        {!! Form::label('adult_ticket_amount', Lang::get('Adult Ticket Amount (Rs).'), ['class' => 'control-label required']) !!}<br>
         {!! Form::text('adult_ticket_amount', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
        {!! Form::label('child_ticket_amount', Lang::get('Child Ticket Amount (Rs).'), ['class' => 'control-label required']) !!}<br>
         {!! Form::text('child_ticket_amount', null, ['class' => 'form-control','required' => 'required']) !!}
</div>
<div class="form-group">
        {!! Form::label('luggage_ticket_amount', Lang::get('Luggage Ticket Amount (Rs).'), ['class' => 'control-label required']) !!}<br>
         {!! Form::text('luggage_ticket_amount', null, ['class' => 'form-control','required' => 'required']) !!}
</div>


{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}
