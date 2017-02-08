  <script type="text/javascript">
    $(document).ready(function()
    {
        
        $('#pagtickets ul li a').click(function(e)
            {
                e.preventDefault();
               
               var link = $(this).text();
               url = $(this).attr('href').split('/');
               
               var  empresa = ($('#clientestickets').val()=== -1) ? -1: $('#clientestickets').val();
                
               var sucursal;
               
               if($('#sucursalestickets').val()=== " " || $('#sucursalestickets').val()=== "nada")
               {
                    sucursal = " ";
               }
               
                if($('#sucursalestickets').val() !== " ")
               {
                   sucursal = $('#sucursalestickets').val();
               }
               
                 
               
               var ticket = ($('#tipoticket').val()=== 0) ? 0 : $('#tipoticket').val();
               var status = ($('#tipostatus').val()=== 0) ? 0 : $('#tipostatus').val();
               var prioridad = ($('#tipoprioridad').val()=== 0)? 0 :$('#tipoprioridad').val();
               
               $.post('<?php echo base_url('index.php/tickets/getTicketsAjax')?>',
                {
                    url : url[6],
                    empresa : empresa,
                    sucursal :sucursal,
                    ticket : ticket,
                    status : status,
                    prioridad : prioridad
                    
                }, function(data)
                {
                    
                   $('#tablatickets').html(data);
                   
 
                }).done(function()
                {       
                        tooltips();
                        popovers();
                     
                    $('#pagtickets ul li:contains("'+link+'")').removeClass('page').addClass('active');
                    $('#pagtickets ul li:not(:contains("'+link+'"))').removeClass('active').addClass('page');
                        
                    $('a[data-accion]').click(function() 
                    {
                        showModalPrincipal($(this));
                    });
                        
                    $('a[data-Aseguimiento]').on('click', function() 
                    {
                        showModalabrirTicket($(this));
                    });
                    
                    $('a[comments]').click(function() 
                    {
                        var data = {idticket:$(this).attr('data-idticket'), 
                            empticketabierto:$(this).attr('data-empticketabierto'),
                            fechaabierto:$(this).attr('data-fechaabierto')};
   
                        idticket = $(this).attr('data-idticket');
             
                        $.post('<?php echo base_url("/index.php/tickets/notasseguimientotickets");?>', 
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
                    
                    $('a[data-cerrado]').click(function() 
                    {        
                        showModalCerrado($(this));
                    });
                    
                    
                });
            });
            
        $('#notificaciones').click(function()
        {
            
           var link = $(this).text();
               url = $(this).attr('href').split('/');
               
               var  empresa = ($('#clientestickets').val()=== -1) ? -1: $('#clientestickets').val();
                
               var sucursal;
               
              /* if($('#sucursalestickets').val()=== " " || $('#sucursalestickets').val()=== "nada")
               {
                    sucursal = " ";
               }*/
               
                sucursal = " ";
               
                /*if($('#sucursalestickets').val() !== " ")
               {
                   sucursal = $('#sucursalestickets').val();
               }*/
                sucursal = $('#sucursalestickets').val();
                 
               
              /* var ticket = ($('#tipoticket').val()=== 0) ? 0 : $('#tipoticket').val();
               var status = ($('#tipostatus').val()=== 0) ? 0 : $('#tipostatus').val();
               var prioridad = ($('#tipoprioridad').val()=== 0)? 0 :$('#tipoprioridad').val();*/
               var ticket = 0;
               var status = 0;
               var prioridad = 0;
               
               $.post('<?php echo base_url('index.php/tickets/getTicketsAjax')?>',
                {
                    url : 0,
                    empresa : empresa,
                    sucursal :sucursal,
                    ticket : ticket,
                    status : status,
                    prioridad : prioridad
                    
                }, function(data)
                {
                    
                   $('#tablatickets').html(data);
                   $('#nums').text(0);
                   
                   
                   var time = $('#tablatickets tbody tr:first');
                   if($('#clienteTickets').val() === "SI")
                   {
                       $('#ticketTimeLast').val(time[0].childNodes[1].textContent);
                   }
                   else
                   {
                       $('#ticketTimeLast').val(time[0].childNodes[2].textContent);
                   }   
                   
                   //console.log(time[0].childNodes[2].textContent);
                   
 
                }).done(function()
                {       
                        tooltips();
                        popovers();
                     
                    $('#pagtickets ul li:contains("'+link+'")').removeClass('page').addClass('active');
                    $('#pagtickets ul li:not(:contains("'+link+'"))').removeClass('active').addClass('page');
                        
                    $('a[data-accion]').click(function() 
                    {
                        showModalPrincipal($(this));
                    });
                        
                    $('a[data-Aseguimiento]').on('click', function() 
                    {
                        showModalabrirTicket($(this));
                    });
                    
                    $('a[comments]').click(function() 
                    {
                        var data = {idticket:$(this).attr('data-idticket'), 
                            empticketabierto:$(this).attr('data-empticketabierto'),
                            fechaabierto:$(this).attr('data-fechaabierto')};
   
                        idticket = $(this).attr('data-idticket');
             
                        $.post('<?php echo base_url("/index.php/tickets/notasseguimientotickets");?>', 
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
                    
                    $('a[data-cerrado]').click(function() 
                    {        
                        showModalCerrado($(this));
                    });
                    
                    
                });  
        });
        
            
    
    
        (function poll() 
        {
            setTimeout(function() 
            {
                $.post('<?php echo base_url('index.php/tickets/lastTicketCreated')?>',
                {
                    ticketLastTime : $('#ticketTimeLast').val(),
                    nums: $('#nums').text()
                    
                }, function(data)
                {
                    
                    $('#nums').text(data);
                    var pag = document.getElementById('pagtickets');
                    if(pag !== null)
                    {
                        if(pag.children[0].children[0].className === 'active')
                        {
                            console.log('voy a actualzar la tabla');
                        }
                        
                    }
                    console.log(data);
                    
                   //$('#tablatickets').html(data);
                   
                }).done(function()
                {
                    poll();
                });

             }, 10000);

        })();
    
    });
         
  
</script>

   <div class="row-fluid">
        <?php 
           if($this->session->flashdata('no_registros_tickets'))
            {
                print $this->session->flashdata('no_registros_tickets');
            }
            
            if($this->session->flashdata('detalles_seguimiento_requerido'))
            {
                print $this->session->flashdata('detalles_seguimiento_requerido');
            }
            
            if($this->session->flashdata('nota_conclusion_requerido'))
            {
                print $this->session->flashdata('nota_conclusion_requerido');
            }
            
            if($this->session->flashdata('status_abierto'))
            {
                print $this->session->flashdata('status_abierto');
            }
            
           if($this->session->flashdata('status_error_abierto'))
            {
                print $this->session->flashdata('status_error_abierto');
            }
            
            if($this->session->flashdata('status_seguimiento'))
            {
                print $this->session->flashdata('status_seguimiento');
            }
            
            if($this->session->flashdata('status_error_seguimiento'))
            {
                print $this->session->flashdata('status_error_seguimiento');
            }
            
            if($this->session->flashdata('ticket_cerrado'))
            {
                print $this->session->flashdata('ticket_cerrado');
            }
            
            if($this->session->flashdata('ticket_error_cerrado'))
            {
                print $this->session->flashdata('ticket_error_cerrado');
            }
            
            if($this->session->flashdata('correcto_ticket'))
            {
                print $this->session->flashdata('correcto_ticket');
            }
       ?>
    </div>

       
    
         
                
    <div class="row-fluid">
    <?php 

            if(isset($tickets))
            {
                require ($_SERVER['DOCUMENT_ROOT']."/application/core/Tabla.php");
                $tabla = new Tabla();
                $tabla->crearTabla($tickets, $this->user, $pagination);
            }
            ?>
           
   </div>


