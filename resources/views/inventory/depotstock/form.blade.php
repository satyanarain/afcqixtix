<div class="form-group" >
  <label class ='col-md-3 control-label'>Depots</label>
  <div class="col-md-7 col-sm-12 required">
    {!!Form::select('depot_id', $depots, isset($stock)?$stock->depot_id:null, ['placeholder'=>'Please select a depot', 'class'=>'form-control', 'id'=>'depot_id', 'required'])!!}
 </div>
</div>
<div class="form-group" >
  <label class = 'col-md-3 control-label'>Items</label>
  <div class="col-md-7 col-sm-12 required">
    <select class="form-control denomination" name="items_id" id="items_id" required="" onchange="ShowHideDiv()">
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
      <td>End Sequence</td>
      <td>Total Tickets <button type="button" id="add_more_denomination" class="btn btn-primary pull-right"><span class="fa fa-plus"></span></button></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <select class="form-control denom_id" name="denom_id[]" id="denom_id" required="">
         <option value="">Select Denominations</option>
         @foreach ($paperticket as $ticketdata)
         <option value="{{$ticketdata->id}}" @if(isset($stock) && ($ticketdata->id == $stock->denom_id)) selected @endif>{{$ticketdata->description}}</option>
         @endforeach 
        </select>
      </td>
      <td>
        {!! Form::select('series[]', [], null, ['class' => 'col-md-6 form-control series', 'required' => 'required']) !!}
        <label class="series_errors label label-warning" style="display: none;word-wrap: break-word;"></label>
      </td>
      <td>
        {!! Form::text('start_sequence[]', null, ['class' => 'col-md-6 form-control start_sequence','required' => 'required', 'onkeypress'=>'return numvalidate(event)']) !!}
        <label class=".start_sequence_errors label label-warning" style="display: none;word-wrap: break-word;"></label>
      </td>
      <td>
        {!! Form::text('end_sequence[]', null, ['class' => 'col-md-6 form-control end_sequence', 'required' => 'required', 'onkeypress'=>'return numvalidate(event)']) !!}
        <label class=".end_sequence_errors label label-warning" style="display: none;word-wrap: break-word;"></label>
      </td>
      <td>
        {!! Form::text('total_tickets[]', null, ['class' => 'col-md-6 form-control total_tickets', 'readonly']) !!}
      </td>
    </tr>
  </tbody>
</table>
</div>  
<div id="paperroll" style="display: none">
  <div class="form-group" >
    {!! Form::label('quantity', Lang::get('Quantity'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
      {!! Form::text('quantity', null, ['class' => 'col-md-6 form-control','required' => 'required', 'onkeypress'=>'return numvalidate(event)']) !!}
      <label id="quantyty_errors" class="lable label-warning" style="display: none;"></label>
    </div>
  </div>
</div>      
<div id="commonblock" style="display: none">
  <div class="form-group" >
    {!! Form::label('challan_no', Lang::get('Challan Number'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
      {!! Form::text('challan_no', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group" >
    {!! Form::label('remark', Lang::get('Remark'), ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7 col-sm-12 required">
      {!! Form::textarea('remark', null, ['class' => 'col-md-6 form-control','required' => 'required', 'rows'=>3]) !!}
    </div>
  </div>    
</div>    


<div class="form-group">
  <div class="col-md-3" style="margin-right: 15px;"></div>
  {{ Form::submit('Save', array('class' => 'btn btn-success pull-left','required' => 'required', 'id'=>'saveInventory')) }}
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
      $('select[name="series[]"').attr('required', false);
      $('input[name="start_sequence[]"').attr('required', false);
      $('input[name="end_sequence[]"').attr('required', false);
    }
  })
  function ShowHideDiv(id) 
  {
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
      $('select[name="series[]"').attr('required', false);
      $('input[name="start_sequence[]"').attr('required', false);
      $('input[name="end_sequence[]"').attr('required', false);
    }
  }

  function validateForm()
  {
      var depot_id = $('#depot_id').val();
      if(!depot_id)
      {
        alert('Please select a depo');
        return false;
      }

      var items_id = $('#items_id').val();
      if(!items_id)
      {
        alert('Please select an item');
        return false;
      }

      if(items_id == 1)
      {
  
      }else if(items_id == 2) {
            var quantity = $('#quantity').val();
            if(!quantity)
            {
              alert('Please enter quantity');
              return false;
            }
      }else{
            alert('Please select an item');
            return false;
      }  

      var remark = $('#remark').val();
      if(!remark)
      {
          alert('Please enter remark');
          return false;
      }   
  }
</script>
<script type="text/javascript">
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
        str += '<select class="form-control denom_id denomination" name="denom_id[]" id="denom_id" required="">'
        str += '<option value="">Select Denominations</option>'
        $.each(JSON.parse(options), function(index, option){
          str += '<option value="'+option.id+'">'+option.description+'</option>'
        });          
        str += '</select>'
        str += '</td>'
        str += '<td>'
        str += '<select class="col-md-6 form-control series" required="required" name="series[]" type="text"></select><label class="series_errors label label-warning" style="display: none;word-wrap: break-word;"></label>'
        str += '</td>'
        str += '<td>'
        str += '<input class="col-md-6 form-control start_sequence" required="required" name="start_sequence[]" type="text" onkeypress="return numvalidate(event)"><label class="start_sequence_errors label label-warning" style="display: none;word-wrap: break-word;"></label>'
        str += '</td>'
        str += '<td>'
        str += '<input class="col-md-6 form-control end_sequence" required="required" name="end_sequence[]" type="text" onkeypress="return numvalidate(event)"><label class="end_sequence_errors label label-warning" style="display: none;word-wrap: break-word;"></label>'
        str += '</td>'
        str += '<td>'
        str += '<input class="col-md-6 form-control total_tickets" style="width:75%;" readonly name="total_tickets[]" type="text"><button type="button" class="removeDenominationsRow btn btn-danger pull-right"><span class="fa fa-trash"></span></button>'
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


  $(document).on('change', '.denom_id', function(){
        var items_id = $('#items_id').val();

        if(!items_id)
        {
            return alert('Please select an item');
        }

        var selector = $(this);

        var denom_id = $(this).val();
        if(!denom_id)
        {
            return alert('Please select a denomination');
        }

        var series = $(this).parent('td').next().children('input').val();

        if(series)
        {
            var allSeries = $('#denominations_table').find('.series').not(':last');
            var allDenominations = $('#denominations_table').find('.denomination').not(':last');
            allSeries.map(function(indexs, inputs){
                allDenominations.map(function(indexd, inputd){
                    if(inputs.value === series && inputd.value === denom_id)
                    {   
                        $('#saveInventory').attr('disabled', true);
                        return alert('You can not enter same series twice for a denomination.');
                    }else{
                        $('#saveInventory').attr('disabled', false);
                    }
                });
            });
        }

        var data =  {
                        _token: "{{csrf_token()}}",
                        items_id: items_id,
                        denom_id: denom_id
                    };

        $.ajax({
            url: "{{route('inventory.depotstock.getseries')}}",
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function(response)
            {   
                var data = response;
                if(data.status == 'Ok')
                {
                    var options = "<option>Select a series</option>";
                    var series = data.data;
                    if(series.length > 0)
                    {
                      $.each(series, function(index, se){
                        options += '<option>'+se.series+'</option>';
                      });
                      $('#saveInventory').attr('disabled', false);
                      $(selector).parent('td').next('td').children('label').hide();
                    } else {
                      $('#saveInventory').attr('disabled', true);
                      $(selector).parent('td').next('td').children('label').text('Series not available in the central stock. Please contact to central stock head').show();
                    } 

                    $(selector).parent('td').next('td').children('select').html(options);   
                    $(selector).parent('td').next('td').next('td').children('input').val('');
                    $(selector).parent('td').next('td').next('td').children('label').hide();          
                }
            },
            error: function(data)
            {
                console.log(data);
            }
        });

  });

  $(document).on('change', '.series', function(){
        var selector = $(this);
        var items_id = $('#items_id').val();

        if(!items_id)
        {
            return alert('Please select an item');
        }
        var denom_id = $(selector).parent('td').prev('td').children('select').val();
        if(!denom_id)
        {
            return alert('Please select a denomination');
        }
        var series = $(this).val();

        if(!series)
        {
            $(this).val('');
            return alert('Please select a valid series');
        }

        var allSeries = $('#denominations_table').find('.series').not(':last');
        var allDenominations = $('#denominations_table').find('.denom_id').not(':last');

        outerloop:for(var i=0;i<allSeries.length;i++)
                  {
                      innerloop:for(var j=0;j<allDenominations.length;j++)
                                {
                                    var inputs = allSeries[i];
                                    var inputd = allDenominations[j];
                                    if(inputs.value === series && inputd.value === denom_id)
                                    {     
                                        $('#saveInventory').attr('disabled', true);
                                        return alert('You can not have same series twice for a denomination.');
                                        break outerloop;
                                    }else{
                                        $('#saveInventory').attr('disabled', false);
                                    }
                                }
                  }

        console.log('Passed');

        var data =  {
                        _token: "{{csrf_token()}}",
                        items_id: items_id,
                        denom_id: denom_id,
                        series: series
                    };

        $.ajax({
            url: "{{route('inventory.depotstock.getstartsequence')}}",
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function(response)
            {   
                var data = response;
                if(data.status == 'Ok')
                {
                    if(data.data.start_sequence)
                    {
                      $(selector).parent('td').next('td').children('input').val(data.data.start_sequence);
                      $(selector).parent('td').next('td').children('label').hide();
                      $('#saveInventory').attr('disabled', false);
                    }else{
                      $(selector).parent('td').next('td').children('input').val('');
                      $('#saveInventory').attr('disabled', true);
                      $(selector).parent('td').next('td').children('label').text('Inventory not available in stock for this series. Please contact to central stock head').show();
                    }                                 
                }else{
                    if(data.errorCode == 'NO_STOCK')
                    {
                      $('#saveInventory').attr('disabled', true);
                      $(selector).parent('td').next('td').children('label').text('Inventory not available in stock for this series. Please contact to central stock head').show();
                    }
                }
            },
            error: function(data)
            {
                console.log(data);
            }
        });

  });

  $(document).on('change', '.end_sequence', function(){
        var selector = $(this);
        var items_id = $('#items_id').val();

        if(!items_id)
        {
            return alert('Please select an item');
        }
        var denom_id = $(selector).parent('td').prev('td').prev('td').prev('td').children('select').val();
        if(!denom_id)
        {
            return alert('Please select a denomination');
        }
        var series = $(selector).parent('td').prev('td').prev('td').children('select').val();

        if(!series)
        {
            return alert('Please select a valid series');
        } 

        var start_sequence = $(selector).parent('td').prev('td').children('input').val();

        var end_sequence = $(this).val();

        if(!end_sequence)
        {
            return alert('Please enter end sequence');
        }  

        if(parseInt(start_sequence) > parseInt(end_sequence))
        {
          $(this).val('');
          return alert('End sequence must be greater than start sequence!');
        }     

        var data =  {
                        _token: "{{csrf_token()}}",
                        items_id: items_id,
                        denom_id: denom_id,
                        series: series,
                        end_sequence: end_sequence
                    };

        $.ajax({
            url: "{{route('inventory.depotstock.validateendsequence')}}",
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function(response)
            {   
                var data = response;
                if(data.status == 'Ok')
                {
                    $('#saveInventory').attr('disabled', false);
                    $(selector).siblings('label').hide(); 
                    var start_sequence = $(selector).parent('td').prev().children('input').val();
                    var end_sequence = $(selector).val(); 
                    $(selector).parent('td').next().children('input').val(end_sequence-start_sequence+1);                                
                }else{
                    if(data.errorCode == 'NO_STOCK')
                    {
                      $('#saveInventory').attr('disabled', true);
                      $(selector).siblings('label').text('Inventory not available in stock for this series. Please contact to central stock head').show();
                    }
                    if(data.errorCode == 'NO_SERIES')
                    {
                      $('#saveInventory').attr('disabled', true);
                      $(selector).siblings('label').text('End sequence is beyond the stock end sequence. Please contact to admin.').show();
                    }
                }
            },
            error: function(data)
            {
                console.log(data);
            }
        });

  });


  $(document).on('keyup', '#quantity', function(){
        var items_id = $('#items_id').val();

        if(!items_id)
        {
            return alert('Please select an item');
        }
        var quantity = $('#quantity').val();
        if(!quantity)
        {
            return alert('Please enter quantity!');
        } 

        var data =  {
                        _token: "{{csrf_token()}}",
                        items_id: items_id,
                        quantity: quantity
                    };

        $.ajax({
            url: "{{route('inventory.depotstock.validatequantity')}}",
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function(response)
            {   
                var data = response;
                if(data.status == 'Ok')
                {
                    $('#saveInventory').attr('disabled', false);
                    $('#quantyty_errors').hide();                                 
                }else{
                    if(data.errorCode == 'NO_STOCK')
                    {
                      $('#saveInventory').attr('disabled', true);
                      $('#quantyty_errors').text('Inventory not available in stock. Please contact to central stock head').show();
                    }
                    if(data.errorCode == 'NO_SERIES')
                    {
                      $('#saveInventory').attr('disabled', true);
                      $('#quantyty_errors').text('End sequence is beyond the stock end sequence. Please contact to admin.').show();
                    }
                }
            },
            error: function(data)
            {
                console.log(data);
            }
        });

  });
  $(document).on('keyup', '.start_sequence', function(){
    var num = $(this).val();
    if(num == 0)
    {
        $(this).val('');
        return alert('Start Sequence can not be 0.');
    }
  });
</script>
@endpush

