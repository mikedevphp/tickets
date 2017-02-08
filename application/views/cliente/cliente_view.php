<div class="row-fluid">
    
    <p>
       <?php 
            
            if(isset($errorClientes))
            {
                echo $errorClientes;
            }
       ?>
    </p>
    <?php 
        $paramsBuscarClientes = array('class' =>'form-search');
        echo form_open('', $paramsBuscarClientes);
    ?>
    
         <div class="control-group pull-right">
            
            <label class="control-label" for="buscar"> Nombre del cliente </label>
            
            <div class=" input-append">
                    <input name="buscar" type="text" class="input-medium search-query">
                    <input name="submit" type="submit" class=" btn btn-primary" value ="Buscar">
                    </input>
            
            </div>
     </div>
         
        
        <?php echo form_close();?>
</div>
    </div>
</div>