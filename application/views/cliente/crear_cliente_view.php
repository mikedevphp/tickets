
<!-- NAV PARA CADA MODULO -->

<ul class="nav nav-pills">
  <li class="active">
    <a href="<?php echo base_url("index.php/clientes"); ?>">Clientes</a>
  </li>
  <li><a href="<?php echo base_url("index.php/clientes/crearCliente"); ?>">Nueva empresa</a></li>
  <li><a href="<?php echo base_url("index.php/clientes/crearSucursal"); ?>">Nueva sucursal</a></li>
</ul>


<div class="row-fluid">
    
    <?php 
      
    if($this->session->flashdata('error_validation'))
    {
		echo $this->session->flashdata('error_validation');
        
    }
    ?>
   
<div class="row-fluid">
    
        <div class="span6 offset3"> 
            <div class="well sidebar-nav">
            <legend class ="text-info"><center><p> Nueva empresa</p></center></legend>

            <form method="post" action="<?php echo base_url('index.php/clientes/Crearcliente'); ?>" class="form-horizontal">
                    <fieldset>

                      <div class="control-group">
                        <label class="control-label">Nombre</label>
                            <div class="controls">
                                <!-- Carga el id del perfil cliente -->
                            <input type="hidden" name="idPerfil" value="<?php echo $perfilCliente->id_perfil ?>" > </input>
                            <input type="text" name="nombreCliente" class="input-large" placeholder="Company name">
                            </div>
                      </div>

					<div class="control-group">
                        <label class="control-label">Ciudad</label>
                          <div class="controls" >
                            <select name="ciudadCliente" class="input-large">
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
                             <input type="text" name="fraccCliente" class="input-xlarge" placeholder="District">
                            </div>
                      </div>

                         <div class="control-group">
                          <label class="control-label">Calle</label>
                           <div class="controls">
                              <input type="text" name="calleCliente" class="input-xlarge" placeholder="Street">
                            </div>
                          </div>

                          <div class="control-group">
                            <label class="control-label">Teléfono</label>
                               <div class="controls">
                                 <input type="text" name="telCliente" class="input-medium bfh-phone" data-format="01 (ddd) ddd-dddd" placeholder="Phone">
                               </div>
                           </div>

                            <div class="control-group">
                              <label class="control-label">Teléfono celular</label>
                                <div class="controls">
                                  <input type="text" name="celCliente" class="input-medium bfh-phone" data-format="044 (ddd) ddd-dddd" placeholder="Movil">
                                </div>
                             </div>
                      

                      <div class ="control-group"> 
                        <label class="control-label" for="email">Email</label>
                            <div class="controls">
                                <input class="span8" name="emailCliente" type="text">
                            </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label" for="inputPassword">Contraseña</label>
                            <div class="controls">
                              <input type="password" name="passCliente" placeholder="Password">
                            </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label" for="inputPassword">Repetir contraseña</label>
                        <div class="controls">
                          <input type="password" name="passClienteR"  placeholder="Password (repeat)">
                        </div>
                      </div>

                      <center>                  
                        <button type="reset" class="btn btn-danger" >Cancelar</button>
                        <button class="btn btn-success" name="registrarCliente" type="submit" value="registrar">Registrar</button>          
                      </center>

                      
                      </fieldset>
                    </form>

                    
</div>
</div>
</div>

</div>
    </div>
</div>