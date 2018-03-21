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
