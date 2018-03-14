<div class="form-group">
    {!! Form::label('payout_reason', Lang::get('Payout Reason'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
        {!! Form::text('payout_reason', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('short_reason', Lang::get('Short Reason'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
        {!! Form::text('short_reason', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('reason_description', Lang::get('Reason Description'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
        {!! Form::text('reason_description', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    @if($payout_reasons->order_number!='')
    {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
        {!! Form::text('order_number',null, ['class' => 'col-md-6 form-control','readonly'=>readonly]) !!}
    </div>

    @else
    @php $sql= maxId('payout_reasons','order_number') @endphp
    {!! Form::label('order_number', Lang::get('Order Number'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
        {!! Form::text('order_number', $sql, ['class' => 'col-md-6 form-control','readonly'=>readonly]) !!}
    </div>
    @endif
</div>
<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required')) }}
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div> 
