<div class="row-fluid">
    <ul class="breadcrumb">
    <li><a href="<?php echo base_url("index.php/clientes"); ?>">Clientes</a> <span class="divider">/</span></li> 
    <li class="active">Sucursales</li>
    </ul>

</div>
<script src="<?= base_url('css/js/modalsucursales.js') ?>"></script>
 
<div class="row-fluid">
    
    <?php
    
        if(isset($sucursales))
        {
            echo "<caption><center>Sucursales registradas para la empresa ".$sucursales[0]->empresa.".</center></caption></br>";
            
            echo "<table class ='table table-bordered table-condensed'>
            <thead><tr><th class='alert alert-info'>CR de Tienda</th><th class='alert alert-info'>Nombre de sucursal</th><th class='alert alert-info'>Ciudad</th>
            <th class='alert alert-info'>Fracc/Colonia</th><th class='alert alert-info'>Calle</th><th class='alert alert-info'>Telefono</th><th class='alert alert-info'>Telefono Celular</th>
            <th class='alert alert-info'>Editar</th><th class='alert alert-info'>Eliminar</th></tr></thead><tbody>";
            
            foreach($sucursales as $row)
            { 
                echo "<tr><td>".$row->id_sucursal."</td><td>".$row->nombre_sucursal."</td><td>".
                      $row->ciudad_suc."</td><td>".$row->fracc_colonia_suc."</td><td>".
                       $row->direccion."</td><td>".$row->telefono."</td><td>".$row->telefono_cel_suc."</td>
                       <td><a class='btn-small btn-warning' href='#modalEditarSucursal' editarsuc='' data-toggle ='modal' numsuc='".$row->id_sucursal."'
                      idcliente='".$row->id_cliente."' empresa='".$row->empresa."' nomsuc='".$row->nombre_sucursal."' ciudadsuc='".$row->ciudad_suc."' 
                       fraccsuc='".$row->fracc_colonia_suc."' callesuc ='".$row->direccion."' 
                       telsuc='".$row->telefono."' celsuc='".$row->telefono_cel_suc."'><i class='icon-pencil icon-white'></a></td>
                       <td><a class='btn-small btn-danger' href='#modalEliminarSucursal' eliminarsuc='' empresa='".$row->empresa."' 
                       idcliente='".$row->id_cliente."' idsuc='".$row->id_sucursal."' data-toggle ='modal' ><i class='icon-trash icon-white'></a></td>";
                echo "</tr>";
            }
            
            echo "</tbody></table>";
           
        }
        
        
    
    ?>
    
</div>

<div class="row-fluid">
    
    <!-- Modal para eliminar sucursales -->
    <form  method = "post" action = "<?php echo base_url("index.php/clientes/eliminarSucursal"); ?>"> 
        <div id="modalEliminarSucursal" class="modal hide fade">
            <div class="modal-header">
                <h4 id="myModalLabel">Advertencia</h4>
            </div>
            <div class="modal-body">
                <label>¿Desea eliminar la sucursal?.</label>
                <input type="hidden" name="idCliente" value="" id="idclientesuc"/> 
                <input type="hidden" name="idSuc" value="" id="idsuc"/>
                <input type="hidden" name="empresa" value="" id="empresa"/>
            </div>
             <div class="modal-footer">
                <button type="submit" name ="eliminarSucursal" value ="eliminar" class="btn btn-danger">Sí</button>
                <button class="btn" data-dismiss="modal">No</button>
             </div>      
        </div>
    </form>
    
    <!-- Modal para editar sucursales -->
    <form class="form-horizontal"  method = "post" action = "<?php echo base_url("index.php/clientes/editarSucursal"); ?>"> 
        <div id="modalEditarSucursal" class="modal hide fade">
            <div class="modal-header">
                <h4 id="myModalLabel">Edición de la Sucursal</h4>
            </div>
            <div class="modal-body">
                <div class="control-group">
                        <label class="control-label">N° de sucursal</label>
                            <div class="controls">
                            <input id="numsucursal" value="" type="text" name="numSucursal" class="input-large" placeholder="Nombre sucursal">
                            <input id="empresaeditar" value ="" type="hidden" name="empresa"> 
                            <input id="idempresaeditar" value ="" type="hidden" name="idEmpresa"> 
                            </div>
                      </div>

                <div class="control-group">
                        <label class="control-label">Nombre de sucursal</label>
                            <div class="controls">
                            <input id="nomsucursal" value="" type="text" name="nomSucursal" class="input-large" placeholder="Nombre sucursal"> 
                            </div>
                      </div>
                
                      <div class="control-group">
                        <label class="control-label">Ciudad</label>
                          <div class="controls" >
                            <select id="sucursalciudad" name="ciudadSucursal" class="input-large">
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
                             <input id="sucursalfracc" type="text" value="" name="fraccSucursal" class="input-xlarge" placeholder="Fracc/Colonia">
                            </div>
                      </div>

                         <div class="control-group">
                          <label class="control-label">Calle</label>
                           <div class="controls">
                              <input id="sucursalcalle" type="text" value="" name="calleSucursal" class="input-xlarge" placeholder="Calle">
                            </div>
                          </div>

                          <div class="control-group">
                            <label class="control-label">Teléfono</label>
                               <div class="controls">
                                 <input id="sucursaltel" type="text" value="" name="telSucursal" class="input-medium bfh-phone" data-format="01 (ddd) ddd-dddd" placeholder="Fijo">
                               </div>
                           </div>

                            <div class="control-group">
                              <label class="control-label">Teléfono celular</label>
                                <div class="controls">
                                  <input id="sucursalcel" type="text" value="" name="celSucursal" class="input-medium bfh-phone" data-format="044 (ddd) ddd-dddd" placeholder="Movil">
                                </div>
                             </div>

            </div>
             <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger" >Cancelar</button>
                <button class="btn btn-success" name="editarSucursal" type="submit" value="editar">Editar</button>        
             </div>      
        </div>
    </form>
      
</div>