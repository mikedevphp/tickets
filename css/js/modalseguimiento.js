$(document).ready(function()  
    {
	$('a[data-accion]').click(function() {
                  
           showModalPrincipal($(this));
 
	});

    });
    
    
    function getTiempo(fechadata)
    {
               
        var date = new Date();
        var año = date.getFullYear();
        var mes = date.getMonth()+1;
        var dia = date.getDate();
        var hora = date.getHours();
        var minutos = date.getMinutes();
         var segundos = date.getSeconds();

         var data;
         // variable que se insertara en la base de datos */

         switch(fechadata) 
         {
             case 'datos':

                data = año + '-' + (mes<10 ? '0'+mes : mes) + '-' + (dia<10 ? '0'+dia : dia) + ' '+
                (hora<10 ? '0'+hora: hora)+ ':' + (minutos<10 ? '0'+minutos:minutos) + ':' +
                (segundos<10 ? '0'+segundos:segundos);
                 return data;
                 break;

            case 'dia':

                data = (dia<10 ? '0'+dia : dia)+'/'+(mes<10 ? '0'+mes : mes)+'/'+año;
                return data;
                break;

            case 'hora':

                data = (hora<10 ? '0'+hora: hora)+':'+(minutos<10 ? '0'+minutos:minutos)+' hrs'; 
                return data;
                break;

         }
            
             
    }
            
    function showModalPrincipal(data)
    {

       var fechadatos = getTiempo('datos');    // fecha que se insertara en la base de datos
    
        // modal de cierre de ticket
        $('#modalTicketsCerrar').click(function()
        {
            $('#segConfirmModal').modal('hide');
            $('#cerrarModalTicket').find('.modal-body').html('<label class ="text-left"><small><b>Motivo del cierre del ticket</b></small></label> \n\
                <textarea name ="notaConclusion" style = "resize: none; width: 510px; height: 80px"></textarea>\n\
                <input type="hidden" name="idTicketCer" value="'+data.attr('data-idticket')+'">\n\
                <input type="hidden" name="idEmpleadoCer" value="'+data.attr('data-idempleado')+'">\n\
            <input type="hidden" name="fechaCerrar" value="'+fechadatos+'">');
            
        }); 
    
        // modal de actualizacion del ticket
        $('#modalTicketsActualizar').click(function()
        {
 
          $('#segConfirmModal').modal('hide');
          $('#segCommentsModal').find('.modal-body').html('<label class ="text-left"><small><b>Actualización del incidente</b></small></label>\n\
            <textarea name ="seguimientoNota" style = "resize:none; width:510px; height:80px"></textarea>\n\
            <input type="hidden" name="idTicketSeg" value="'+data.attr('data-idticket')+'">\n\
            <input type="hidden" name="idEmpleadoSeg" value="'+data.attr('data-idempleado')+'">\n\
            <input type="hidden" name="fechaSeguimiento" value="'+fechadatos+'">');
        });
        
  
       $('#segConfirmModal').on('hidden', function()
       { 
            $('#segConfirmModal').find('label').remove();
            comments = {};
            
       });

        $('#segConfirmModal').find('#buttonComments').show();
      var comments = {};
       
       
        $.post(window.location.origin+"/index.php/tickets/notasseguimientotickets", 
                        {
                            idticket : data.attr('data-idticket')
                        }, 
                       function(notas) 
                        {                         
                         comments = notas;
                        },'json').fail(function()
                        {
                           comments = null ;
                        });
           
       
    var stringFecha = formatFecha(data.attr('data-fechaabierto'));
    
    // mensaje que se muestra en el modal
   
    $('#buttonComments').before('<label style= margin-bottom:5px class ="alert alert-success">"El ticket <b>'
         +data.attr('data-idticket')+'</b>'+ ' fue abierto por '+usuarioActual(data.attr('data-user'),data.attr('data-empticketabierto'))+
         ' el día '+stringFecha[0]+ ' a las '+ stringFecha[1]+'"</label>');
        
    $('#segConfirmModal').find('#closeButtonComments').hide();
    
    $('#segConfirmModal').find('#buttonComments').click(function()
         {  
            $('#segConfirmModal').find('#closeButtonComments').show();
            
            if(comments !== null)
            {
                
                 mostrarComentarios(comments, $('#segConfirmModal').find('#closeButtonComments')); 
            }
                
            else if(comments === null)
            {
                $('#closeButtonComments')
                .after('<label style = padding:"8px" class ="alert alert-info"><b>No se han hecho comentarios</b></label>');
            }
            
            $(this).hide();
    
         });
         
         $('#segConfirmModal').find('#closeButtonComments').click(function()
          {      
            $('#segConfirmModal').find('#buttonComments').show();
            $('#segConfirmModal').find('label.alert-info').remove();
            $(this).hide();
            
          });
    }
 
    function Comentarios(datanotas, modal,user)
    {
        var arr = [];
           var i = 0;
        
        for(row in datanotas)
            {      

               arr.push( 
                       '<label style = padding:8px class ="alert alert-info"><b>A las '+ datanotas[row].fecha_seguimiento+' '+
                      usuarioActual(user, datanotas[row].userEmpleado) +' actualizó:</b></br>'+ datanotas[row].detalles_seguimiento+'</label>'
                       );
                modal.find('.modal-body').append(arr[i]); 
                i++;
            }  
        
    }
    
    function usuarioActual(usuarioActual, usuarioAnterior)
    {
       var usuario = (usuarioActual === usuarioAnterior ? '<b> usted</b>' : 
               ' el usuario <b>'+usuarioAnterior+'</b>'); 
       return usuario;
    }
    
    function formatFecha(fecha)
    {
        var finalFecha= [];
        var horaFecha = fecha.split(' ');
        var fecha = horaFecha[0].split('-');
        
        var fechaobj = {dia:fecha[2], mes:fecha[1], año:fecha[0]};
        finalFecha[0] = fechaobj.dia+'-'+fechaobj.mes+'-'+fechaobj.año;
        finalFecha[1] = horaFecha[1];
        return finalFecha;
    }
    
   
    
    
    
