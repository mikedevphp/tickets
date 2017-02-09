<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($this->session->userdata('logged_user'));
?>

<script type="text/javascript" src="<?php echo base_url('css/js/knockout-3.3.0.js')?>"></script>
<script type="text/javascript" >
    $(document).ready(function()
    {
         
         ko.components.register('modal-widget', {
    viewModel: function() 
    {
        // Data: value is either null, 'like', or 'dislike'
        
        self = this;
        self.hide = ko.observable(1);
        self.showModal = function()
        {
            self.hide(0);
            document.getElementsByTagName('body')[0].style.backgroundColor = black;
            
        };
        
        self.hideModal = function()
        {
            self.hide(1);
        };
        
        //console.log(params);
        /*this.chosenValue = params.value;
         
        // Behaviors
        this.like = function() { this.chosenValue('like'); }.bind(this);
        this.dislike = function() { this.chosenValue('dislike'); }.bind(this);*/
    },
    template:
        '<div data-bind="style:{display:hide() ? \'none\' : \'block\'}" \
         class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">\
      <div class="modal-header">\
        <button type="button" class="close" aria-hidden="true">&times;</button>\
        <h3>Modal header</h3>\
      </div>\
      <div class="modal-body">\
        <p>One fine body…</p>\
      </div>\
      <div class="modal-footer">\
        <a class="btn" data-bind="click: hideModal" >Close</a>\
        <a class="btn btn-primary">Save changes</a>\
      </div>\
    </div>\
<button class="btn btn-xs btn-success pull-right" data-bind="click: showModal"><i class="icon-plus icon-white" ></i></button>'
        
});
         
         ko.applyBindings(new viewModel());
    });
    
    
    function viewModel()
    {
        var self = this;
        
    }
    
</script>
<div class="row-fluid">
    <div class="span6">
    <ul class="breadcrumb">
    <li><a href="<?php echo base_url("index.php/clientes"); ?>">Clientes</a> <span class="divider">/</span></li> 
    <li class="active"><a hre="">Sucursal</a><span class="divider">/</li>
    <li class="active"><?php echo $sucursal;?></li>
    </ul>
    </div>
    </div>
<div class="row-fluid">
    <div class="span10 offset1" id="div_table_items">
            <h4></h4><hr> 
            <modal-widget></modal-widget>
                <table class="table table-striped table-hover">
                       
                       
                    
                    <thead>
                    <th>Articulo</th>
                    <th></th>
                    <th></th>
                    </thead>
                     <tbody>
                         <tr>
                             <td>edth</td>
                             <td><button class="btn btn-xs btn-danger"><i class="icon-trash icon-white"></i></button></td>
                             <td><button class="btn btn-xs btn-info"><i class="icon-pencil icon-white" ></i></button></td>
                         </tr> 
                     </tbody>
                </table>
            
         <hr>
         
        </div>
</div>
