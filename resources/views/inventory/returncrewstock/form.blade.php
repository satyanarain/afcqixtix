<div class="form-group" >
  <label class ='col-md-3 control-label'>Depots</label>
  <div class="col-md-7 col-sm-12 required">
    {!!Form::select('depot_id', $depots, isset($stock)?$stock->depot_id:null, ['placeholder'=>'Please select a depot', 'class'=>'form-control', 'id'=>'depot_id', 'required'])!!}
 </div>
</div>

<div class="form-group" >
  <label class ='col-md-3 control-label'>Crews</label>
  <div class="col-md-7 col-sm-12 required">
    {!!Form::select('crew_id', [], isset($stock)?$stock->crew_id:null, ['placeholder'=>'Please select a crew', 'class'=>'form-control', 'id'=>'crew_id', 'required'])!!}
  </div>

  <button type="button" style="margin-left: 10px;" class="btn btn-info" id="viewRemainingDetails">View Remaining Stock</button>
</div>

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
      {!! Form::text('remark', null, ['class' => 'col-md-6 form-control','required' => 'required']) !!}
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

<!-- show remaining inventory modal -->
  <div class="modal fade" id="remainingInventoryModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Remaining Inventory for <span id="remainingInventoryCrewName"></span></h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered" id="remainingInventoryTableBody">
            
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
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
        str += '<select class="form-control denom_id" name="denom_id[]" id="denom_id" required="">'
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
        str += '<input class="col-md-6 form-control end_sequence" style="width:75%;" required="required" name="end_sequence[]" type="text" onkeypress="return numvalidate(event)"><label class="end_sequence_errors label label-warning" style="display: none;word-wrap: break-word;"></label><button type="button" class="removeDenominationsRow btn btn-danger pull-right"><span class="fa fa-trash"></span></button>'
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
        var selector = $(this);
        var items_id = $('#items_id').val();

        if(!items_id)
        {
            return alert('Please select an item');
        }

        var denom_id = $(this).val();
        if(!denom_id)
        {
            return alert('Please select a denomination');
        }

        var depot_id = $('#depot_id').val();
        if(!depot_id)
        {
            return alert('Please select a depot');
        }

        var data =  {
                        _token: "{{csrf_token()}}",
                        items_id: items_id,
                        denom_id: denom_id,
                        depot_id: depot_id
                    };

        $.ajax({
            url: "{{route('inventory.crewstock.getseries')}}",
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

                      $(selector).parent('td').next('td').children('label').hide();
                    } else {
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

  $(document).on('blur', '.end_sequence', function(){
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

        var start_sequence = $(selector).parent('td').prev('td').children('select').val();

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

        var depot_id = $('#depot_id').val();
        if(!depot_id)
        {
            return alert('Please select a depot');
        }    

  });


  $(document).on('change', '#depot_id', function(){
      var depot_id = $(this).val();

      if(!depot_id)
      {
          return alert('Please select a valid depot');
      }

      var url = "{{route('inventory.crewstock.getdepotwisecrew', ':depotId')}}";

      url = url.replace(':depotId', depot_id);

      $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(response)
            {   
                var data = response;
                if(data.status == 'Ok')
                {
                    var crews = data.data;      
                    var options = "";
                    $.each(crews, function(index, crew){
                        options += '<option value="'+crew.id+'">'+crew.crew_name+'</option>'
                    });                           

                    $('#crew_id').html(options);
                }else{
                    
                }
            },
            error: function(data)
            {
                console.log(data);
            }
        });

  });

  $(document).on('blur', '.start_sequence', function(){
    var num = $(this).val();
    if(num == 0)
    {
        $(this).val('');
        return alert('Start Sequence can not be 0.');
    }
  });


  $(document).on('click', '#viewRemainingDetails', function(){
      var conductorId = $('#crew_id').val();
      var conductorName = $('#crew_id option:selected').text();
      //alert(conductorName);
      if(!conductorId)
      {
        return alert('Please select a crew.');
      }

      var url = "{{route('inventory.return.getremainingstockbycrew', ':conductorId')}}";
      url = url.replace(':conductorId', conductorId);

      $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        success: function(response, textStatus, xhr)
        {
          console.log(response);
          console.log(textStatus);
          console.log(xhr);
          var data = response.data;
          var str = '<tr><th>S. No.</th><th>Type</th><th>Quantity</th><th>Series</th><th>Start Sequence</th><th>Start Sequence</th></tr>';
          $.each(data, function(index, d){
            str += '<tr>'
            str += '<td>'+(index+1)+'</td>'
            str += '<td>'+d.description+'</td>'
            str += '<td>'+d.qty+'</td>'
            str += '<td>'+d.series+'</td>'
            str += '<td>'+d.start_sequence+'</td>'
            str += '<td>'+d.end_sequence+'</td>'
            str += '</tr>';
          });
          

          $('#remainingInventoryCrewName').text(conductorName);
          $('#remainingInventoryTableBody').html(str);
          $('#remainingInventoryModal').modal('show');
        },
        error: function(xmlHttpRequest, textStatus, errorThrown)
        {
          console.log(xmlHttpRequest);
          console.log(textStatus);

          if(errorThrown == 'Not Found')
          {
            $('#remainingInventoryCrewName').text(conductorName);
            $('#remainingInventoryTableBody').html('<p>No Inventory Found.</p>');
            $('#remainingInventoryModal').modal('show');
          }
        }
      })
  });
</script>
@endpush
