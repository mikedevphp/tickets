
$(document).ready(function() 
{
    
    
$('a[empresas]').popover
(
        {
                     title: '<b>Detalles de la empresa</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {
                       
                         return '<div>\n\
                            <label><b><small>Nombre de usuario: </b>'+ $(this).attr('username') +'</small></label>\n\
                            <label><b><small>Ciudad: </b>'+ $(this).attr('ciudad') +'</small></label> \n\
                            <label><b><small>Colonia/Fracc: </b>'+ $(this).attr('fracc') +'</small></label>\n\
                            <label><b><small>Calle: </b>'+ $(this).attr('direccion') +'</small></label>\n\
                            <label><b><small>Teléfono: </b>'+ $(this).attr('telefono')+'</small></label>\n\
                            <label><b><small>Celular: </b>'+ $(this).attr('cel') +'</small></label>                            \n\
                            <label><b><small>Email: </b>'+ $(this).attr('email')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });

});
