<!-- NAV PARA CADA MODULO -->

<ul class="nav nav-pills">
  <li class="active">
    <a href="<?php echo base_url("index.php/tickets"); ?>">Tickets</a>
  </li>
  <li><a href="<?php echo base_url("index.php/tickets/crearticket"); ?>">Crear nuevo</a></li>
  <li><a href="<?php echo base_url("index.php/tickets/crearticket"); ?>">Cancelar</a></li>
</ul>
<script type="text/javascript">

    
        $(document).ready(function()
        {
            $("#ticket").change(function() 
            {
                $("#ticket option:selected").each(function()     
                {
                    ticket = $('#ticket').val();
                    
                    $.post('<?php echo base_url('index.php/tickets/subtipostickets')?>', 
                    {
                        ticket : ticket
                    }, function(data) 
                        {
                            $("#subTicket").html(data);
                        });
                });
            });
            
            $("#clientes").change(function()
            {
                $("#clientes option:selected").each(function()
                {
                    cliente = $('#clientes').val();
                    
                    $.post('<?php echo base_url('index.php/tickets/sucursalesempleado')?>', 
                    {
                        cliente : cliente
                    }, function(data) 
                        {
                            $("#sucursales").html(data);
                        });
                });
            });
        });
    </script>
	
    <div class="row-fluid">
    <?php 
    
            if($this->session->flashdata('correcto_ticket'))
            {
                echo $this->session->flashdata('correcto_ticket');

            }
            if($this->session->flashdata('incorrecto_ticket'))
            {
                echo $this->session->flashdata('incorrecto_ticket');
                
            }
             if ($this->session->flashdata('error_validation'))
            {
               echo $this->session->flashdata('error_validation');
            }
		
    ?>
         
</div>

<div class="row-fluid">
        <div class="span6 offset3"> 
            <div class="well sidebar-nav">
            <legend class ="text-info"><p>Crear nuevo ticket</p></legend>

	<form method="post" action="<?php base_url('index.php/tickets/crearTicket');?>" class="form-horizontal">
                    <fieldset>

                      <?php 
               
              
    
              if(isset($clientes)) 
                {
                    echo '<div class ="control-group">'.
                         '<label class="control-label" for="clientes"> Empresa </label>'.
                          '<div class="controls">'.
                               '<select name="clientes" id ="clientes">'.
                                  '<option value="-1">Escoja una empresa</option>';
                                    foreach ($clientes->result() as $value) 
                                    {
                                  echo '<option value="'.$value->id_cliente .'">'.$value->nombre_cliente.'</option>';
                                    }
                             echo ' </select>'.


                         '</div>'.
                         '</div>';
                             
                   echo 
                        '<div class ="control-group">'.
                       ' <label class="control-label" for="sucursales"> Sucursal </label>'.
                        '<div class="controls">'.
                            '<select class ="span9" name="sucursal" id="sucursales">'.
                                '<option value=" "></option>'.
                           ' </select>'.
                        '</div>'.
                        '</div>';
                }
				
				if(isset($sucursales))
				{
					echo '<div class ="control-group">'.
                         '<label class="control-label" for="sucursal">Sucursales </label>'.
                          '<div class="controls">'.
                               '<select name="sucursal">'.
                                  '<option value=" ">Escoja una sucursal</option>';
                                    foreach ($sucursales->result() as $value) 
                                    {
                                  echo '<option value="'.$value->id_sucursal .'">'.$value->id_sucursal.'</option>';
                                    }
                             echo ' </select>'.


                         '</div>'.
                         '</div>';
				}
				
              ?>
                
                <div class ="control-group"> 
                    <label class="control-label" for="ticket"> Tipo</label>
                    <div class="controls">
                          <select class="input-medium" name='catalogo' id ='ticket'>
                              <option value ="0" ></option>
                              <?php foreach ($tipoTicket->result() as $value) {?>
                              <option  value="<?php echo $value->id_catalogo ?>"><?php echo $value->nombre_catalogo ?> </option>;
                              <?php }?>
                          </select>
                         
                        
                    </div>
                </div>
               

                <div class ="control-group"> 
                    <label class="control-label" for="subTicket">Problema</label>
                    <div class="controls">
                        <select class="span12" name="subTicket" id="subTicket">
                            
                        </select>
                    </div>
                    
                </div>
                <div class ="control-group"> 
                    <label class="control-label" for="prioridadTicket"> Prioridad </label>
                    
                    <div class="controls">
                      
                        <?php 
                            // Se crea un combobox con los valores de los perfiles
                        // creados en la base de datos.
                           $prio = array();
                          foreach ($prioridad->result() as $value) 
                          {
                              $prio[$value->id_prioridad] =$value->nombre_prioridad;
                          }

                         echo 
                              form_dropdown('prioridadTicket', $prio);
                        ?>
                       
                    </div>
                </div>
                
                <div class ="control-group"> 
                    <label class="control-label" for="observacionesTickets"> Descripción basica</label>
                    <div class="controls">
                        <textarea style ="resize: none; width: 340px; height: 90px" name="observacionesTickets" rows="4" ></textarea>
                    </div>
                </div>
                
                <div class ="control-group"> 
                      <center>                  
                        <button type="reset" class="btn btn-danger" type="button">Cancelar</button> 
                        <input type="submit" name="submit" class="btn btn-success" value ="Crear ticket"/>        
                      </center>
                </div>

                      

                      
                      </fieldset>
	</form>

                    
</div>
</div>
</div>


