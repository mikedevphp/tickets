<!-- NAV PARA CADA MODULO -->

<ul class="nav nav-pills">
  <li class="active">
    <a href="<?php echo base_url("index.php/clientes"); ?>">Clientes</a>
  </li>
  <li><a href="<?php echo base_url("index.php/clientes/crearCliente"); ?>">Nueva empresa</a></li>
  <li><a href="<?php echo base_url("index.php/clientes/crearSucursal"); ?>">Nueva sucursal</a></li>
  
</ul>

<script src="<?= base_url('css/js/popoverclientes.js') ?>"></script>
<script src="<?= base_url('css/js/modalclientes.js') ?>"></script>
<script type="text/javascript">

    $(document).ready(function()
    {
        $('a[tooltip]').tooltip({trigger: 'hover', placement: 'right'});
    });

</script>

<div class="row-fluid">
    <?php

        if ($this->session->flashdata('correcto')) 
        {
           echo $this->session->flashdata('correcto');
        }

       if ($this->session->flashdata('incorrecto')) 
        {
           echo $this->session->flashdata('incorrecto');
        }
        
        if ($this->session->flashdata('correcto_suc')) 
        {
           echo $this->session->flashdata('correcto_suc');
        }

       if ($this->session->flashdata('incorrecto_suc')) 
        {
           echo $this->session->flashdata('incorrecto_suc');
        }
        
        if ($this->session->flashdata('modificado_cliente')) 
        {
           echo $this->session->flashdata('modificado_cliente');
        }
        
        if ($this->session->flashdata('eliminado_cliente')) 
        {
           echo $this->session->flashdata('eliminado_cliente');
        }
        
        if ($this->session->flashdata('modificado_sucursal')) 
        {
           echo $this->session->flashdata('modificado_sucursal');
        }
        
        if ($this->session->flashdata('eliminado_sucursal')) 
        {
           echo $this->session->flashdata('eliminado_sucursal');
        }
		
		if ($this->session->flashdata('error_validation')) 
        {
           echo $this->session->flashdata('error_validation');
        }
        
    ?>
  </div>  

<div class="row-fluid">
    
    <?php 
        if(isset($clientes))
        {
            
            
            echo "<caption><center>Clientes actualmente registrados.</center></caption></br>";
            
            echo "<table id='tablaclientes' class ='table table-bordered table-striped table-condensed'>
            <thead><tr><th class='alert alert-info'>Empresa</th><th class='alert alert-info'>N° sucursales</th>
            <th class='alert alert-info'>Editar</th><th class='alert alert-info'>Eliminar</th></tr></thead>".
            "<tbody>";
         
                foreach($clientes->result() as $row)
                {                          

                    echo "<tr><td>".
                    detallesClientes($row)."</td><td>".mostrarSucursales($row)."</td><td><a class='btn-small btn-warning' href='#modalEditarCliente'
                    data-toggle='modal' editar='' idcliente ='".$row->id_cliente."' cliente ='".$row->nombre_cliente."' fracc='".$row->fracc_colonia_cliente."'
                    direccion='".$row->direccion."' ciudad ='".$row->ciudad_cliente."' telefono ='".$row->telefono."' 
                    cel ='".$row->telefono_cel."' email ='".$row->email."'
                    ><i class='icon-pencil icon-white'></i></a></td><td><a class='btn-small btn-danger' href='#modalEliminarCliente'
                    data-toggle='modal' empresa ='".$row->nombre_cliente."' iduserdel='".$row->id_user."'>
                    <i class='icon-trash icon-white'></i></a></td></tr>";
                }
                       
               echo "</tbody>".
           "</table>";
        }
    
    
    function detallesClientes($row)
    {
        
       return "<a style='color:black;' href='#' empresas='' username ='".$row->nombre_usuario."' ciudad ='".$row->ciudad_cliente."'
          fracc ='".$row->fracc_colonia_cliente."' direccion='".$row->direccion."'
          telefono ='".$row->telefono."' cel ='".$row->telefono_cel."' email ='".$row->email."'><i class='icon-briefcase'></i> ".$row->nombre_cliente." </a>" ;
    }
     
    function mostrarSucursales($row)
    {
        $link = ($row->numSucs != 0) ? 
        "<a href='".base_url('/index.php/clientes/sucursalesCliente')."/".$row->id_cliente."'  title ='Click para ver las sucursales.' tooltip =''>$row->numSucs</a>"
         : "<a style=color:black href='#' tooltip ='' title ='Sin sucursales.'>0</a>";
        
        return $link;
        
    }
        ?>
</div>
    <!-- Modal para eliminar empresas(clientes) -->
    <form  method = "post" action = "<?php echo base_url("index.php/clientes/eliminarCliente"); ?>"> 
        <div id="modalEliminarCliente" class="modal hide fade">
            <div class="modal-header">
                <h4 id="myModalLabel">Advertencia</h4>
            </div>
            <div class="modal-body">
            </div>
             <div class="modal-footer">
                <button type="submit" name ="eliminarCliente" value ="eliminar" class="btn btn-danger">Sí</button>
                <button class="btn" data-dismiss="modal">No</button>
             </div>      
        </div>
    </form>
    
    <!-- Modal para editar empresas(clientes) -->
    <form class="form-horizontal"  method = "post" action = "<?php echo base_url("index.php/clientes/editarCliente"); ?>"> 
        <div id="modalEditarCliente" class="modal hide fade">
            <div class="modal-header">
                <h4 id="myModalLabel">Edición de la Empresa</h4>
            </div>
            <div class="modal-body">
                <div class="control-group">
                        <label class="control-label">Nombre</label>
                            <div class="controls">
                            <input id="clienteempresa" value="" type="text" name="nombreCliente" class="input-large" placeholder="Company name">
                            <input id="idcliente" value ="" type="hidden" name="idCliente"> 
                            </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Ciudad</label>
                          <div class="controls" >
                            <select id="clienteciudad" name="ciudadCliente" class="input-large">
                                  <option>Abasolo</option>
                                  <option>Aldama</option>
                                  <option>Altamira</option>
                                  <option>Antiguo Morelos</option>
                                  <option>Burgos</option>
                                  <option>Bustamante</option>
                                  <option>Camargo</option>
                                  <option>Casas</option>
                                  <option>Ciudad Madero</option>
                                  <option>Cruillas</option>
                                  <option>El Mante</option>
                                  <option>Guémez</option>
                                  <option>Gómez Farías</option>
                                  <option>González</option>
                                  <option>Guerrero</option>
                                  <option>Gustavo Díaz Ordaz</option>
                                  <option>Hidalgo</option>
                                  <option>Jaumave</option>
                                  <option>Jiménez</option>
                                  <option>Llera</option>
                                  <option>Mainero</option>
                                  <option>Matamoros</option>
                                  <option>Méndez</option>
                                  <option>Mier</option>
                                  <option>Miguel Alemán</option>
                                  <option>Miquihuana</option>
                                  <option>Nuevo Laredo</option>
                                  <option>Nuevo Morelos</option>
                                  <option>Ocampo</option>
                                  <option>Padilla</option>
                                  <option>Palmillas</option>
                                  <option>Reynosa</option>
                                  <option>Río Bravo</option>
                                  <option>San Carlos</option>
                                  <option>San Fernando</option>
                                  <option>San Nicolás</option>
                                  <option>Soto la Marina</option>
                                  <option>Tampico</option>
                                  <option>Tula</option>
                                  <option>Valle Hermoso</option>
                                  <option>Victoria</option>
                                  <option>Villagrán</option>
                                  <option>Xicoténcatl</option>
                                </select>
                            </div>
                      </div>                                 

                      <div class="control-group">
                         <label class="control-label">Fracc./Colonia</label>
                           <div class="controls">
                             <input id="clientefracc" type="text" value="" name="fraccCliente" class="input-xlarge" placeholder="District">
                            </div>
                      </div>

                         <div class="control-group">
                          <label class="control-label">Calle</label>
                           <div class="controls">
                              <input id="clientecalle" type="text" value="" name="calleCliente" class="input-xlarge" placeholder="Street">
                            </div>
                          </div>

                          <div class="control-group">
                            <label class="control-label">Teléfono</label>
                               <div class="controls">
                                 <input id="clientetel" type="text" value="" name="telCliente" class="input-medium bfh-phone" data-format="01 (ddd) ddd-dddd" placeholder="Fijo">
                               </div>
                           </div>

                            <div class="control-group">
                              <label class="control-label">Teléfono celular</label>
                                <div class="controls">
                                  <input id="clientecel" type="text" value="" name="celCliente" class="input-medium bfh-phone" data-format="044 (ddd) ddd-dddd" placeholder="Movil">
                                </div>
                             </div>
                      

                      <div class ="control-group"> 
                        <label class="control-label" for="email">Email</label>
                            <div class="controls">
                                <input id="clienteemail" value="" class="span3" name="emailCliente" type="email" required>
                            </div>
                      </div>
                    

            </div>
             <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger" >Cancelar</button>
                <button class="btn btn-success" name="editarCliente" type="submit" value="editar">Editar</button>        
             </div>      
        </div>
    </form>
    
   
    
</div>


    

 