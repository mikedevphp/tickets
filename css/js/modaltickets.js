$(document).ready(function()   
    {
             
        $('a[data-Aseguimiento]').on('click', function() 
        {
            
            showModalabrirTicket($(this));
        });
              
    });
            
               
   function showModalabrirTicket(data)
    {
        
        
        
       var date = new Date();
       var año = date.getFullYear();
       var mes = date.getMonth()+1;
       var dia = date.getDate();
       var hora = date.getHours();
       var minutos = date.getMinutes();
       var segundos = date.getSeconds();
        
      // variable que se insertara en la base de datos */
      var fechadata = año + '-' + (mes<10 ? '0'+mes : mes) + '-' + (dia<10 ? '0'+dia : dia) + ' '+
               (hora<10 ? '0'+hora: hora)+ ':' + (minutos<10 ? '0'+minutos:minutos) + ':' +
               (segundos<10 ? '0'+segundos:segundos); 
       // hora y fecha que se muestran en el modal
       var fechamodal = (dia<10 ? '0'+dia : dia)+'/'+(mes<10 ? '0'+mes : mes)+'/'+año; 
       var horamodal = (hora<10 ? '0'+hora: hora)+':'+(minutos<10 ? '0'+minutos:minutos)+' hrs';
       
    
    
    // mensaje que se muestra en el modal
    $('#myModalAbrir').find('.modal-body').append('<label>El ticket '+data.attr('data-idticket') +
       ' será abierto por el usuario "'+data.attr('data-user')+'" el día '+
       fechamodal +' a las '+ horamodal +'</label>');
       
       // se agregan al modal los input tipo hidden que sera recibidos por el controlador y que seran 
       // insertados en la base de datos
    $('#myModalAbrir').find('.modal-body').
            append('<input type="hidden" name="idTicket" value="'+data.attr('data-idticket')+'">');
    $('#myModalAbrir').find('.modal-body').
            append('<input type="hidden" name="idEmpleado" value="'+data.attr('data-idempleado')+'">');
    $('#myModalAbrir').find('.modal-body').
            append('<input type="hidden" name="fechaAbierto" value="'+fechadata+'">');
    $('#myModalAbrir').find('.modal-footer').append('<label class ="pull-left">'+data.attr('data-Aseguimiento')+'</label>');
    
        
        $('#myModalAbrir').on('hidden', function()
       {
           $('#myModalAbrir').find('label').remove();
           $('#myModalAbrir').find('hidden').remove();
            
       });
                
    }
    
    
    


