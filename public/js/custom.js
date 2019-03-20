$(document).on('click', '.get_abstract_detail', function(){
    var depot_id = $('#depot_id').val();
    var abstract_no = $('#abstract_no').val();
    if(abstract_no)
    {
        jQuery.ajax({
         url: "/waybills/getabstractdetail",
         type: "POST",
         data: {
             "depot_id"    : depot_id,
             "abstract_no"   : abstract_no
         },
         headers: {
             "x-access-token": window.Laravel.csrfToken
         },
         contentType: "application/x-www-form-urlencoded",
         cache: false
     })
        .done(function(data, textStatus, jqXHR) {
         var data = JSON.parse(data);
         //alert(data.conductor_name);
        if(data.status=="error")
        {
            $('.cash-collection-error').html(data.message);
            $('.cash-collection-error').removeClass('hide');
        }else{
            $('#conductor_name').val(data.conductor_name);
            $('#conductor_id').val(data.conductor_id);
            $('#amount_payable').val(data.amount_payable);
            $('#route_duty').val(data.route_id+'/'+data.duty_id);
            $('.cash-collection-error').addClass('hide');
            $('.btn-success').prop("disabled", false); 
            $('#abstract_no').prop("readonly",true);
            //$('#depot_id').attr("disabled",true);
        }
     })
        .fail(function(jqXHR, textStatus, errorThrown) {
         $("#"+ele).empty();
         $("#"+ele).append('<option value="">No Record Found</option>');
     })
    }else{
        $('.cash-collection-error').html('Please enter abstract number.');
        $('.cash-collection-error').removeClass('hide');
    }
  });

function showHide(id) {

    	var ele = document.getElementById("form"+id);

    	var text = document.getElementById("plusminusbutton"+id);

    	if(ele.style.display == "block") {

        		ele.style.display = "none";

    		text.innerHTML = "+";

      	}

    	else {

    		ele.style.display = "block";

    		text.innerHTML = "-";
}
} 

$(document).ready(function(){	
     setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
      });
$(document).ready(function(){	
     setTimeout(function() {
          $('#error_message_red').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
      });
      
function findDuty(id)
 {
 if(id!='')    
 {   
  $.ajax({
   type:"GET",
   url:"/targets/getduties/"+id,
   success:function(data)
   {
     //  alert(data);
    $("#duty").show();  
    $("#duty").html(data);
       
   }
   }) ;
 }else
 {
   $("#duty").hide();    
 }
   
 }
 
 function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
 function isIntegerKey(evt)
       {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
       
       
 }  
       
       
       
       
       
  function AddNewShow(table_name,field_name,placeholder)
{
 $("#table_name").val(table_name); 
 $("#field_name").val(field_name); 
 $("#placeholder").val(placeholder); 
$("#common_details").modal('show');
  $("#name").val('');
 }
 
 /************************************************************************************/
  function AddDepot(depots)
{
$("#"+depots).modal('show');
$("#name").val('');
  
}
 
 
 
 
 
   function AddNew()
{
var table_name = $("#table_name").val();
var field_name = $("#field_name").val();
var name = $("#name").val();
var placeholder = $("#placeholder").val();
var string_length="&table_name="+table_name+"&field_name="+field_name+"&placeholder="+placeholder+"&name="+name;
 $.ajax({
   type:"post",
   url:'/denominations/add_new',
    data:string_length,
        success: function (data)
        {
           if(data==1)
           {
              $("#add_new_data_danger").show();
              $("#add_new_data_danger").html("This record already exists! Please select another."); 
              $("#add_new_data").hide();
           }else{
            $("#add_new_data").show();
             $("#add_new_data_danger").hide();
            $("#add_new_data").html("Record Updated Successfully.");
            $("#denomination_masters").html(data);
            setTimeout(function () {
                $('#add_new_data').fadeOut('fast');
            }, 5000); // <-- time in milliseconds  
        }
        }
  })  
    
    
}

function formValidation(){
var tm = document.voiceavpn.time;
if(validateTime(tm)){
}
return false;
}

function validateTime(tm){
var newreg =  /^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$/;
 if(tm.exec(newreg)){
        alert("Invalid time format\n The valid format is hh:mm\n");
        return false;
        }
        return true;
}


function fillDropdown(ele,table,column,dropdown)
{
     //console.log(ele,table,column,);return;
     
     var id = $('#'+dropdown).val();
     jQuery.ajax({
         url: "/waybills/getdata/"+id,
         type: "POST",
         data: {
             "table"    : table,
             "column"   : column,
             "id"       : id,
             "ele"       : ele,
             "dropdown"       : dropdown,
         },
         headers: {
             "x-access-token": window.Laravel.csrfToken
         },
         contentType: "application/x-www-form-urlencoded",
         cache: false
     })
     .done(function(data, textStatus, jqXHR) {
         $("#"+ele).empty();
         $("#"+ele).append('<option value="">Select</option>');
         jQuery.each(data.data, function( i, val ) {
             console.log(val);
             console.log(column);
            $("#"+ele).append(
                '<option value="'+val.id+'">'+val.name+'</option>'
            )
        });
         //$("#duty").show();  
          //$("#duty").html(data);
     })
     .fail(function(jqXHR, textStatus, errorThrown) {
         $("#"+ele).empty();
         $("#"+ele).append('<option value="">No Record Found</option>');
     })
}

function fillTripDropdown(route_master_id,duty_id)
{
     var shift_id = $('#shift_id').val();
     jQuery.ajax({
         url: "/targets/gettriplist",
         type: "POST",
         data: {
             "route_master_id"    : route_master_id,
             "duty_id"   : duty_id,
             "shift_id"       : shift_id,
         },
         headers: {
             "x-access-token": window.Laravel.csrfToken
         },
         contentType: "application/x-www-form-urlencoded",
         cache: false
     })
     .done(function(data, textStatus, jqXHR) {
         $("#trip_id").empty();
         $("#trip_id").append('<option value="">Select Trip</option>');
         jQuery.each(data.data, function( i, val ) {
            $("#trip_id").append(
                '<option value="'+val.trip_no+'">'+val.trip_no+'</option>'
            )
        });
     })
     .fail(function(jqXHR, textStatus, errorThrown) {
         $("#trip_id").empty();
         $("#trip_id").append('<option value="">No Record Found</option>');
     })
}