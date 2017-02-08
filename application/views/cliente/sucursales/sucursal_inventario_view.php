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
         
         ko.components.register('like-widget', {
    /*viewModel: function(params) {
        // Data: value is either null, 'like', or 'dislike'
        this.chosenValue = params.value;
         
        // Behaviors
        this.like = function() { this.chosenValue('like'); }.bind(this);
        this.dislike = function() { this.chosenValue('dislike'); }.bind(this);
    },*/
    template:
        '<div class="like-or-dislike">\
            <button >Like it</button>\
            <button >Dislike it</button>\
        </div>\
        <div class="result" >\
            You <strong ></strong> it\
        </div>'
});
         
         ko.applyBindings(new viewModel(),$("#div_table_items")[0]);
    });
    
    
    function viewModel()
    {
        
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
            
                <table class="table table-striped table-hover">
                       
                       <like-widget></like-widget>
                    <button class="btn btn-xs btn-success pull-right"><i class="icon-plus icon-white" ></i></button>
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
