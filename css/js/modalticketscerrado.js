$(document).ready(function() 
    
    {
	$('a[data-cerrado]').click(function() 
        {        
           showModalCerrado($(this));
          
	});

    });

    function usuarioactual(usuarioActual, usuarioAnterior)
    
    {
       var usuario = (usuarioActual === usuarioAnterior ? '<b> Usted</b>' : 
               ' El usuario <b>'+usuarioAnterior+'</b>'); 
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
    
    function mostrarComentarios(datanotas, modal)
    {
        var arr = [];
           var i = 0;
            
            for(row in datanotas)
                {      
                   var fecha = formatFecha(datanotas[row].fecha_seguimiento);
                   arr.push( 
                           '<label style = padding:"8px" class ="alert alert-info"><b>El dia '+ fecha[0]+ ' a las '+ fecha[1] +' '+
                           datanotas[row].userEmpleado +' actualizó:</b></br>'+ datanotas[row].detalles_seguimiento+'</label>'
                           );
                    modal.after(arr[i]); 
                    i++;
                }  
    }
    
    
    
function showModalCerrado(data)
{
    
    $('#ticketCerradoModal').find('#buttonComments').show();
    $('#ticketCerradoModal').find('#closeButtonComments').hide();
    
    var stringFecha = formatFecha(data.attr('data-fechacerrado'));
    
    
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
        
    
    $('#ticketCerradoModal').find('#buttonComments').before('<label style= margin-bottom:5px class="alert alert-warning"><center>El ticket '+data.attr('data-idticket')+
               ' fue cerrado a las '+ stringFecha[1]+' el día '+ stringFecha[0]+' </center></label>');
       
    
 
 
       
 
        $('#ticketCerradoModal').find('#buttonComments').click(function()
         {  
            $('#ticketCerradoModal').find('#closeButtonComments').show();
            
            
            
            if(comments !== null)
            {
                 mostrarComentarios(comments, $('#ticketCerradoModal').find('#closeButtonComments'));  
            }
                
            else
            {
                $('#ticketCerradoModal').find('#closeButtonComments')
                .after('<label style = padding:"8px" class ="alert alert-info"><b>No se hicieron comentarios</b></label>');
            }
            $('#ticketCerradoModal').find('.alert-info:last').after('<label class ="alert alert-warning"><b>'+
            usuarioactual(data.attr('data-user'),data.attr('data-empticketcerrado'))+
         ' cerró el incidente : </b></br>'+ data.attr('data-detallescerrado')+'</label>');
            $(this).hide();
    
         });
         
         $('#ticketCerradoModal').find('#closeButtonComments').click(function()
          {   
            $('#ticketCerradoModal').find('#buttonComments').show();
            $('#ticketCerradoModal').find('label.alert-info').remove();
            $('#ticketCerradoModal').find('label.alert-warning:not(:first)').remove();
            $(this).hide();
            
          });
          
        $('#ticketCerradoModal').on('hidden', function()
        {
            $('#ticketCerradoModal').find('label').remove();
            
           comments = {}; 
        });
         
}


