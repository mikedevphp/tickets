$(document).ready(function() 
    {
       
	$('a[comments]').click(function() 
        {
                var data = {idticket:$(this).attr('data-idticket'), 
                            empticketabierto:$(this).attr('data-empticketabierto'),
                            fechaabierto:$(this).attr('data-fechaabierto')};
   
                 idticket = $(this).attr('data-idticket');
             
                    $.post(window.location.origin+"/index.php/tickets/notasseguimientotickets", 
                        {
                            idticket : idticket
                        }, 
                        function(notas) 
                        {   
                           showModalComments(data,notas);
                            
                        },'json').fail(function()
                    {
                        notas = null;
                        showModalComments(data,notas);
                        
                    });
 
	});

        
    });
    
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
    
    function Comentarios(datanotas, modal)
    {
        var arr = [];
           var i = 0;
            
            for(row in datanotas)
                {      
                   var fecha = formatFecha(datanotas[row].fecha_seguimiento);
                   arr.push( 
                           '<label style = padding:"8px" class ="alert alert-info"><b>El dia '+ fecha[0]+ ' a las '+ fecha[1] +' '+
                           datanotas[row].userEmpleado +' comentó:</b></br>'+ datanotas[row].detalles_seguimiento+'</label>'
                           );
                    modal.find('.modal-body').append(arr[i]); 
                    i++;
                }  
    }
    
    function showModalComments(data,datanotas)
    {
        $('body').append(
        '<div id="commentsModal" class="modal hide fade" role="dialog" aria-labelledby="dataConfirmLabel"\n\
                                                 aria-hidden="true">\n\
                    <div class="modal-header">\n\
                        <h4 id="dataConfirmLabel">Mensaje de la aplicación</h4>\n\
                    </div>\n\
                    <div class="modal-body">\n\
                    </div>\n\
                     <div class="modal-footer"> \n\
                        <button class="btn btn-info" data-dismiss="modal">Cerrar</button>\n\
                     </div>\n\
                </div>');
        
                        
                        
            var stringFecha = formatFecha(data.fechaabierto);
            
         $('#commentsModal').find('.modal-body').append('<label class ="alert alert-success">"El ticket <b>'
         +data.idticket+'</b>'+ ' fue abierto por '+data.empticketabierto+
         ' el día '+stringFecha[0]+ ' a las '+ stringFecha[1]+'"</label>');
            
            if(datanotas===null)
                {
              $('#commentsModal').find('.modal-body').append('<label style = padding:"8px" class ="alert alert-info">\n\
                <b>No se han hecho comentarios</b></label>');
                }
         Comentarios(datanotas, $('#commentsModal'));
            
            $('#commentsModal').modal('show');
            
            $('#commentsModal').on('hidden', function()
              {
                $('body').find('#commentsModal').remove();

            });
            
        
    }

