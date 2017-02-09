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
    height: 40%;
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
</style>
<script type="text/javascript" src="<?php echo base_url('css/js/knockout-3.3.0.js')?>"></script>
<script type="text/javascript" >
    $(document).ready(function()
    {
         
        /* ko.components.register('modal-widget', {
    viewModel: function() 
    {
        // Data: value is either null, 'like', or 'dislike'
        
        self = this;
        self.hide = ko.observable(1);
        self.showModal = function()
        {
            self.hide(0);
           
            
        };
        
        self.hideModal = function()
        {
            self.hide(1);
        };
        
        //console.log(params);
        /*this.chosenValue = params.value;
         
        // Behaviors
        this.like = function() { this.chosenValue('like'); }.bind(this);
        this.dislike = function() { this.chosenValue('dislike'); }.bind(this);
    },
    template:
           '<button class="btn btn-xs btn-success pull-right" data-bind="click: showModal"><i class="icon-plus icon-white" ></i></button>\
         <div id="myModal" data-bind="style:{display:hide() ? \'none\' : \'block\'}" class="modal">\
  <div class="modal-content">\
    <div class="modal-header">\
      <span class="close" data-bind="click:hideModal">&times;</span>\
      <h2>Modal Header</h2>\
    </div>\
    <div class="modal-body">\
      <p>Some text in the Modal Body</p>\
      <p>Some other text...</p>\
    </div>\
    <div class="modal-footer">\
      <h3>Modal Footer</h3>\
    </div>\
  </div>\
</div>'

});*/
         
         ko.applyBindings(new viewModel());
    });
    
    
    
    function itemModel()
    {
        
    }
    
    function viewModel()
    {
        self = this;
        self.hide = ko.observable(1);
        self.itemType = ko.observableArray([]);
        self.addonsType = ko.observableArray([]);
        self.placa = ko.observable('');
        self.desc = ko.observable('');
        self.sucursal = ko.observable($("#sucursalID").text());
        self.selectedItemType = ko.observable();
        self.selectedAddonType = ko.observableArray([]);
        self.componente_check = ko.observable(0);
        //self.selectedsAddons = ko.observableArray();
        
        self.save = function()
        {
         /* $.post('<?php echo base_url('index.php/inventario/saveItemInventory');?>',
          {
              sucursal_id:self.sucursal(),
              placa_activo:self.placa(),
              descripcion_alt:self.desc(),
              articulo_id:self.selectedItemType(),
              componente_id:JSON.stringify(self.selectedAddonType())
          },
          function(response)
          {
              res = JSON.parse(response)
              
              if(res.msg=='true')
              {
                  alert();
                  return;
              }
              
              alert();
          });*/
           
           //console.log(self.selectedItemType());
           console.log(self.selectedAddonType());
        };
        
        
        self.showModal = function()
        {
            self.hide(0);
           
            
        };
        
        self.hideModal = function()
        {
            self.hide(1);
        };
        
        self.init = function()
        {
            $.get('<?php echo base_url('index.php/inventario/getTypeItems');?>',
            function(response)
            {
                itemsTypes = JSON.parse(response).itemsTypes;
                addonsType = JSON.parse(response).addonsType;
                for(var i in itemsTypes)
                {
                    self.itemType.push(itemsTypes[i]);
                }
                
                for(var i in addonsType)
                {
                    self.addonsType.push(addonsType[i]);
                }
                
                
            });
        }();
        
    }
    
</script>

<div class="row-fluid">
    <div class="span6">
    <ul class="breadcrumb">
    <li><a href="<?php echo base_url("index.php/clientes"); ?>">Clientes</a> <span class="divider">/</span></li> 
    <li class="active"><a hre="">Sucursal</a><span class="divider">/</li>
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
                                  optionsText:'nombre',optionsValue:'componente_id', selectedOptions: function(){selectedAddonType().push($data);}" multiple="true">
                              
                          </select>
                      </div>
                    </div>
                      <div data-bind="visible: componente_check() && selectedAddonType().length > 0" class="control-group" style="margin-right:900px;">
                      <label class="control-label" >Componentes Placa</label>
                      <div class="controls" data-bind="foreach: selectedAddonType">
                          <input type="text" 
                                 class="input-xlarge" data-bind=""/>
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
                <table class="table table-striped table-hover">
                    <thead>
                    <th>Articulo</th>
                    <th></th>
                    <th></th>
                    </thead>
                     <tbody>
                         <tr>
                             <td>edth</td>
                             <td><button  class="btn btn-xs btn-danger"><i class="icon-trash icon-white"></i></button></td>
                             <td><button data-bind="click: showModal" class="btn btn-xs btn-info"><i class="icon-pencil icon-white" ></i></button></td>
                         </tr> 
                     </tbody>
                </table>
            
         <hr>
         
        </div>
</div>

