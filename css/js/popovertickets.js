$(document).ready(function() 
{ 
    
    popovers();
    
        
});

function popovers()
{
    $('a[detallesempleado]').popover({
                     title: '<b>Detalles del Ticket</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {

                         return '<div>\n\
                             <label><b><small>Ticket creado por el empleado: </b> </br>'+ $(this).attr('data-emp') + '</small></label>\n\
                             <label><b><small>Tipo de ticket: </b>'+ $(this).attr('data-catalogo')+ '</small></label>\n\
                             <label><b><small>Descripcion: </b>'+ $(this).attr('data-desc')+ '</small></label>\n\
                             <label><b><small>Prioridad: </b>'+ $(this).attr('data-prio')+ '</small></label>\n\
                             <label><b><small>Observaciones: </b>'+ $(this).attr('data-obs')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });

         $('a[detallesempleado1]').popover({
                     title: '<b>Detalles del Ticket</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {

                         return '<div>\n\
                             <label><b><small>Ticket creado por el empleado: </b> </br>'+ $(this).attr('data-emp') + '</small></label>\n\
                             <label><b><small>Tipo de ticket: </b>'+ $(this).attr('data-catalogo')+ '</small></label>\n\
                             <label><b><small>Descripcion: </b>'+ $(this).attr('data-desc')+ '</small></label>\n\
                             <label><b><small>Prioridad: </b>'+ $(this).attr('data-prio')+ '</small></label>\n\
                             <label><b><small>Observaciones: </b>'+ $(this).attr('data-obs')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });
         
         $('a[detallesempleado2]').popover({
                     title: '<b>Detalles del Ticket</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {
                         return '<div>\n\
                             <label><b><small>Tipo de ticket: </b>'+ $(this).attr('data-catalogo')+ '</small></label>\n\
                             <label><b><small>Descripcion: </b>'+ $(this).attr('data-desc')+ '</small></label>\n\
                             <label><b><small>Prioridad: </b>'+ $(this).attr('data-prio')+ '</small></label>\n\
                             <label><b><small>Observaciones: </b>'+ $(this).attr('data-obs')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });
       
         $('a[detallesempleado3]').popover({
                     title: '<b>Detalles del Ticket</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {
                         return '<div>\n\
                             <label><b><small>Tipo de ticket: </b>'+ $(this).attr('data-catalogo')+ '</small></label>\n\
                             <label><b><small>Descripcion: </b>'+ $(this).attr('data-desc')+ '</small></label>\n\
                             <label><b><small>Prioridad: </b>'+ $(this).attr('data-prio')+ '</small></label>\n\
                             <label><b><small>Observaciones: </b>'+ $(this).attr('data-obs')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });
         
         $('a[detallesempresa]').popover({
                     title: '<b>Detalles de la empresa</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {

                         return '<div>\n\
                             <label><b><small>Sucursal: </b>'+ $(this).attr('data-sucursal')+ '</small></label>\n\
                            <label><b><small>Nombre sucursal: </b>'+ $(this).attr('data-sucursal')+ '</small></label>\n\
                            <label><b><small>Ciudad: </b>'+ $(this).attr('data-ciudad')+ '</small></label>\n\
                            <label><b><small>Colonia sucursal: </b>'+ $(this).attr('data-colonia')+ '</small></label>\n\
                             <label><b><small>Direccion sucursal: </b>'+ $(this).attr('data-dirsuc')+ '</small></label>\n\
                             <label><b><small>Telefono sucursal: </b>'+ $(this).attr('data-telsuc')+ '</small></label>\n\
                             <label><b><small>Celular sucursal: </b>'+ $(this).attr('data-cel')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });

         $('a[detallesempresa1]').popover({
                     title: '<b>Detalles de la empresa</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {

                         return '<div>\n\
                             <label><b><small>Ciudad: </b>'+ $(this).attr('data-ciudad') + '</small></label>\n\
                            <label><b><small>Colonia: </b>'+ $(this).attr('data-colonia') + '</small></label>\n\
                            <label><b><small>Dirección: </b>'+ $(this).attr('data-dir') + '</small></label>\n\
                             <label><b><small>Telefono: </b>'+ $(this).attr('data-tel')+ '</small></label>\n\
                            <label><b><small>Celular: </b>'+ $(this).attr('data-cel')+ '</small></label>\n\
                             <label><b><small>Email: </b>'+ $(this).attr('data-email')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });
         
         $('a[detallesempresa2]').popover({
                     title: '<b>Detalles de la empresa</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {
                         return '<div>\n\
                             <label><b><small>Sucursal: </b>'+ $(this).attr('data-sucursal')+ '</small></label>\n\
                            <label><b><small>Nombre sucursal: </b>'+ $(this).attr('data-sucursal')+ '</small></label>\n\
                            <label><b><small>Ciudad: </b>'+ $(this).attr('data-ciudad')+ '</small></label>\n\
                            <label><b><small>Colonia sucursal: </b>'+ $(this).attr('data-colonia')+ '</small></label>\n\
                             <label><b><small>Direccion sucursal: </b>'+ $(this).attr('data-dirsuc')+ '</small></label>\n\
                             <label><b><small>Telefono sucursal: </b>'+ $(this).attr('data-telsuc')+ '</small></label>\n\
                            <label><b><small>Celular sucursal: </b>'+ $(this).attr('data-cel')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });
       
         $('a[detallesempresa3]').popover({
                     title: '<b>Detalles de la empresa</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {
                         return '<div>\n\
                            <label><b><small>Ciudad: </b>'+ $(this).attr('data-ciudad') + '</small></label>\n\
                            <label><b><small>Colonia: </b>'+ $(this).attr('data-colonia') + '</small></label>\n\
                            <label><b><small>Dirección: </b>'+ $(this).attr('data-dir') + '</small></label>\n\
                             <label><b><small>Telefono: </b>'+ $(this).attr('data-tel')+ '</small></label>\n\
                            <label><b><small>Celular: </b>'+ $(this).attr('data-cel')+ '</small></label>\n\
                             <label><b><small>Email: </b>'+ $(this).attr('data-email')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });
         
         $('a[detallesclientes]').popover({
                     title: '<b>Detalles del Ticket</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {
                         return '<div>\n\
                             <label><b><small>Tipo de ticket: </b>'+ $(this).attr('data-catalogo')+ '</small></label>\n\
                             <label><b><small>Descripcion: </b>'+ $(this).attr('data-desc')+ '</small></label>\n\
                             <label><b><small>Prioridad: </b>'+ $(this).attr('data-prio')+ '</small></label>\n\
                             <label><b><small>Observaciones: </b>'+ $(this).attr('data-obs')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });
         
         $('a[detallesclientes1]').popover({
                     title: '<b>Detalles del Ticket</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {

                         return '<div>\n\
                             <label><b><small>El ticket fue creado por el tecnico: </br></b>'+ $(this).attr('data-emp') + '</small></label>\n\
                             <label><b><small>Tipo de ticket: </b>'+ $(this).attr('data-catalogo')+ '</small></label>\n\
                             <label><b><small>Descripcion: </b>'+ $(this).attr('data-desc')+ '</small></label>\n\
                             <label><b><small>Prioridad: </b>'+ $(this).attr('data-prio')+ '</small></label>\n\
                             <label><b><small>Observaciones: </b>'+ $(this).attr('data-obs')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });
         
         $('a[detallesclientes2]').popover({
                     title: '<b>Detalles del Ticket</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {

                         return '<div>\n\
                             <label><b><small>Sucursal: </b>'+ $(this).attr('data-sucursal') + '</small></label>\n\
                             <label><b><small>Tipo de ticket: </b>'+ $(this).attr('data-catalogo')+ '</small></label>\n\
                             <label><b><small>Descripcion: </b>'+ $(this).attr('data-desc')+ '</small></label>\n\
                             <label><b><small>Prioridad: </b>'+ $(this).attr('data-prio')+ '</small></label>\n\
                             <label><b><small>Observaciones: </b>'+ $(this).attr('data-obs')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });
         
         $('a[detallesclientes3]').popover({
                     title: '<b>Detalles del Ticket</b>',
                     trigger: 'hover',
                     html: true,
                     content: function()
                     {

                         return '<div>\n\
                             <label><b><small>El ticket fue creado por el tecnico: </br></b>'+ $(this).attr('data-emp') + '</small></label>\n\
                             <label><b><small>Sucursal: </b>'+ $(this).attr('data-sucursal') + '</small></label>\n\
                             <label><b><small>Tipo de ticket: </b>'+ $(this).attr('data-catalogo')+ '</small></label>\n\
                             <label><b><small>Descripcion: </b>'+ $(this).attr('data-desc')+ '</small></label>\n\
                             <label><b><small>Prioridad: </b>'+ $(this).attr('data-prio')+ '</small></label>\n\
                             <label><b><small>Observaciones: </b>'+ $(this).attr('data-obs')+ '</small></label>\n\
                         </div>'

                 ;},
             placement: 'right'
         });
}

