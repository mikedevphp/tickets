<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/cupertino/jquery-ui.css">


<script type="text/javascript" src="<?php echo base_url('css/js/jquery-1.9.1.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('css/js/jquery-ui.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('css/js/Chart.js');?>"></script>
<script>
    var base_url = window.location.origin+'/index.php/';
    var xhrPost;
    // español
    $.datepicker.regional['es'] = {
                        closeText: 'Cerrar',
                        prevText: '<Ant',
                        nextText: 'Sig>',
                        currentText: 'Hoy',
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                        weekHeader: 'Sm',
                        firstDay: 1,
                        dateFormat:"mm/dd/yy",
                        isRTL: false,
                        showMonthAfterYear: false,
                        yearSuffix: ''
     };

     
     $.datepicker.setDefaults($.datepicker.regional['es']);

     
     
     $(document).ready(function()
     {
         $( "#fechaInicio" ).datepicker({changeMonth: true, changeYear: true,
                                        onSelect:function()
                                                 {
                                                    $( "#fechaFinal" ).val('');
                                                    $( "#fechaFinal" ).datepicker( "option", "minDate", new Date($(this).val()) );
                                                 }
                                        });
                                        
         $( "#fechaFinal" ).datepicker({changeMonth: true, changeYear: true});
         
         // autocomplete 
         
   $( "#nombreCliente" ).autocomplete({
		source: base_url+'reportes/obtenerCliente',
		minLength: 2,
                // evento en respuesta
		response: function(event, ui) 
		{
	            // sino hay coincidencias mostramor un mensaje.
	            if (ui.content.length === 0) 
	            {
                        $("#empty-message").fadeIn('slow');
	                $("#empty-message").text("El cliente no existe. Buscar nuevamente.");
                         
	            } 
	            else 
	            {
                        $("#empty-message").fadeOut('slow');
	                $("#empty-message").empty();
                        
	            }
	        },
                // evento a la hora de buscar
	        search: function() 
		{
		// custom minLength
				$("#empty-message").fadeIn('slow');
				$("#empty-message").text("Buscando...");
				return this.value;
		
		},
                //evento a la hora de seleccionar
		select: function( event, ui ) 
		{
			
			
                        $('#idCliente').val(ui.item.id_cliente);
                        $('#nombreCliente').val(ui.item.nombre_cliente);
                        
			return false;
			
			
		}
           // metodo para mostrar la data     
	}).data( "ui-autocomplete" )._renderItem = function(ul, item )
	{
            return $( "<li>" ).append( "<a>" + item.nombre_cliente +"</a>" ).appendTo(ul);
		
	};
        
        $('#btnGraphic').click(function()
        {
           
           if($("#idCliente").val() == "")
           {
               alert('Busque un cliente para generar la grafica');
               return false;
           }
           
           
           $('#grafica').hide();
           $('#mensajeGrafica').show();
           
           var ctx = $("#myChart").get(0).getContext("2d"); 
           
            if(typeof xhrPost !== 'undefined')
            {
                xhrPost.abort();
            
            }
            
             xhrPost =  $.ajax({
                            url:base_url+'reportes/clienteReporte',
                            data:{cliente_id:$('#idCliente').val()},
                            type:'POST',
                            success: function(result)
                            {
                                $('#grafica').show();
                                $('#mensajeGrafica').hide();
                                dataObj = JSON.parse(result);
                                // This will get the first returned node in the jQuery collection.
                                var data = [];
                                var numTickets = 0;
                                
                                 for(var i in dataObj)
                                 {
                                     if(i % 2 === 0)
                                     {
                                         data[i] = 
                                             {
                                                 value : dataObj[i].numTickets ,
                                                 color: "#009ACD",
                                                 highlight: "#32aed7",
                                                label: dataObj[i].nombreCatalogo
                                             };
                                     }
                                     
                                      else if(i % 2 !== 0)
                                      {
                                          data[i] = 
                                             {
                                                 value : dataObj[i].numTickets ,
                                                 color: "#CDCD00",
                                                 highlight: "#d7d732",
                                                label: dataObj[i].nombreCatalogo
                                             };
                                      }
                                      
                                      numTickets += parseInt(dataObj[i].numTickets);
                                 }
                                

                                 new Chart(ctx).Pie(data,{tooltipTemplate: "Tipo de ticket: <%=label%> / N° de tickets: <%= value %>"});
                                
                                $('#messageCliente').text('Total de Tickets: ' + numTickets);
                                
                                
                                
                            }
        });
          
           
        });
        
        
        
     });


     
      
 
</script>



    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3" style="border-right: solid; border-right-width: 1px; border-right-color: lightgray">
          <label>Buscar el nombre del cliente</label>
          <input type="text" id="nombreCliente" placeholder="Coloca minimo 2 letras"  value=""/>
          <input type="hidden" id="idCliente" value=""/>
          <div id="empty-message"></div>
          <div style="margin-top: 25px;">  
          <label>Fecha Inicial</label>
          <input type="text" id="fechaInicio" placeholder="Fecha Inicial" value=""/>
          
          <label>Fecha Final</label>
          <input type="text" id="fechaFinal" placeholder="Fecha Final" value=""/>
          </div> 
          
          <button type="button" id="btnGraphic" class="btn btn-success">Crear grafica</button>
          
          
        </div>
        <div class="span8 offset1" id="grafica">
            
            <p>Grafica</p>
            <p> En la siguiente grafica puede visualizar los 
                tipos de tickets y cuantos han sido creados por cliente.</p>
            <div id="messageCliente"></div>
            <canvas id="myChart" width="450" height="450"></canvas>

        </div>
          <div class="span8 offset1" style="display:none" id="mensajeGrafica">
              Cargando...
          </div>  
      </div>
    </div>

