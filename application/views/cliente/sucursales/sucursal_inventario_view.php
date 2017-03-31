<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($this->session->userdata('logged_user'));
?>
<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    margin-left: 0px;
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 50%;
    height: 50%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: black;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #fefefe;
    color: black;
}

.modal-body 
{
    
    height: 80%;
    padding: 2px 16px;
}

.modal-footer {
    padding: 10px 16px;
    background-color: #fefefe;
    color: black;
}

/*table {
    border-collapse: collapse;
}

td {
    position: relative;
    padding: 5px 10px;
}

tr.strikeout td:before {
    content: " ";
    position: absolute;
    top: 50%;
    left: 0;
    border-bottom: 1px solid #111;
    width: 100%;
}*/
</style>
<script type="text/javascript" src="<?php echo base_url('css/js/knockout-3.3.0.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('css/js/sucursal_inventario.js')?>"></script>


<div class="row-fluid">
    <div class="span6">
    <ul class="breadcrumb">
    <li><a href="<?php echo base_url("index.php/clientes"); ?>">Clientes</a> <span class="divider">/</span></li> 
    <li class="active"><a hre="">Sucursal</a><span class="divider">/</li>
    <li class="active"><a hre="">Inventario</a><span class="divider">/</li>
    <li id="sucursalID" class="active"><?php echo $sucursal;?></li>
    </ul>
    </div>
    </div>
<div class="row-fluid">
    
    <div class="span10 offset1" id="div_table_items">
            <h4></h4>
            <center><button class="btn btn-xs btn-success pull-right" data-bind="click: showModal"><i class="icon-plus icon-white" ></i></button>
            <div id="myModal" data-bind="style:{display:hide() ? 'none' : 'block'}" class="modal">
            <div class="modal-content">
              <div class="modal-header">
                <span class="close" data-bind="click:hideModal">&times;</span>
                <h2>Articulo</h2>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal" style="margin-top:10px;">
                    <div class="control-group" style="margin-right:900px;">
                      <label class="control-label" >Placa Activo</label>
                      <div class="controls">
                          <input type="text" data-bind="textInput: placa,disable: componente_check()" class="input-xlarge" placeholder="Placa Activo">
                      </div>
                      
                    </div>
                      <div class="control-group" style="margin-right:900px;">
                      <label class="control-label" >Articulo</label>
                      <label class="control-label" >Componentes</label>
                      <div class="controls">
                          
                          <select class="input-xlarge" data-bind="options: itemType, 
                                  optionsText:'nombre',optionsValue:'articulo_id',value: selectedItemType">
                              
                          </select>
                          <input type="checkbox" data-bind="checked:componente_check"/>
                      </div>
                    </div>
                      <div data-bind="visible: componente_check()" class="control-group" style="margin-right:900px;">
                      <label class="control-label" >Componentes</label>
                      <div class="controls">
                          <select class="input-xlarge" data-bind="options: addonsType, 
                                  optionsText:'nombre',optionsValue:'componente_id', selectedOptions: selectedAddonTypeArr,
                            optionsAfterRender: $root.setTitle" multiple="true">
                              
                          </select>
                      </div>
                    </div>
                      <div data-bind="visible: componente_check() && selectedAddonTypeArr().length > 0" class="control-group" style="margin-right:900px;">
                      <label class="control-label" >Componentes Placa</label>
                      <div class="controls" data-bind="foreach: selectedAddonTypeArr">
                          <input type="text" 
                                 class="input-xlarge" data-bind="value: $root.selectedsAddons()[$data].placa_activo, attr:{placeholder:'Placa de ' + $root.selectedsAddons()[$data].nombre}" />
                          
                      </div>
                    </div>
                    <div class="control-group" style="margin-right:900px;">
                      <label class="control-label">Descripcion alterna</label>
                      <div class="controls" >
                        <input data-bind="textInput: desc" class="input-xlarge" type="text"  placeholder="Descripcion alterna">
                      </div>
                    </div>
                    
                </form>
              </div>
              <div class="modal-footer">
                  <button type="submit" data-bind="click:save" class="btn btn-success">Guardar</button>
              </div>
            </div>
            </div>
            </center>
            <!-- Edit Item Descripcion -->
            <script type="text/html" id="description-template">
                <span data-bind="text: descripcion_alt, visible: !showEdit()"></span>
                <input type="text" data-bind="value: descripcion_alt_value, visible: showEdit()" />
            </script>
            
            <!-- Edit Componente -->
            <script type="text/html" id="edit-componente-template">
                <li>
            <label>Componente : <span data-bind="text: (nombre() == null) ? 'S/N' : nombre"></span></label>
                </li>
                <li>
             <label> N° de Placa :<span data-bind="text: placa_activo, visible: !showEdit()"></span> </label>
             <input type="text" data-bind="value: placa_activo_value, visible: showEdit()" class="input-medium"/>
                </li>
             </script>    
            <!-- Comment Delete --> 
            <script type="text/html" id="delete_comment-template">
            <button data-bind="click: $parent.removeItem, visible: (is_deleted() == '0') ? true : false"  class="btn btn-xs btn-danger">
                <i class="icon-trash icon-white"></i>
            </button> 
             </script>
             
             
             
             <table class="table table-striped" >
                    <thead>
                    <th>Articulo</th>
                    <th>Descripcion</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    </thead>  
                    <tbody data-bind="foreach: items">
                        <tr data-bind="css: (is_deleted() != '0') ? 'warning' : ''">
                             <td data-bind="text: nombre"></td>
                             <td data-bind="template: {name:'description-template',data: $data}"></td>
                             <td><button data-bind="click: showDetail, visible: (is_deleted() == '0') ? true : false" title="Mostrar componentes" class="btn btn-xs btn-success"><i class="icon-eye-close icon-white"></i></button></td>
                             <td><button  class="btn btn-xs btn-info" title="Editar articulo" data-bind="click: edit, visible: (is_deleted() == '0') ? true : false"><i class="icon-pencil icon-white" ></i></button></td>
                             <td data-bind="template: 
                                    {
                                        name:'delete_comment-template',
                                        params: 
                                                { 
                                                    data: $data ,
                                            // pasamos el contexto
                                                    context: $context
                                                }
                                    }"></td>
                             <td><a title="Detalles del inventario" data-bind="attr:{'href':hrefInv()}" class="btn btn-xs"><i class="icon-th-list"></i></a></td>
                         </tr>
                         <tr  data-bind="visible: commentDelete">
                             <td></td>
                             <td></td>
                             <td></td>
                             <td colspan="3">
                                 <textarea data-bind="value: commentdeletevalue" style="resize:none;" cols="25" rows="3"></textarea>
                             </td>
                            
                         </tr>
                         <tr data-bind="visible: eye" >
                             
                         </tr>
                    
                         <tr data-bind="visible: eye">
                        <td >
                                 <small>Agregar</small>
                                 <button data-bind="click:addAddon" class="btn btn-mini btn-success">+</button>
                            </td> 
                             <td colspan="5">
                         
                            <div data-bind="foreach: componente">
                                 
                                 <ol style="list-style-type:none;" data-bind="">
                                     
                                         <div data-bind="template: {name:'edit-componente-template',data: $data}"></div>
                                         <li>
                                       <button data-bind="click:edit" class="btn btn-mini btn-info">
                                           <i class="icon-pencil icon-white" ></i></button>
                                           
                                    <button data-bind="click:$parent.removeAddon" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i></button>
                                         </li>
                                         <li style="margin-top:10px;">
                                    <textarea data-bind="value: commentaddondeletevalue, visible: commentAddonDelete()" style="resize:none;" cols="25" rows="2"></textarea>  
                                           </li>
                                     
                                     
                                        
                                    </ol>
                            </div>  
                                
                        </td>
                        
                             
                             <!--<td>
                                 
                             </td>
                             <td>
                                 
                             </td>
                             <td></td>
                             <td></td>-->
                       
                         </tr>
                    
                     </tbody>
                </table>
             
            <table>
  
</table>
         <hr>
         
        </div>
</div>

