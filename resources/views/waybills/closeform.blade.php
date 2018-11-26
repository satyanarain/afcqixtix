<div class="form-group ">
     {!! Form::label('conductor', Lang::get('Conductor'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-2 col-sm-12">
        {!! Form::select('conductor_id', $crew,isset($waybills->conductor_id) ? $waybills->conductor_id : selected, ['class' => 'col-md-4 form-control','disabled']) !!}        
    </div>
    <div class="col-md-2 col-sm-12">
         {!! Form::checkbox('actual_conductor_id_checkbox', null,null, ['id'=>'actual_conductor_id_checkbox','class' => 'actual_conductor_id_checkbox']) !!}
        {!! Form::label('actual_conductor_id_checkbox', Lang::get('Change'), ['class' => 'control-label','for'=>'actual_conductor_id_checkbox']) !!}
    </div>
    {!! Form::label('driver', Lang::get('Driver'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-2 col-sm-12">
        {!! Form::select('driver_id', $crew,isset($waybills->driver_id) ? $waybills->driver_id : selected, ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>
    <div class="col-md-2 col-sm-12">
         {!! Form::checkbox('actual_driver_id_checkbox', null,null, ['id'=>'actual_driver_id_checkbox','class' => 'actual_driver_id_checkbox']) !!}
        {!! Form::label('actual_driver_id_checkbox', Lang::get('Change'), ['class' => 'control-label','for'=>'actual_driver_id_checkbox']) !!}
    </div>
</div> 
<div class="form-group ">
    <div class="actual_conductor_id" style="display: none;">
    {!! Form::label('conductor', Lang::get('Actual Conductor'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
    {!! Form::select('conductor', $crew,null, ['class' => 'col-md-6 form-control']) !!}
    </div>
    </div>
    <div class="actual_driver_id" style="display: none;">
    {!! Form::label('driver', Lang::get('Actual Driver'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
        {!! Form::select('driver', $crew,null, ['class' => 'col-md-6 form-control']) !!}
    </div>
    </div>
</div>
<div class="form-group ">
     {!! Form::label('etm_no', Lang::get('ETM No.'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('etm_no', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
     {!! Form::label('vehicle_id', Lang::get('Vehicle'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
    {!! Form::select('vehicle_id', $vehicles,null,
        ['class' => 'col-md-6 form-control']) !!}
    </div>
</div>
<div class="form-group ">
    {!! Form::label('route_id', Lang::get('Route'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
        @php $routes=displayList('route_master','route_name');@endphp
       {!! Form::select('route_id', $routes,isset($waybills->route_id) ? $waybills->route_id : selected,
        ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>
    {!! Form::label('duty_id', Lang::get('Duty'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
    {!! Form::select('duty_id', $duties,null,
        ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>
</div> 

<div class="form-group ">
    {!! Form::label('service_id', Lang::get('Service'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
    {!! Form::select('service_id', $services,null,
        ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>


    {!! Form::label('shift_id', Lang::get('Shift'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
        @php $shifts=displayList('shifts','shift');@endphp
       {!! Form::select('shift_id', $shifts,isset($waybills->shift_id) ? $waybills->shift_id : selected,
        ['class' => 'col-md-6 form-control','disabled']) !!}
    </div>

</div>

<div class="form-group ">
     {!! Form::label('bag_no', Lang::get('Bag No.'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('bag_no', null, ['class' => 'col-md-6 form-control']) !!}
    </div>

     {!! Form::label('waybill_no', Lang::get('Waybill No.'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('waybill_no', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
</div> 



<div class="form-group ">
     {!! Form::label('paper_roll_issued', Lang::get('Paper Roll Issued'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('paper_roll_issued', null, ['class' => 'col-md-6 form-control']) !!}
    </div>

     {!! Form::label('paper_roll_received', Lang::get('Paper Roll Received'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('paper_roll_received', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('portable_ups_issued', Lang::get('Portable UPS Issued'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('portable_ups_issued', null, ['class' => 'col-md-6 form-control']) !!}
    </div>

     {!! Form::label('portable_ups_received', Lang::get('Portable UPS Received'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('portable_ups_received', null, ['class' => 'col-md-6 form-control']) !!}
    </div>
</div>
<!--<div class="form-group ">
     {!! Form::label('etm_issue_time', Lang::get('ETM Issued Date and Time'), ['class' => 'col-md-2 control-label','for'=>'etm_issue_time']) !!}
    <div class="col-md-4 col-sm-12">
        {!! Form::text('etm_issue_time', date('Y-m-d'), ['class' => 'form-control']) !!}
    </div>

     {!! Form::label('etm_receive_time', Lang::get('ETM Received Date and Time'), ['class' => 'col-md-2 control-label','for'=>'etm_receive_time']) !!}
    <div class="col-md-4 col-sm-12">
        <div class="input-group date form_datetime col-md-10" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="etm_receive_time">
        {!! Form::text('etm_receive_time', date('Y-m-d'), ['class' => 'form-control','readonly'=>'readonly']) !!}
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="etm_receive_time" value="" />
        <input type="hidden" readonly="readonly" id="status" name="status" value="s" />
    </div>
</div>-->
<div class="form-group ">
     {!! Form::label('remarks', Lang::get('Remarks'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::textarea('remarks', null, ['class' => 'col-md-6 form-control','rows'=>'3']) !!}
    </div>
</div> 

<div class="box-header with-border">
    <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
    <h3 class="box-title">ETM Details</h3>
</div>
<div class="form-group ">
    <div class="col-md-12 col-sm-12">
        <table style="width: 100%;" border='1px'>
            <tr>
                <td>Day Time</td>
                <td>Conductor / Driver</td>
                <td>ETM No. / Abstract No.</td>
                <td>Route / Duty / Shift</td>
                <td>Vehicle-Bus Type</td>
                <td>ETM pass / Ticket</td>
                <td>Payout (Rs.)</td>
                <td>Audit</td>
            </tr>
            <tr>
                <td><?php   if($shift_details->start_timestamp){echo date('H:i',strtotime($shift_details->start_timestamp)).'<br>';}
                            if($shift_details->end_timestamp){echo date('H:i',strtotime($shift_details->end_timestamp));}?></td>
                <td><?php echo $shift_details->conductor_name.'<br>'.$shift_details->driver_name;?></td>
                <td><?php echo $shift_details->abstract_no;?></td>
                <td><?php echo $shift_details->route.'/'.$shift_details->duty_number.'/'.$shift_details->shift;?></td>
                <td><?php echo $shift_details->vehicle_registration_number.'-'.$shift_details->bus_type;?></td>
                <td style="text-align: right"><?php echo $etm_pass_amount.'<br>'.$etm_ticket_amount;?></td>
                <td style="text-align: right"><?php echo $total_payout;?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5">Total</td>
                <td style="text-align: right"><?php echo $etm_pass_amount+$etm_ticket_amount;?></td>
              
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
    
</div>
<div class="box-header with-border">
    <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
    <h3 class="box-title">Manual Details</h3>
</div>
<div class="form-group ">
    <div class="col-md-12 col-sm-12">
        <table style="width: 100%;" border='1px'>
            <tr>
                <td>Type</td>
                <td>Denomination</td>
                <td>Series</td>
                <td>Start Tkt. No.</td>
                <td>Current Start Tkt. No.</td>
                <td>No. of Tkt. Sold</td>
                <td>Total Value (Rs.)</td>
            </tr>
            <?php $count=1;
                foreach($items as $item){
                    echo '<tr>
                    <td>'.$item->name.'</td>
                    <td>'.$item->denom.'</td>
                    <td>'.$item->series.'</td>
                    <td>'.$item->start_sequence.'</td>
                    <td>';
                    if($item->end_sequence){
                        echo '<input name="ticketstock-'.$item->id.'-'.$item->denomination_id.'" value="0" min="'.$item->start_sequence.'" price="'.$item->price.'" count="'.$count.'" max="'.$item->end_sequence.'" class="audit_items" type="text" style="width:50px;height:15px;">'.$item->end_sequence;
                    }else{
                        echo '<input name="item-stock-'.$item->id.'" value="0" min="'.$item->quantity.'" price="0" count="'.$count.'" max="'.$item->quantity.'" class="audit_items" type="text" style="width:50px;height:15px;">'.$item->quantity;
                    }
                    echo '</td>
                    <td style="text-align: right" class="ticket_sold_count'.$count.'">0</td>
                    <td style="text-align: right" class="ticket_sold_value'.$count.'">0</td>
            </tr>';
            $count++;
            }?>
            <tr>
                <td><b>Total</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right" class="total_ticket_value">0</td>
            </tr>
        </table>
    </div>
    
</div>

<div class="box-header with-border">
    <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
    <h3 class="box-title">Remittance Details</h3>
</div>
<div class="form-group ">
     <div class="col-md-2 col-sm-12 control-label">
         Total Cash (Rs.)
    </div>
    <div class="col-md-4 col-sm-12 total_cash">
         <?php echo $etm_ticket_amount+$etm_pass_amount;?>
    </div>
    <div class="col-md-2 col-sm-12 control-label">
        Total Payout (Rs.)
    </div>
    <div class="col-md-4 col-sm-12 total_payout">
         <?php echo $total_payout;?>
    </div>

     
</div> 
<div class="form-group ">
     {!! Form::label('batta', Lang::get('Batta (Rs.)'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('batta', 0, ['class' => 'col-md-6 form-control batta']) !!}
    </div>

     {!! Form::label('driver_incentive', Lang::get('Driver Incentive (Rs.)'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('driver_incentive', 0, ['class' => 'col-md-6 form-control driver_incentive']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('conductor_incentive', Lang::get('Conductor Incentive (Rs.)'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('conductor_incentive', 0, ['class' => 'col-md-6 form-control conductor_incentive']) !!}
    </div>

     {!! Form::label('tea_allowance', Lang::get('Tea Allowance (Rs.)'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('tea_allowance', 0, ['class' => 'col-md-6 form-control tea_allowance']) !!}
    </div>
</div>
<div class="form-group ">
     {!! Form::label('payable_amount', Lang::get('Payable Amount (Rs.)'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12 payable_amount">
          <?php echo $etm_ticket_amount+$etm_pass_amount-$total_payout;?>
    </div>

     {!! Form::label('remarks', Lang::get('Remarks'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 col-sm-12">
          {!! Form::text('remarks', null, ['class' => 'col-md-6 form-control']) !!}
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

@push('scripts')
<script>$(document).ready(function(){
    $('.actual_conductor_id_checkbox').click(function(){
        if($(this).prop('checked'))
            $('.actual_conductor_id').show();
        else
            $('.actual_conductor_id').hide();
    })
    $('.actual_driver_id_checkbox').click(function(){
        if($(this).prop('checked'))
            $('.actual_driver_id').show();
        else
            $('.actual_driver_id').hide();
    })
    $(document).on("change", ".audit_items", function() {
        var sum = parseInt($(".total_ticket_value").html());
        var total_cash = parseInt($(".total_cash").html());
        var payable_amount = parseInt($(".payable_amount").html());
        var min = parseInt($(this).attr('min'));
        var max = parseInt($(this).attr('max'));
        var curr_val = parseInt($(this).val());
        var counter = $(this).attr('count');
        var price = $(this).attr('price');
        if(parseInt(price)==0)
            return false;
        if(curr_val<min || curr_val>max)
        {
            alert('invalid number');
            $(this).val(0);
            $(this).focus()
            return false;
        }else{
            var ticketcount = curr_val-min;
            var ticketvalue = ticketcount*price;
            $(".ticket_sold_count"+counter).html(ticketcount);
            $(".ticket_sold_value"+counter).html(ticketvalue);
            sum += ticketvalue;
            total_cash+= ticketvalue;
            payable_amount += ticketvalue;
        }
        $(".total_ticket_value").html(sum);
        $(".total_cash").html(total_cash);
        $(".payable_amount").html(payable_amount);
    });
    
    $(document).on("change", ".batta, .driver_incentive, .conductor_incentive, .tea_allowance", function() {
        var payable_amount = parseInt($(".total_cash").html())-parseInt($(".total_payout").html());
        var batta = parseInt($(".batta").val());
        var driver_incentive = parseInt($(".driver_incentive").val());
        var conductor_incentive = parseInt($(".conductor_incentive").val());
        var tea_allowance = parseInt($(".tea_allowance").val());
        var updated_payable_amount = payable_amount-batta-driver_incentive-conductor_incentive-tea_allowance;
        $(".payable_amount").html(updated_payable_amount);
    });
    

})</script>
@endpush