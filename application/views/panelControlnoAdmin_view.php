<div class="row-fluid">
       <div class="span12">
               <div class="well">
                       <h6><center>Aqui puede cambiar sus datos personales y contraseña.</center></h6>
               </div>
       </div>
</div>

<div class="row-fluid">
    
       <?php
          
       
         if($this->session->flashdata('pass_correcto'))
       {
             echo '<div class ="alert alert-success"><a class="close" data-dismiss="alert">x</a>'.
                $this->session->flashdata('pass_correcto').'</div>';
        }
        
         if($this->session->flashdata('pass_incorrecto'))
       {
             echo '<div class ="alert alert-error"><a class="close" data-dismiss="alert">x</a>'.
                $this->session->flashdata('pass_incorrecto').'</div>';
             
        } 
        if ($this->session->flashdata('modificado_cliente')) 
        {
           echo $this->session->flashdata('modificado_cliente');
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

<script type="text/javascript">
    $(document).ready(function()
     {
         $('#actualizardatoscliente').click(function()
         {
             var ciudad = $(this).attr('ciudad');
             $('#datospersonalescliente').find('input#telcliente').val($(this).attr('telefono'));
             $('#datospersonalescliente').find('input#celcliente').val($(this).attr('cel'));
             $('#datospersonalescliente').find('#ciudadcliente > option').each(function()
            { 
                if($(this).text() === ciudad)
                {
                    $(this).prop('selected', true);
                }
                
            });
         });
		 
		 $('#actualizardatosempleado').click(function()
         {
             var ciudad = $(this).attr('ciudad');
             $('#datospersonalesempleado').find('input#telempleado').val($(this).attr('telefono'));
             $('#datospersonalesempleado').find('input#celempleado').val($(this).attr('cel'));
             $('#datospersonalesempleado').find('#ciudadempleado > option').each(function()
            { 
                if($(this).text() === ciudad)
                {
                    $(this).prop('selected', true);
                }
                
            });
         });
     });

</script>
<?php
	if(isset($datosUsuario))
	{ ?>
	<div class="row-fluid">

    <div class="accordion" id="panelcontrolcliente">
        <div  class="accordion-group span5 offset1">
            <div class="accordion-heading alert-info">
                <a id="actualizardatoscliente" ciudad="<?php echo $datosUsuario->ciudad_cliente ?>" telefono="<?php echo $datosUsuario->telefono ?>" cel="<?php echo $datosUsuario->telefono_cel ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#panelcontrolcliente" href="#datospersonalescliente">
                Actualizar sus datos personales
                </a>
            </div>
			
            <div id="datospersonalescliente" class="accordion-body collapse">
                <div class="accordion-inner">
                <!-- Modal para editar empresas(clientes) -->
                <form class="form-horizontal"  method = "post" action = "<?php echo base_url("index.php/clientes/editarCliente"); ?>"> 

                        <input value ="<?php echo $datosUsuario->id_cliente ?>" type="hidden" name="idCliente"> 
						<input value ="<?php echo $datosUsuario->nombre_cliente ?>" type="hidden" name="nombreCliente">
                          <div class="control-group">
                            <label class="control-label">Ciudad</label>
                              <div class="controls" >
                                <select id="ciudadcliente" name="ciudadCliente" class="input-large">
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
                                 <input id="clientefracc" type="text" value="<?php echo $datosUsuario->fracc_colonia_cliente ?>" name="fraccCliente" class="input-xlarge" placeholder="District">
                                </div>
                          </div>

                             <div class="control-group">
                              <label class="control-label">Calle</label>
                               <div class="controls">
                                  <input id="clientecalle" type="text" value="<?php echo $datosUsuario->calle ?>" name="calleCliente" class="input-xlarge" placeholder="Street">
                                </div>
                              </div>

                              <div class="control-group">
                                <label class="control-label">Teléfono</label>
                                   <div class="controls">
                                     <input id="telcliente" type="text" value="" name="telCliente" class="input-medium bfh-phone" data-format="01 (ddd) ddd-dddd" placeholder="Fijo">
                                   </div>
                               </div>

                                <div class="control-group">
                                  <label class="control-label">Teléfono celular</label>
                                    <div class="controls">
                                      <input id="celcliente"  type="text" value="" name="celCliente" class="input-medium bfh-phone" data-format="044 (ddd) ddd-dddd" placeholder="Movil">
                                    </div>
                                 </div>


                          <div class ="control-group"> 
                            <label class="control-label" for="email">Email</label>
                                <div class="controls">
                                    <input id="clienteemail" value="<?php echo $datosUsuario->email ?>" class="input-large" name="emailCliente" type="email" required>
                                </div>
                          </div>

                    <center>
                    <button class="btn btn-success" name="editarCliente" type="submit" value="editar">Editar</button></center>        

                </form>
            </div>
			</div>
		</div>
        

    <div class="accordion-group span5">
        <div class="accordion-heading alert-info">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#panelcontrolcliente" href="#contraseña">
            Actualizar contraseña de su cuenta
            </a>
        </div>
        <div id="contraseña" class="accordion-body collapse"> 
            <div class="accordion-inner">
            <!-- Modal para cambiar contraseñas de los usuarios del sistema -->
            <form class="form-horizontal" method="post" action="<?php echo base_url("index.php/panelControl/cambiarPass"); ?>">                      

                        <div class="control-group">
                            <label class="control-label" >Teclee la contraseña anterior</label>
                            <div class="controls">
                                <input value="" class="input-large" name="passUserAnt" type='password'/> 
                                <input value="<?php echo $datosUsuario->id_user?>" type="hidden" name="idUser" />
                            </div> 
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Teclee la nueva contraseña anterior</label>
                            <div class="controls">
                                <input type='password' value="" name="passUser1" class="input-large"  />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Repita nuevamente la  nueva contraseña</label>
                            <div class="controls">
                                <input type='password' value="" name="passUser2" class="input-large"/>
                            </div>
                        </div>


                        <center> <button class='btn btn-danger' type="submit" value="cambiar" name="cambiarPass">Cambiar contraseña</button>
                        <button class='btn' type="reset">Cancelar</button></center>
                      </form>   
                     </div>
                
                </div>
            </div>
			
        </div>
    </div>
 <?php }?>
 
 <?php
	if(isset($datosUsuarioEmp))
	{ ?>
	<div class="row-fluid">

    <div class="accordion" id="panelcontrolempleado">
        <div  class="accordion-group span5 offset1">
            <div class="accordion-heading alert-info">
                <a id="actualizardatosempleado" ciudad="<?php echo $datosUsuarioEmp->ciudad ?>" telefono="<?php echo $datosUsuarioEmp->telefono ?>" cel="<?php echo $datosUsuarioEmp->telefono_cel ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#panelcontrolemplado" href="#datospersonalesempleado">
                Actualizar sus datos personales
                </a>
            </div>
            <div id="datospersonalesempleado" class="accordion-body collapse">
                <div class="accordion-inner">
                <!-- Modal para editar empresas(clientes) -->
                <form class="form-horizontal"  method = "post" action = "<?php echo base_url("index.php/empleados/editarEmpleado"); ?>"> 

                        <input value ="<?php echo $datosUsuarioEmp->id_empleado ?>" type="hidden" name="idEmpleado">
						<input value ="<?php echo $datosUsuarioEmp->nombres ?>" type="hidden" name="nombreEmpleado">
						<input value ="<?php echo $datosUsuarioEmp->apellido_paterno ?>" type="hidden" name="apellidoPatEmp">
						<input value ="<?php echo $datosUsuarioEmp->apellido_materno ?>" type="hidden" name="apellidoMatEmp">
                          <div class="control-group">
                            <label class="control-label">Ciudad</label>
                              <div class="controls" >
                                <select id="ciudadempleado" name="ciudadEmpleado" class="input-large">
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
                                 <input  type="text" value="<?php echo $datosUsuarioEmp->colonia ?>" name="fraccEmpleado" class="input-xlarge" placeholder="District">
                                </div>
                          </div>

                             <div class="control-group">
                              <label class="control-label">Calle</label>
                               <div class="controls">
                                  <input  type="text" value="<?php echo $datosUsuarioEmp->direccion ?>" name="calleEmpleado" class="input-xlarge" placeholder="Street">
                                </div>
                              </div>

                              <div class="control-group">
                                <label class="control-label">Teléfono</label>
                                   <div class="controls">
                                     <input id="telempleado" type="text" value="" name="telEmpleado" class="input-medium bfh-phone" data-format="01 (ddd) ddd-dddd" placeholder="Fijo">
                                   </div>
                               </div>

                                <div class="control-group">
                                  <label class="control-label">Teléfono celular</label>
                                    <div class="controls">
                                      <input id="celempleado"  type="text" value="" name="celEmpleado" class="input-medium bfh-phone" data-format="044 (ddd) ddd-dddd" placeholder="Movil">
                                    </div>
                                 </div>


                          <div class ="control-group"> 
                            <label class="control-label" for="email">Email</label>
                                <div class="controls">
                                    <input id="clienteemail" value="<?php echo $datosUsuarioEmp->email ?>" class="input-large" name="emailEmpleado" type="email" required>
                                </div>
                          </div>

                    <center>
                    <button class="btn btn-success" name="editarEmpleado" type="submit" value="editar">Editar</button></center>        

                </form>
            </div>
		</div>
	</div>
        

    <div class="accordion-group span5">
        <div class="accordion-heading alert-info">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#panelcontrolempleado" href="#contraseña">
            Actualizar contraseña de su cuenta
            </a>
        </div>
        <div id="contraseña" class="accordion-body collapse"> 
            <div class="accordion-inner">
            <!-- Modal para cambiar contraseñas de los usuarios del sistema -->
            <form class="form-horizontal" method="post" action="<?php echo base_url("index.php/panelControl/cambiarPass"); ?>">                      

                        <div class="control-group">
                            <label class="control-label" >Teclee la contraseña anterior</label>
                            <div class="controls">
                                <input value="" class="input-large" name="passUserAnt" type='password'/> 
                                <input value="<?php echo $datosUsuarioEmp->id_user?>" type="hidden" name="idUser" />
                            </div> 
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Teclee la nueva contraseña anterior</label>
                            <div class="controls">
                                <input type='password' value="" name="passUser1" class="input-large"  />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Repita nuevamente la  nueva contraseña</label>
                            <div class="controls">
                                <input type='password' value="" name="passUser2" class="input-large"/>
                            </div>
                        </div>


                        <center> <button class='btn btn-danger' type="submit" value="cambiar" name="cambiarPass">Cambiar contraseña</button>
                        <button class='btn' type="reset">Cancelar</button></center>
                      </form>   
                     </div>
                
                </div>
            </div>
		</div>
        </div>
    
 <?php }?>
