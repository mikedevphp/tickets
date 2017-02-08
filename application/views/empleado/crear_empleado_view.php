
<!-- NAV PARA CADA MODULO -->

<ul class="nav nav-pills">
  <li class="active">
    <a href="<?php echo base_url("index.php/empleados"); ?>">Empleados</a>
  </li>
  <li><a href="<?php echo base_url("index.php/empleados/crearEmpleado"); ?>">Nuevo empleado</a></li>
  
</ul>

  <div class="row-fluid">
    <?php 
        
    if($this->session->flashdata('error_validation'))
    {
        echo $this->session->flashdata('error_validation');
       
    }
 
    ?>
</div>
        <div class="row-fluid">
        <div class="span6 offset3"> 
            <div class="well sidebar-nav">
            
            <legend class ="text-info"><p><i class="icon-user icon-white"></i> Registro de nuevo empleado</p></legend>

                    <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/empleados/crearEmpleado'); ?>">
                    <fieldset>

                        <div class="control-group">
                        <label class="control-label">Tipo de cuenta</label>
                            <div class="controls">
                                <select name="perfilesEmp" class="input-medium">
                                    <option value="-1"> Escoja un perfil </option>
                                  <?php 
                                  
                                    if(isset($perfiles))
                                    {
                                        foreach ($perfiles->result() as $row) 
                                        {
                                            echo '<option value="'.$row->id_perfil.'" >'.$row->nombre_perfil.' </option>';
                                        }
                                    }
                                  
                                  ?>
                                </select>
                            </div>
                      </div>

                        <div class="control-group">
                            <label class="control-label">Nombre(s)</label>
                            <div class="controls">
                                <input type="text" name="nombresEmp" class="input-large" placeholder="Name">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Apellido Paterno</label>
                            <div class="controls">
                                <input type="text" name="apellidoPatEmp" class="input-large" placeholder="Last name">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">Apellido Materno</label>
                            <div class="controls">
                                <input type="text" name="apellidoMatEmp" class="input-large" placeholder="Last name">
                            </div>
                        </div>

                        <div class="control-group">
                          <div class="input-prepend">
                            <label class="control-label">Nombre de usuario</label>
                            <div class="controls">
                                <span class="add-on">@</span>
                                <input type="text" name="userEmp" class="input-medium" placeholder="Username">
                            </div>
                          </div>
                        </div>

                      <div class="control-group">
                        <label class="control-label">Ciudad</label>
                            <div class="controls" >
                                <select name="ciudadEmp" class="input-large">
                                  <option value=""></option>
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
                        <label class="control-label">Colonia / Fraccionamiento</label>
                            <div class="controls">
                                <input type="text" name="colEmp" class="input-xlarge" placeholder="District">
                            </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Calle</label>
                            <div class="controls">
                                <input type="text" name="calleEmp" class="input-xlarge" placeholder="Street">
                            </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Teléfono</label>
                            <div class="controls">
                                <input type="text" name="telEmp" class="input-medium bfh-phone" data-format="01 (ddd) ddd-dddd" placeholder="Phone">
                            </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Teléfono celular</label>
                            <div class="controls">
                                <input type="text" name="celEmp" class="input-medium bfh-phone" data-format="044 (ddd) ddd-dddd" placeholder="Movil">
                            </div>
                      </div>

                      <div class ="control-group"> 
                        <label class="control-label" for="email">Correo eléctronico</label>
                            <div class="controls">
                                <input class="span8" name="emailEmp" type="text">
                            </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label" for="inputPassword">Contraseña</label>
                            <div class="controls">
                              <input type="password" name="passEmp" id="inputPassword" placeholder="Password">
                            </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label" for="inputPassword">Repetir contraseña</label>
                        <div class="controls">
                          <input type="password" name="passEmpR" id="inputPassword" placeholder="Password (repeat)">
                        </div>
                      </div>

                      <center>                  
                        <button type="reset" class="btn btn-danger" type="button">Cancelar</button>
                        <button type="submit" name="crearEmpleados" value="crear" class="btn btn-success" type="button">Registrar</button>          
                      </center>

                      
                      </fieldset>
                    </form>

                    
</div>
</div>
</div>
        

    </div>
</div>