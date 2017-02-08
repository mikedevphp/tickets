
<!-- NAV PARA CADA MODULO -->

<ul class="nav nav-pills">
  <li class="active">
    <a href="<?php echo base_url("index.php/empleados"); ?>">Empleados</a>
  </li>
  <li><a href="<?php echo base_url("index.php/empleados/crearEmpleado"); ?>">Nuevo empleado</a></li>
  
</ul>
<script src="<?= base_url('css/js/popoverempleados.js') ?>"></script>
<script src="<?= base_url('css/js/modalempleados.js') ?>"></script>

<div class="row-fluid" >
    <?php  
        if ($this->session->flashdata('correcto_empleado')) 
          {
             echo $this->session->flashdata('correcto_empleado');
          } 
          
          if ($this->session->flashdata('eliminado_empleado')) 
          {
             echo $this->session->flashdata('eliminado_empleado');
          }
          
          if ($this->session->flashdata('modificado_empleado')) 
          {
             echo $this->session->flashdata('modificado_empleado');
          }
		  
		  if ($this->session->flashdata('error_validation')) 
          {
             echo $this->session->flashdata('error_validation');
          }
    ?>
    
</div>

<div class ="row-fluid">
    <script type="text/javascript">
   

    </script>
    <?php 
        if(isset($empleados))
        {
            
            echo "<caption><center>Empleados actualmente registrados.</center></caption></br>";
            
            echo "<table id='tablaclientes' class ='table table-bordered table-striped table-condensed'>
            <thead><tr><th class='alert alert-info'>Nombre del empleado</th><th class='alert alert-info'>Editar</th>
            <th class='alert alert-info' >Eliminar</th></tr></thead>".
            "<tbody>";
            
            
            
            foreach($empleados->result() as $row)
            {                          
                echo "<tr><td>".
                    detallesEmpleados($row)."</td><td><a class='btn-small btn-warning' href='#modalEditarEmpleado'
                    data-toggle='modal' editar='' idempleado ='".$row->idempleado."' perfil='".$row->idperfil."' nombres ='".$row->nombres."' 
                     paterno='".$row->apellido_paterno."' materno='".$row->apellido_materno."'  fracc='".$row->colonia."'
                    calle='".$row->calle."' ciudad ='".$row->ciudad."' telefono ='".$row->telefono."' 
                    cel ='".$row->telefono_cel."' email ='".$row->email."'
                    ><i class='icon-pencil icon-white'></i></a></td>
                    <td><a class='btn-small btn-danger' href='#modalEliminarEmpleado' data-toggle='modal' 
                    empleado ='".$row->nombres." ".$row->apellido_paterno." ".$row->apellido_materno."' iduserdel='".$row->id_user."'>
                    <i class='icon-trash icon-white'></i></a></td></tr>";
                        

            }
            echo "</tbody>".
                 "</table>";
        }
    
        function detallesEmpleados($row)
        {
        
            return "<a style='color:black;' href='#' empleados='' username ='".$row->nombre_usuario."' ciudad ='".$row->ciudad."'
               fracc ='".$row->colonia."' perfil ='".$row->nombre_perfil."' calle='".$row->calle."' 
               telefono ='".$row->telefono."' cel ='".$row->telefono_cel."' email ='".$row->email."'><i class='icon-user'></i> "
               .$row->nombres." ".$row->apellido_paterno." ".$row->apellido_materno." </a>" ;
        }
        
    ?>
    
       
</div>

<!-- Modal para eliminar empleados -->
    <form  method = "post" action = "<?php echo base_url("index.php/empleados/eliminarEmpleado"); ?>"> 
        <div id="modalEliminarEmpleado" class="modal hide fade">
            <div class="modal-header">
                <h4 id="myModalLabel">Advertencia</h4>
            </div>
            <div class="modal-body">
            </div>
             <div class="modal-footer">
                <button type="submit" name ="eliminarEmpleado" value ="eliminar" class="btn btn-danger">Sí</button>
                <button class="btn" data-dismiss="modal">No</button>
             </div>      
        </div>
    </form>
    
    <!-- Modal para editar empleados -->
    <form class="form-horizontal"  method = "post" action = "<?php echo base_url("index.php/empleados/editarEmpleado"); ?>"> 
        <div id="modalEditarEmpleado" class="modal hide fade">
            <div class="modal-header">
                <h4 id="myModalLabel">Edición del Empleado</h4>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <label class="control-label">Nombres(s)</label>
                        <div class="controls">
                        <input id="nombreempleado" value="" type="text" name="nombreEmpleado" class="input-large" placeholder="Nombre (s)">
                        <input id="idempleado" value ="" type="hidden" name="idEmpleado"> 
                        </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Apellido Paterno</label>
                    <div class="controls">
                        <input type="text" name="apellidoPatEmp" id="apellidopatemp" class="input-large" placeholder="Last name">
                    </div>
                </div>
                        
                <div class="control-group">
                    <label class="control-label">Apellido Materno</label>
                    <div class="controls">
                        <input type="text" name="apellidoMatEmp" id="apellidomatemp" class="input-large" placeholder="Last name">
                    </div>
                </div>
                
                      <div class="control-group">
                        <label class="control-label">Ciudad</label>
                          <div class="controls" >
                            <select id="empleadociudad" name="ciudadEmpleado" class="input-large">
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
                             <input id="empleadofracc" type="text" value="" name="fraccEmpleado" class="input-xlarge" placeholder="District">
                            </div>
                      </div>

                         <div class="control-group">
                          <label class="control-label">Calle</label>
                           <div class="controls">
                              <input id="empleadocalle" type="text" value="" name="calleEmpleado" class="input-xlarge" placeholder="Street" required>
                            </div>
                          </div>

                          <div class="control-group">
                            <label class="control-label">Teléfono</label>
                               <div class="controls">
                                 <input id="empleadotel" type="text" value="" name="telEmpleado" class="input-medium bfh-phone" data-format="01 (ddd) ddd-dddd" placeholder="Fijo">
                               </div>
                           </div>

                            <div class="control-group">
                              <label class="control-label">Teléfono celular</label>
                                <div class="controls">
                                  <input id="empleadocel" type="text" value="" name="celEmpleado" class="input-medium bfh-phone" data-format="044 (ddd) ddd-dddd" placeholder="Movil">
                                </div>
                             </div>
                      

                      <div class ="control-group"> 
                        <label class="control-label" for="email">Email</label>
                            <div class="controls">
                                <input id="empleadoemail" value="" class="span3" name="emailEmpleado" type="email" required>
                            </div>
                      </div>
                    

            </div>
             <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger" >Cancelar</button>
                <button class="btn btn-success" name="editarEmpleado" type="submit" value="editar">Editar</button>        
             </div>      
        </div>
    </form>

    </div>
</div>
    
                
               