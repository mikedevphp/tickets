<!-- NAV PARA CADA MODULO -->

<ul class="nav nav-pills">
  <li class="active">
    <a href="<?php echo base_url("index.php/sucursales"); ?>">Sucursales</a>
  </li>
  <li><a href="<?php echo base_url("index.php/sucursales/crearSucursal"); ?>">Crear sucursal</a></li>
  
  
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
            <legend class ="text-info"><center><p> Nueva sucursal </p></center> </legend>

            <form method="post" action="<?php base_url('index.php/clientes/crearSucursal') ?>" class="form-horizontal">

                    <fieldset>
                        <div class="control-group">
                          <label class="control-label">Número</label>
                              <div class="controls">
                                    <input type="hidden" name="empresa" value="<?php echo $idCliente ?>" />
                                    <input type="text" name="numeroSuc" class="input-medium" placeholder="Subsidiary">
                              </div>
                        </div>

                        <div class="control-group">
                          <label class="control-label">Nombre</label>
                              <div class="controls">
                                  <input type="text" name="nombreSuc" class="input-large" placeholder="Subsidiary">
                              </div>
                        </div>

                        <div class="control-group">
                          <label class="control-label">Ciudad</label>
                              <div class="controls" >
                                  <select name="ciudadSuc" class="input-large">
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
                          <label class="control-label">Fracc./Colonia</label>
                              <div class="controls">
                                  <input type="text" name="fraccSuc" class="input-xlarge" placeholder="District">
                              </div>
                        </div>

                        <div class="control-group">
                          <label class="control-label">Calle</label>
                              <div class="controls">
                                  <input type="text" name="calleSuc" class="input-xlarge" placeholder="Street">
                              </div>
                        </div>

                        <div class="control-group">
                          <label class="control-label">Teléfono</label>
                              <div class="controls">
                                  <input type="text" name="telSuc" class="input-medium bfh-phone" data-format="01 (ddd) ddd-dddd" placeholder="Phone">
                              </div>
                        </div>

                        <div class="control-group">
                          <label class="control-label">Teléfono celular</label>
                              <div class="controls">
                                  <input type="text" name="celSuc" class="input-medium bfh-phone" data-format=" 044 (ddd) ddd-dddd" placeholder="Movil">
                              </div>
                        </div>

                      <div>
                        <center>                  
                          <button type="reset" class="btn btn-danger" type="button">Cancelar</button>
                          <button type="submit" value="registrar" class="btn btn-success" name="registrarSucursal">Registrar</button>          
                        </center>

      </fieldset>
    </form>


    </div>
</div>
</div>