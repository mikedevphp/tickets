<!--<div class="row-fluid">
        <div class="span6 offset3"> 
            <div class="well sidebar-nav">
            <legend class ="text-info"><p>Crear catalogo</p></legend>

	    <form class="form-horizontal">
            <div class="control-group">
            <label class="control-label" for="inputEmail">Nombre</label>
            <div class="controls">
            <input type="text" id="nombreCatalogo" >
            </div>
            </div>
            <div class="control-group">
            <label class="control-label" for="inputPassword">Descripcion</label>
            <div class="controls">
                <textarea rows="4" id="descripcionCatalogo" > </textarea>
            </div>
            </div>
            <div class="control-group">
            <div class="controls">
                <input type="hidden" id="idCat" value="" />
            <button type="button" id="btnGuardarCat" class="btn">Crear</button>
            <button type="button" id="btnCancelarCat" onclick="window.location.reload(true);" style="display:none;" class="btn">Cancelar</button>
            </div>
            </div>
            </form>
            
                

                    
</div>
            <script type="text/javascript">
                
                window.onload = function()
                {
                    
                };
                
                
                
                function editRegister(data)
                {
                    document.getElementById('btnCancelarCat').style = 'block';
                    //tds = document.querySelectorAll('tr > td > button');
                    document.getElementById('nombreCatalogo').value = document.getElementById('Row'+data.id).children[1].textContent;
                    document.getElementById('descripcionCatalogo').value = document.getElementById('Row'+data.id).children[2].textContent;
                    document.getElementById('btnGuardarCat').textContent = 'Editar';
                    document.getElementById('idCat').value = data.value;
                         
                }
            
            </script>
    <table class="table table-condensed table-bordered table-striped">
        <caption>Lista</caption>
        <thead>
            <tr>
                <th>No.</th><th>Nombre</th><th>Descripcion</th><th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
              /*  if(count($catalogo) > 0)
                {
                    foreach($catalogo as $key => $value)
                    {
            ?>
            <tr id="Row<?php echo $key; ?>">
                <td><?php echo $key + 1; ?></td>
                <td ><?php echo $value->nombre_catalogo; ?></td>
                <td><?php echo $value->descripcion; ?></td>
                <td><button type="button" id="<?php echo $key; ?>" value="<?php echo $value->id_catalogo; ?>" onclick="editRegister(this);" class="btn btn-mini btn-info"><i class="icon-pencil"></i></button></td>
            </tr>
            <?php
                    }
                }
                else
                {
            ?>
        <div></div>
        
            <?php
                }*/
                
            ?>
        </tbody>
    </table>
</div>
</div> -->

<?php 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
 
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

    <div>
        <?php echo $output; ?>
 
    </div>
