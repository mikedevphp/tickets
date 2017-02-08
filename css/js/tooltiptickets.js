$(document).ready(function()
{
      
           tooltips();
       
       
       
    });
    
    function tooltips()
    {
       
         $('a[tooltipemp]').tooltip({
                         html: true,
                         trigger: 'hover',
                         placement: 'right'

                         });
         
        
    
      $('a[tooltipcomments]').tooltip({

                                    html: true,
                                    title: '<p class="text-center"><b>Ticket En progreso.</b>\n\
                                            Aqui puede ver información  del seguimiento de su ticket</p>',
                                    trigger: 'hover',
                                    placement: 'right'
   
                                    });
      
    
        $('a[tooltipopen]').tooltip({

                                    html: true,
                                    title: '<p class="text-center"><b>Ticket Abierto.</b>\n\
                                           En espera para darle el seguimiento correspondiente</p>',
                                    trigger: 'hover',
                                    placement: 'right'
                                    });
    
     
                                    
        $('a[tooltipclose]').tooltip({

                                    html: true,
                                    title: '<p class="text-center"><b>Ticket Cerrado.</b>\n\
                                           Aqui puede ver información relacionada con el cierre de su ticket</p>',
                                    trigger: 'hover',
                                    placement: 'right'
                                    });  ;
    }

