/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function()
{
	
	var num = 0;
           (function poll() 
            {
            	    
	            setTimeout(function() 
	            {
                        //poner la base_url sel proyecto
	                $.post('',
	                {
	                    ticketLastTime : $('#ticketLastTime').val(),
	                    nums: num
	                    
	                }, function(data)
	                {
	                 
	                 
	                    
	                    if(data > num)
	                    {
	                    	$.notify("Se ha creado un nuevo ticket.",{ position:"left bottom", className: "success",  autoHide: false});
	                    	num = data;
	                    }
	                    
	                    
	                    console.log(num);
	                   //$('#tablatickets').html(data);
	                   
	                   
	 
	                }).done(function()
	                {
	                    poll();
	                });
	
	             }, 10000);

            })();

        
});