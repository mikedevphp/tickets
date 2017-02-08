<div class="row-fluid">
<!-- NAV PARA CADA MODULO -->

<ul class="nav nav-pills">
  <li class="active"><a href="<?php echo base_url("index.php/tickets"); ?>">Tickets</a></li>
  <li><a id="crearticket" href="<?php echo base_url("index.php/tickets/crearticket"); ?>">Crear nuevo</a></li>
  <li><a id="notificaciones" href="#">Nuevos Tickets<span id="nums" class="badge badge-success">0</span></a></li>
</ul>
</div>
 <script src="<?= base_url('css/js/modaltickets.js') ?>"></script>
    <script src="<?= base_url('css/js/modalseguimiento.js') ?>"></script>
    <script src="<?= base_url('css/js/modalcomentarios.js') ?>"></script>
    <script src="<?= base_url('css/js/modalticketscerrado.js') ?>"></script>
    <script src="<?= base_url('css/js/tooltiptickets.js') ?>"></script>
    <script src="<?= base_url('css/js/popovertickets.js') ?>"></script>
    
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#clientestickets").change(function()
            {
               
                $("#clientestickets option:selected").each(function()
                {
                    clienteticket = $("#clientestickets option:selected").val();
                  
                        $.post('<?php echo base_url('index.php/tickets/sucursalesempleado')?>', 
                        {
                            clienteticket : clienteticket
                        }, function(data) 
                            {
                                $("#sucursalestickets").html(data);
                                
                            });
                   
                    
                });
                
                
                
            });
        
        
          if($('#clientestickets > option:selected').attr('value') > 0)
           {
               showcontrols($('#showempresa'), $('#buscarempresa'), $('#hideempresa'));
           }
           
        if($('#sucursalestickets > option:selected').attr('value') !== "nada" ||
            $('#sucursalesticket > option:selected').attr('value') === " " )
           {
               showcontrols($('#showsucursalcliente'), $('#buscarsucursalcliente'), $('#hidesucursalcliente'));
           }
        
        if($('#tipoticket > option:selected').attr('value') > 0)
           {
               showcontrols($('#showtipo'), $('#buscartipo'), $('#hidetipo'));
           }
           
        if($('#tipostatus > option:selected').attr('value') > 0)
           {
              showcontrols($('#showstatus'), $('#buscarstatus'), $('#hidestatus'));
           }
           
        if($('#tipoprioridad > option:selected').attr('value') > 0)
           {
               showcontrols($('#showprio'), $('#buscarprio'), $('#hideprio'));
           }
        
        
        
        $('#showempresa').click(function()
        {
           showcontrols($(this), $('#buscarempresa'), $('#hideempresa'));
        });
        
        $('#hideempresa').click(function()
        { 
            hidecontrols($(this), $('#buscarempresa'), $('#showempresa'));
        });
        
        
        
        $('#showsucursalcliente').click(function()
        {
           showcontrols($(this), $('#buscarsucursalcliente'), $('#hidesucursalcliente'));
        });
        
        $('#hidesucursalcliente').click(function()
        { 
            hidecontrols($(this), $('#buscarsucursalcliente'), $('#showsucursalcliente'));
        });
        
        $('#showtipo').click(function()
        {
           showcontrols($(this), $('#buscartipo'), $('#hidetipo'));
        });
        
        $('#hidetipo').click(function()
        {
            hidecontrols($(this), $('#buscartipo'), $('#showtipo'));
        });
        
        $('#showstatus').click(function()
        {
            showcontrols($(this), $('#buscarstatus'), $('#hidestatus')); 
        });
        
        $('#hidestatus').click(function()
        {
            hidecontrols($(this), $('#buscarstatus'), $('#showstatus'));
        });
        
        $('#showprio').click(function()
        {
            showcontrols($(this), $('#buscarprio'), $('#hideprio')); 
        });
        
        $('#hideprio').click(function()
        {
            hidecontrols($(this), $('#buscarprio'), $('#showprio'));
        });
        
    });
        
    function hidecontrols(main, control1, control2)
    {
        main.hide();
        control1.hide();
        control2.show();
    }
    
    function showcontrols(main, control1, control2)
    {
        main.hide();
        control1.show();
        control2.show();
    }
    
</script>

<div class="row alert">
    <form  method = "post" action = "<?php echo base_url("index.php/tickets")?>">
        <center><p style="color:black">Seleccione los filtros para realizar la consulta.</p></center>
        <div style="margin-left:70px;" class="row">
            <div class=" span3 form-inline alert alert-info">
                <?php if($this->user->id_perfil != 3)
                { ?>
                <label>Buscar por empresa </label><a id="showempresa" class="btn btn-link">+</a>
                                            <a id="hideempresa" class="btn btn-link hide" >-</a>
                <div id="buscarempresa" class="hide">                         
                    <label for="empresas" >Empresa
                    <select class="input-large" id="clientestickets" name="empresas">
                              <option  value ="-1" >Escoja un empresa</option>
                             <?php
                             if(isset($clientes))
                             {
                                foreach($clientes->result() as $row)
                                {   
                                   if(@$empresaTipo == $row->id_cliente)
                                   {
                                      echo '<option value ="'.$row->id_cliente.'" selected="selected">'.$row->nombre_cliente.'</option> ';
                                   }
                                   else{ echo '<option  value ="'.$row->id_cliente.'">'.$row->nombre_cliente.'</option> ';}
                                }
                             }
                              ?>
                    </select>
                    </label>
                <?php  } else
                    {
                    echo "<label>Buscar por sucursal </label><a id='showsucursalcliente' class='btn btn-link'>+</a>
                                            <a id='hidesucursalcliente' class='btn btn-link hide' >-</a> ";
                    echo "<input type='hidden' id='clientestickets' value='".$this->user->id_cliente."' /> ";
                    
                    } ?>
                  <?php if($this->user->id_perfil != 3){ ?> 
                
                <label for="sucursales" >Sucursal
                <select class="input-large" name="sucursales" id="sucursalestickets">
                          
                          <?php
                                if(isset($sucursales))
                            {
                                echo '<option value =" " >Todas</option>';
                                foreach($sucursales->result() as $row)
                                {   
                                    if(@$sucursalTipo == $row->id_sucursal)
                                    {
                                        echo '<option selected="selected" value ="'.$row->id_sucursal.'">'.$row->id_sucursal.'</option> ';
                                    }
                                   else{ echo '<option value ="'.$row->id_sucursal.'">'.$row->id_sucursal.'</option> ';}
                                }
                            }
                            
                            else{ echo '<option value =" " ></option>';}
                            
                          ?>
                </select>
                </label>
                
            </div>
                  <?php }
                  else
                    {?>
            <input type="hidden" id="clientestickets" value="-1"/>
            <div id="buscarsucursalcliente" class="hide">
                 
                    <label for="sucursales" >Sucursal
                    <select class="input-large" name="sucursales" id="sucursalestickets">
                          <?php 
                            if(isset($sucursales))
                            {
                                
                                if(@$sucursalTipo == " "){ echo '<option selected="selected" value =" ">Todas</option> '; ;}
                                else{echo '<option  value =" ">Todas</option> ';}
                                
                                foreach($sucursales->result() as $row)
                                {   
                                    if(@$sucursalTipo == $row->id_sucursal )
                                    {
                                        echo '<option selected="selected" value ="'.$row->id_sucursal.'">'.$row->id_sucursal.'</option> ';
                                    }
                                   else{ echo '<option value ="'.$row->id_sucursal.'">'.$row->id_sucursal.'</option> ';}
                                }
                            }
                            else { echo '<option  value =" ">Sin sucursales</option> '; }
                          ?>
                    </select>
                </label>
            </div>
                   <?php }
                  ?>
            </div>

            <div class="form-inline span2 alert alert-info">
                <label>Buscar por tipo ticket</label><a id="showtipo" class="btn btn-link">+</a>
                                                    <a id="hidetipo" class="btn btn-link hide" >-</a>
                <div id="buscartipo" class="hide">
                <label for="tipoticket" >Tipo
                <select class="input-medium" id="tipoticket" name="tipoticket">
                          <option  value ="0">Tipo de Ticket</option>
                          <?php
                            foreach($tipo->result() as $row)
                            {     
                                if(@$ticketTipo == $row->id_catalogo)
                                { 
                                    echo '<option selected="selected" value ="'.$row->id_catalogo.'">'.$row->nombre_catalogo.'</option> ';
                                }
                                else{echo '<option value ="'.$row->id_catalogo.'">'.$row->nombre_catalogo.'</option> ';}
                            }
                          ?>
                </select>               
                </label>
                </div>
             </div>
            
            <div class="form-inline span2 alert alert-info">
                <label>Buscar por status </label><a id="showstatus" class="btn btn-link">+</a>
                                                    <a id="hidestatus" class="btn btn-link hide" >-</a>
                <div id="buscarstatus" class="hide">
                <label for="status" >Status
                <select class="input-medium" id="tipostatus" name="status">
                          <option  value ="0" >Tipo de Status</option>
                          <?php
                            foreach($status->result() as $row)
                            {
                                if(@$statusTipo == $row->id_status)
                                { 
                                    echo '<option selected="selected" value ="'.$row->id_status.'">'.$row->nombre_status.'</option> ';
                                }
 
                              else{echo '<option  value ="'.$row->id_status.'">'.$row->nombre_status.'</option> ';}
                            }
                          ?>
                </select>               
                </label>
                </div>

            </div>
            
            <div class="form-inline span2 alert alert-info">
                <label>Buscar por prioridad</label><a id="showprio" class="btn btn-link">+</a>
                                                    <a id="hideprio" class="btn btn-link hide" >-</a>
                <div id="buscarprio" class="hide">
                <label for="status" >Prioridad
                <select class="input-medium" id="tipoprioridad" name="prioridad">
                    <option  value ="0" >Tipo de Prioridad</option>
                    <?php
                            foreach($prioridad->result() as $row)
                            {
                                if($prioridadTipo == $row->id_prioridad)
                                { 
                                    echo '<option selected="selected" value ="'.$row->id_prioridad.'">'.$row->nombre_prioridad.'</option> ';
                                }
                                else{ echo '<option  value ="'.$row->id_prioridad.'">'.$row->nombre_prioridad.'</option> ';}
                            }
                          ?>
                </select>               
                </label>
                </div>

            </div>
            
            </div>
        
        <div class="row">
        <center> <button type="submit" class="btn btn-success" name="filtrarTickets" value="filtrar">Buscar</button></center><br>
        <input type="hidden" id="ticketTimeLast" value="<?php echo $lastTicket; ?>"/>
        <?php
            if($cliente===TRUE)
            {
        ?>
        <input type="hidden" id="clienteTickets" value="SI"/>
        <?php
            }
        ?>
        </div>
     </form>
</div>  
    


<!-- Modal para abrir ticket para los empleados -->
<form  method = "post" action = "<?php echo base_url("index.php/tickets/abrirticket"); ?>"> 
    <div id="myModalAbrir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h4 id="myModalLabel">Advertencia</h4>
        </div>
        <div class="modal-body">
        </div>
         <div class="modal-footer">
            <button type="submit" name ="submitAbrirTicket" value ="abrirTicket" class="btn btn-success">Sí</button>
            <button class="btn" data-dismiss="modal">No</button>
         </div>      
    </div>
</form>

 <!-- Modal que muestra el seguimiento para los empleados -->
    <div id="segConfirmModal" class="modal hide fade">
        <div class="modal-header">
            <h4 id="dataConfirmLabel">Status del ticket</h4>
        </div>
        <div class="modal-body">
        <center><button id="buttonComments" class="btn btn-link ">Historial de seguimiento +</button></center> 
        <center><button id="closeButtonComments" class="btn btn-link ">Historial de seguimiento -</button><center>
        </div>
         <div class="modal-footer">
            <button id="modalTicketsActualizar" data-toggle="modal" data-target="#segCommentsModal" class="btn btn-success">Actualizar seguimiento</button>
            <button id="modalTicketsCerrar" data-toggle="modal" data-target="#cerrarModalTicket" class="btn btn-danger">Cerrar ticket</button>
            <button class="btn" aria-hidden="true" data-dismiss="modal">Cancelar</button>
         </div>
    </div>
 
 <!-- Modal que sirve para actualizar el seguimiento del ticket -->
    <form method = "post" action = "<?php echo base_url("index.php/tickets/actualizarticket")?>">
            <div id="segCommentsModal" class=" modal hide fade"> 
                     <div class="modal-header">
                        <h4 id="segCommentsh4">Seguimiento del ticket</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                     <div class="modal-footer">    
                        <button type="submit" name="submitActualizarTicket" value="actualizarTicket" class="btn btn-success">Actualizar</button>
                        <button aria-hidden="true" data-dismiss="modal" class="btn">Cancelar</button>
                     </div>

            </div>
     </form>
 
 <!-- Modal que sirve para cerrar el ticket, debera agregar una nota de conclusion para poder cerrar el ticket -->
     <form  method = "post" action = "<?php echo base_url("index.php/tickets/cerrarticket")?>">
                <div id="cerrarModalTicket" class="modal hide fade">
                    <div class="modal-header">
                        <h4 id="cerrarModalTicketh4">Nota de conclusión</h4>
                    </div>
                    <div class="modal-body">   
                    </div>
                     <div class="modal-footer"> 
                        <button id="cerrarTicketNota" type="submit" name="submitCerrarTicket" value ="cerrarTicket" class="btn btn-danger">Cerrar ticket</button>
                        <button class="btn" aria-hidden="true" data-dismiss ="modal" >Cancelar</button>
                     </div>
                </div>
       </form>
 
 <!-- Modal que muestra el resumen del cierre del ticket -->
       <div id="ticketCerradoModal" class="modal hide fade" >
            <div class="modal-header">
                <h4 id="dataCerrarLabelh4">Status del incidente</h4>
            </div>
            <div class="modal-body">
                <center><button id="buttonComments" class="btn btn-link">Historial de status +</button></center>
                <center><button id="closeButtonComments" class="btn btn-link">Historial de status -</button></center>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
 
 
 


</div>
</div>
  