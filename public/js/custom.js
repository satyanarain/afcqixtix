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
 
 