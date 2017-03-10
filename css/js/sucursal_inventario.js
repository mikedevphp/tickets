/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (typeof location.origin === 'undefined')
{
    location.origin = location.protocol + '//' + location.host;
}

var base_url = location.origin +'/proyectos/tickets/';

$(document).ready(function()
{
   //console.log(base_url); 
   
         
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
    
    
    
    function addon(addon)
    {
        var self = this;
        self.addon = addon;
        self.nombre = ko.observable(self.addon.nombre);
        self.inv_id = ko.observable(self.addon.inv_id);
        self.sucursal_id = ko.observable(self.addon.sucusal_id);
        self.inv_com_id = ko.observable(self.addon.inv_com_id);
        self.placa_activo = ko.observable(self.addon.placa_activo);
        self.placa_activo_value = ko.observable('');
        self.showEdit = ko.observable(false);
        self.edit = function()
        {
            if(self.showEdit())
            {
                if(self.placa_activo_value().length > 0)
                {
                    self.placa_activo(self.placa_activo_value());
                    
                    $.post(base_url+'index.php/inventario/saveAddon',
                    {
                        inv_com_id:self.inv_com_id(),
                        placa_activo : self.placa_activo_value()
                    },
                    function(response)
                    {
                        console.log(response);
                    },'json');
                    
                    console.log(self.placa_activo_value());
                }
                
                self.showEdit(false);
                
            }
            else
            {
                self.showEdit(true);
                
            }
            
            self.placa_activo_value('');
        };
        
        //self.id = id;
        //self.nombre = nombre;
    }
    
    function item(item)
    {
        var self = this;
        // asignar el objeto del contructor, a la referencia K.o.
        
            self.item = item;
       //console.log(self.item.componente_id);
        self.articulo_id = ko.observable(self.item.articulo_id);
        self.inv_id = ko.observable(self.item.inv_id);
        self.sucursal_id = ko.observable(self.item.sucusal_id);
        self.nombre = ko.observable(self.item.nombre);
        self.descripcion_alt = ko.observable(self.item.descripcion_alt);
        self.descripcion_alt_value = ko.observable(''); 
        self.componente = ko.observableArray();
        self.eye = ko.observable(false);
        self.showEdit = ko.observable(false);
        self.hrefInv = 
                ko.observable(base_url+'index.php/inventario/sucursal/'+self.sucursal_id()+'/inventarioDetalle/'+self.inv_id());
        self.edit = function()
        {
           
                
            if(self.showEdit())
            {
                
                
                
                if(/*confirm('¿Desea guardar los cambios?') && */self.descripcion_alt_value().length > 0)
                {
                    self.descripcion_alt(self.descripcion_alt_value());
                    
                    $.post(base_url+'index.php/inventario/saveItem',
                    {
                        inv_id:self.inv_id(),
                        descripcion_alt : self.descripcion_alt_value()
                    },
                    function(response)
                    {
                        console.log(response);
                    },'json')/*
                    .error(function()
                    {
                        alert('Error');
                    }
                    )*/;
                    
                    console.log(self.descripcion_alt_value());
                }
                
                self.showEdit(false);
                
            }
            else
            {
                self.showEdit(true);
                
            }
            
            self.descripcion_alt_value('');
        };
        
        self.removeAddon = function(addon)
        {
            console.log(addon.inv_com_id());
            
            if(confirm('¿Quiere eliminar este registro?'))
            {
                $.post(base_url+'index.php/inventario/deleteAddon/',
                {
                    inv_id : addon.inv_id(),
                    sucursal_id:addon.sucursal_id(),
                    inv_com_id: addon.inv_com_id()
                    
                },
                function(response)
                {
                    //console.log(response);
                    if(response.msg)
                    {
                        self.componente.remove(addon);
                    }
                    
                },'json');
                
                
            }
            
        };
        
        self.addAddon = function()
        {
            self.componente.push(new addon({}));
        };
        
        
        
        self.showDetail = function()
        {
            if(self.eye())
            {
                self.eye(false);
                
            }
            else
            {
                 
                self.eye(true);
            }
        };
        
        $.get(base_url+'index.php/inventario/getAddonByItemId' + '/' + self.inv_id(),
        function(response)
        {
            for(var i in response.msg)
            {
                self.componente.push(new addon(response.msg[i]));
            }
        },'json');
        
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
        
        self.removeItem = function(item)
        {
            self.items.remove(item);
        };
        
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
         
         
         $.post(base_url+'index.php/inventario/saveItemInventory',
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
            
            $.get(base_url+'index.php/inventario/getTypeItems'+'/'+self.sucursal(),
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
                console.log(items);
                
                //self.componente_check(0);
            });
        };
        
        self.init();
    
};