      $(document).ready(function(){	
     setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 1000000); // <-- time in milliseconds
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
 
   