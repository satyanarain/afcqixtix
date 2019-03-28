<div class="form-group" >
  <label class = 'col-md-3 control-label'>Items</label>
  <div class="col-md-7 col-sm-12 required">
    <select class="form-control" name="items_id" id="items_id" required="" onchange="ShowHideDiv()">
     <option value="">Please select Items</option>
     @foreach ($items_data as $itemsdata)
     <option value="{{$itemsdata->id}}" @if(isset($stock) && ($itemsdata->id == $stock->items_id)) selected @endif>{{$itemsdata->description}}</option>
     @endforeach 
   </select>
 </div>
</div>
<div id="paperticket" style="display: none">
<table class="table table-bordered" id="denominations_table">
  <thead>
    <tr>
      <td>Denominations</td>
      <td>Series</td>
      <td>Start Sequence</td>
      <td>End Sequence <button type="button" id="add_more_denomination" class="btn btn-primary pull-right"><span class="fa fa-plus"></span></button></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <select class="form-control" name="denom_id[]" id="denom_id" required="">
         <option value="">Select Denominations</option>
         @foreach ($paperticket as $ticketdata)
         <option value="{{$ticketdata->id}}" @if(isset($stock) && ($ticketdata->id == $stock->denom_id)) selected @endif>{{$ticketdata->description}}</option>
         @endforeach 
        </select>
      </td>
      <td>
        {!! Form::text('series[]', null, ['class' => 'col-md-6 form-control series','required' => 'required']) !!}
      </td>
      <td>
        {!! Form::text('start_sequence[]', null, ['class' => 'col-md-6 form-control start_sequence','required' => 'required', 'onkeypress'=>'return numvalidate(event)']) !!}
      </td>
      <td>
        {!! Form::text('end_sequence[]', null, ['class' => 'col-md-6 form-control','required' => 'required', 'onkeypress'=>'return numvalidate(event)']) !!}
      </td>
    </tr>
  </tbody>
</table>
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
  <div class="form-group">
    {!! Form::label('date_received', Lang::get('Date Received'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('date_received', isset($stock)?date('d-m-Y', strtotime($stock->date_received)):null, ['class' => 'multiple_date readonly','required' => 'required']) !!}
      </div>
    </div>
    <!-- /.input group -->
  </div>  
  <div class="form-group" >
    {!! Form::label('fileupload', Lang::get('Upload File (if any)'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12">
      {!! Form::file('fileupload', ['class' => 'col-md-6 form-control', 'accept'=>"image/*,.pdf"]) !!}
    </div>
  </div>  
  <div class="form-group" >
    {!! Form::label('remark', Lang::get('Remark'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
      {!! Form::textarea('remark', null, ['class' => 'col-md-6 form-control','required' => 'required','rows' => 4]) !!}
    </div>
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
<script type="text/javascript">
  $(document).on('click', '.fa-calendar', function(){
      //alert('Hi');
      $('#date_received').focus();
  });

  $(".readonly").on('keydown paste', function(e){
      e.preventDefault();
  });

  $(document).ready(function(){
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

      $('select[name="denom_id[]"').attr('required', false);
      $('input[name="series[]"').attr('required', false);
      $('input[name="start_sequence[]"').attr('required', false);
      $('input[name="end_sequence[]"').attr('required', false);
    }
  })

  function numvalidate(e) 
    {
        var key;
        var keychar;
        if (window.event)
            key = window.event.keyCode;
        else if (e)
            key = e.which;
        else
            return true;
        keychar = String.fromCharCode(key);
        keychar = keychar.toLowerCase();
        // control keys
        if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27))
            return true;
        else if (!(("1234567890").indexOf(keychar) > -1)) {
            return false;
        }
    }
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

      $('select[name="denom_id[]"').attr('required', false);
      $('input[name="series[]"').attr('required', false);
      $('input[name="start_sequence[]"').attr('required', false);
      $('input[name="end_sequence[]"').attr('required', false);
    }
  }
var myLimit = 1;
  $(document).on('click', '#add_more_denomination', function(){
    var options = '{!!$paperticket!!}';
    var maxCount = JSON.parse(options).length;
    console.log(myLimit+'=>'+maxCount);
    if(myLimit < maxCount)
    {
        var str = "";
        str += '<tr>'
        str += '<td>'
        str += '<select class="form-control" name="denom_id[]" id="denom_id" required="">'
        str += '<option value="">Select Denominations</option>'
        $.each(JSON.parse(options), function(index, option){
          str += '<option value="'+option.id+'">'+option.description+'</option>'
        });          
        str += '</select>'
        str += '</td>'
        str += '<td>'
        str += '<input class="col-md-6 form-control series" required="required" name="series[]" type="text">'
        str += '</td>'
        str += '<td>'
        str += '<input class="col-md-6 form-control start_sequence" required="required" name="start_sequence[]" type="text" onkeypress="return numvalidate(event)">'
        str += '</td>'
        str += '<td>'
        str += '<input class="col-md-6 form-control" style="width:75%;" required="required" name="end_sequence[]" type="text" onkeypress="return numvalidate(event)"><button type="button" class="removeDenominationsRow btn btn-danger pull-right"><span class="fa fa-trash"></span></button>'
        str += '</td>'
        str += '</tr>'

        $('#denominations_table').append(str);
        myLimit++;
    }else{
      return alert('You can not add more rows than denominations!');
    }
  });


  $(document).on('click', '.removeDenominationsRow', function(){
    $(this).parent().parent().remove();
  });

$(document).on('change', '#fileupload', function() 
{
    var fileSize =  this.files[0].size/1024/1024;
    if(fileSize > 1)
    {
        $('#fileupload').val('');
        alert('File must me less than 1MB.');
    }
});

$(document).on('blur', '.start_sequence', function()
{
    var num = $(this).val();
    if(num == 0)
    {
        $(this).val('');
        return alert('Start Sequence can not be 0.');
    }
});

$(document).on('blur', '.series', function()
{
    var series = $(this).val();
    if(!series)
    {
        $(this).val('');
        return alert('Please enter seires.');
    }

    
});
</script>
@endpush

