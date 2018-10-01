<div class="form-group" >
        <label class = 'col-md-3 control-label'>Items</label>
        <div class="col-md-7 col-sm-12 required">
            <select class="form-control" name="items_id" id="items_id" required="" onchange="ShowHideDiv()">
                   <option value="">Please select Items</option>
                   @foreach ($items_data as $itemsdata)
                   <option value="{{$itemsdata->id}}">{{$itemsdata->description}}</option>
                   @endforeach 
                </select>
</div>
</div>
<div id="paperticket" style="display: none">
<div class="form-group" >
        <label class = 'col-md-3 control-label'>Denominations</label>
        <div class="col-md-7 col-sm-12 required">
            <select class="form-control" name="denom_id" id="denom_id" required="">
                   <option value="">Select Denominations</option>
                   @foreach ($paperticket as $ticketdata)
                   <option value="{{$ticketdata->id}}">{{$ticketdata->description}}</option>
                   @endforeach 
                </select>
</div>
</div>
<div class="form-group" >
        {!! Form::label('series', Lang::get('Series'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('series', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group" >
        {!! Form::label('start_sequence', Lang::get('Start Sequence'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('start_sequence', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group" >
        {!! Form::label('end_sequence', Lang::get('End Sequence'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('end_sequence', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
</div>  
<div id="paperroll" style="display: none">
<div class="form-group" >
        {!! Form::label('quantity', Lang::get('Quantity'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('quantity', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
</div>      
<div id="commonblock" style="display: none">
<div class="form-group" >
        {!! Form::label('vender_name', Lang::get('Vendor'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('vender_name', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>    
<div class="form-group" >
        {!! Form::label('challan_no', Lang::get('Challan Number'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('challan_no', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group" >
        {!! Form::label('remark', Lang::get('Remark'), ['class' => 'col-md-3 control-label']) !!}
         <div class="col-md-7 col-sm-12 required">
        {!! Form::text('remark', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('date_received', Lang::get('Date Received'), ['class' => 'col-md-3 control-label']) !!}
 <div class="col-md-7 col-sm-12 required">
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('date_received', $date_received, ['class' => 'multiple_date','readonly'=>'readonly','required' => 'required']) !!}
      </div>
      </div>
    <!-- /.input group -->
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
<script type="text/javascript">
    function ShowHideDiv(id) {
        var itemsid = document.getElementById("items_id").value;
        if(parseInt(itemsid) == 1)
        {
          paperticket.style.display = "block";
          paperroll.style.display = "none";
          commonblock.style.display = "block";
          document.getElementById("quantity").required = false;
          
        }
        if(parseInt(itemsid) == 2)
        {
          paperroll.style.display = "block";
          paperticket.style.display = "none";
          commonblock.style.display = "block";
            
          document.getElementById("denom_id").required = false;
          document.getElementById("series").required = false;
          document.getElementById("start_sequence").required = false;
          document.getElementById("end_sequence").required = false;
        }
    }
</script>

