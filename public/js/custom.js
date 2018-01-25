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
       
 $(document).ready(function(){	
	$("ul.list-group-order").sortable({		
		update: function( event, ui ) {
			updateOrder();
		}
	});  
        
       setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 1000); // <-- time in milliseconds 
        
});
function updateOrder() {	
	var item_order = new Array();
	$('ul.list-group-order li').each(function() {
		item_order.push($(this).attr("id"));
	});
	var order_string = item_order;
	$.ajax({
		type: "GET",
		url: "/bus_types/sort_order/"+order_string,
		data: order_string,
		cache: false,
		success: function(data){
                  $("#successMessage_order").show();
                  $("#success_order").html("Order Number Updated successfully.");
                  $("#example1").html(data);
                  setTimeout(function() {
                  $('#successMessage_order').fadeOut('fast');
        }, 5000); // <-- time in milliseconds 
		}
	});
}  

   