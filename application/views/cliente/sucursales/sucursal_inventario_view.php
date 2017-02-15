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
    
    
    
    function item(item)
    {
        var self = this;
        // asignar el objeto del contructor, a la referencia K.o.
        
            self.item = item;
       //console.log(self.item.componente_id);
        //self.id = item.id;
        self.nombre = ko.observable(self.item.nombre);
        self.descripcion_alt = ko.observable(self.item.descripcion_alt);
        
        
        
    }
    
    function addonModel(id, nombre)
    {
        var self = this;
        
        self.id = id;
        self.nombre = nombre;
    }
    
    function viewModel()
    {
        var self = this;
        
        self.hide = ko.observable(1);
        self.itemType = ko.observableArray([]);
        self.addonsType = ko.observableArray([]);
        self.placa = ko.observable('');
        self.desc = ko.observable('');
        self.sucursal = ko.observable($("#sucursalID").text());
        self.selectedItemType = ko.observable();
        self.items = ko.observableArray();
        self.selectedAddonTypeArr = ko.observableArray([]);
        self.componente_check = ko.observable(0);
        self.selectedsAddons = ko.observableArray();
        self.selectedsAddons()[0] = {id:'0',placa_activo:'',nombre:''};
        self.addAddon = ko.observableArray();
        
        
        self.componente_check.subscribe(function(value)
        {
            //console.log(value);
            
            if(!value)
            {
                self.selectedAddonTypeArr.removeAll();
                
                for(var i in self.selectedsAddons())
                {
                    self.selectedsAddons()[i].placa_activo = '';
                }
                
                
            }
            
            if(value)
            {
                self.placa('');
            }
        });
        
        self.selectedAddonTypeArr.subscribe(function(value) 
        {
            //alert("The person's new name is " + newValue);
            //console.log(value);
            
            for(var i in self.selectedsAddons())
            {
                val = parseInt(Object.keys(self.selectedsAddons())[i]);
                // existe
                if(value.indexOf(i) === -1)
                {
                    console.log(val);
                    self.selectedsAddons()[val].placa_activo = '';
                    continue;
                    //self.selectedsAddons()[i] = '';
                }
                
                
                //console.log(value.indexOf(i));
            }
           
            //console.log(self.selectedsAddons());
            //console.log(value);
        });
        
        self.setTitle = function(option, item) 
        {
            option.title = item.nombre;
            self.selectedsAddons()[item.componente_id] = {id:item.componente_id,placa_activo:'',nombre:item.nombre};
            //console.log(self.selectedsAddons());
        };
        
        self.save = function()
        
        {
            console.log(self.selectedsAddons());
         for(var i in self.selectedsAddons())
         {
             
                // val = parseInt(Object.keys(self.selectedsAddons())[i]);
                // existe
                if(self.selectedAddonTypeArr.indexOf(i) === -1)
                {
                    //console.log(val);
                    delete(self.selectedsAddons()[i]);
                    continue;
                    //self.selectedsAddons()[i] = '';
                }
             
             
             //;
         }
         
         
         $.post('<?php echo base_url('index.php/inventario/saveItemInventory');?>',
          {
              sucursal_id:self.sucursal(),
              placa_activo:self.placa(),
              descripcion_alt:self.desc(),
              articulo_id:self.selectedItemType(),
              componente_id:JSON.stringify(self.selectedsAddons())
          },
          function(response)
          {
              res = JSON.parse(response);
              //console.log(res);
              if(res.msg)
              {
                  alert('Se ha creado su articulo.');
                  window.location.reload();
                  //self.init();
                  return;
              }
              
              alert('Error');
              window.location.reload();
              return;
              
          });
           
           //console.log(self.selectedItemType());*/
           //console.log(self.selectedsAddons());
        };
        
        
        self.showModal = function()
        {
            self.hide(0);
           
            
        };
        
        self.hideModal = function()
        {
            self.hide(1);
            
            self.componente_check(0);
            
        };
        
        self.init = function()
        {
            
            $.get('<?php echo base_url('index.php/inventario/getTypeItems');?>'+'/'+self.sucursal(),
            function(response)
            {
                itemsTypes = JSON.parse(response).itemsTypes;
                addonsType = JSON.parse(response).addonsType;
                items = JSON.parse(response).items;
                for(var i in itemsTypes)
                {
                    self.itemType.push(itemsTypes[i]);
                }
                
                for(var i in addonsType)
                {
                    self.addonsType.push(addonsType[i]);
                }
                
                for(var i in items)
                {
                    /*if(items[i].componente_id === null)
                    {
                        self.items.push(new item(items[i]));
                    }
                    else
                    {
                        console.log(items[i]);
                    }*/
                    self.items.push(new item(items[i]));
                    //console.log(items[i]);
                }
                //console.log(items);
                
                //self.componente_check(0);
            });
        };
        
        self.init();
    }
    
</script>

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
                <table class="table table-striped table-hover">
                    <thead>
                    <th>Articulo</th>
                    <th>Descripcion</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    </thead>
                    <tbody data-bind="foreach: items">
                         <tr>
                             <td data-bind="text: item.nombre"></td>
                             <td data-bind="text: item.descripcion_alt"></td>
                             <td><button  class="btn btn-xs btn-success"><i class="icon-eye-close icon-white"></i></button></td>
                             <td><button  class="btn btn-xs btn-danger"><i class="icon-trash icon-white"></i></button></td>
                             <td><button  class="btn btn-xs btn-info"><i class="icon-pencil icon-white" ></i></button></td>
                         </tr>
                         <tr>
                             <td><small>Componentes</small></td>
                             <td>
                                 <ol >
                                <li>tefv</li>
                                <li>tefv</li>
                                </ol>
                             </td>
                             <td>
                                 <ul>
                                <li>action</li>
                                <li>action</li>
                                </ul>
                             </td>
                             <td></td>
                             <td></td>
                         </tr>
                     </tbody>
                </table>
            
         <hr>
         
        </div>
</div>

