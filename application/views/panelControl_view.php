<div class="row-fluid">
       <div class="span12">
               <div class="well">
                       <h6><center>Cambiar los perfiles y contraseñas de los usuarios del sistema.</center></h6>
               </div>
       </div>
</div>

   
   
   <div class="row-fluid">
       <?php
        if($this->session->flashdata('error_validation'))
       {
             echo '<div class ="alert alert-error"><a class="close" data-dismiss="alert">x</a>'.
                $this->session->flashdata('error_validation').'</div>';
        }  
       
         if($this->session->flashdata('pass_correcto'))
       {
             echo '<div class ="alert alert-success"><a class="close" data-dismiss="alert">x</a>'.
                $this->session->flashdata('pass_correcto').'</div>';
        }
        
         if($this->session->flashdata('pass_incorrecto'))
       {
             echo '<div class ="alert alert-error"><a class="close" data-dismiss="alert">x</a>'.
                $this->session->flashdata('pass_incorrecto').'</div>';
             
        }
       ?>
       
   </div>
   
<script type="text/javascript">
    $(document).ready(function()
     {
     
     	/*$('td center a.btn-info').click(function()
     	{
     		console.log($(this).prev());
     		$(this).prev().attr('type','text');
     	});*/
       
        $('a[pass]').click(function()
        {
            
            $('#modalPassUsuario').find('#iduser').val($(this).attr('iduser'));
            
             $('#modalPassUsuario').on('hidden', function()
            {
                $(this).find('input').val('');
            });   
        }); 
        
        
        $('a[perfil]').click(function()
        {
            var element = $(this);
        
            var iduser = $(this).attr('iduser');
            
            element.hide();
            
            
            var celda = $('table tr td#comboperfiles'+iduser+'').append('<div id="perfiles'+iduser+'"><select id="selperfil" class="input-medium"> \n\
                <option value ="1" >Administrador</option> \n\
                <option value ="2">Soporte</option> \n\
                </select> \n\
                <button id="siperfil" class="btn btn-small btn-danger">SI</button>\n\
                <button id="noperfil" class="btn btn-small">NO</button></div>');
    
            var combo = celda.find('#perfiles'+iduser+'');
            
            
            
               
            combo.find('#noperfil').click(function()
            {
                combo.remove();
                element.show();
            });
            
            combo.find('option').each(function()
            {
                if($(this).val() === element.attr('idperfil'))
                {
                    $(this).prop('selected', true);
                } 
            });
            
            combo.find('#siperfil').click(function()
            {
               var idperfil = combo.find('select').val();
                var user = iduser;
                
               // alert("perfil: "+idperfil + "user: "+user);
                
                $.post("<?php echo base_url()?>index.php/panelControl/cambiarPerfil", 
                        {
                            iduser : user,
                            idperfil : idperfil
                        }, 
                        function(msg) 
                        {   
                           alert(msg);
                            combo.remove();
                            element.show();
                            element.attr('idperfil', idperfil);
                            if (!location.origin) location.origin = location.protocol + "//" + location.host;
                            window.location.href = location.origin + '/index.php/welcome/logout/';
                            
                        }).fail(function()
                        {
                            alert('No se pudo cambiar el perfil del usuario');
                        
                        });
                    
                
            });
             
        });
        
        
        
            
});

</script>

<div>
    
<?php 
    if(isset($usuarios))
    {
        
            
        echo "<table  class ='table table-bordered table-striped table-condensed'>
        <thead><tr><th class='alert alert-info'>Nombre de usuario</th>
        <th class='alert alert-info'>Contraseña</th>
        <th class='alert alert-info'>Cambiar perfil</th><th class='alert alert-info'>Cambiar contraseña</th></tr></thead>".
        "<tbody>";
            
        foreach ($usuarios as $row) 
        {
            
            echo "<tr><td>".
            $row->nombre_usuario."".empresa($row->nombre_cliente)."</td>
            <td><center><input type='password' value='12345' readonly/>
            <a class='btn-small btn-info'><i class='icon-search icon-white'></i></a></center></td>
            <td id='comboperfiles".$row->id_user."'><center>".perfil($row)."<i class='icon-pencil icon-white'></i>
            </center></td><td><center><a class='btn-small btn-warning' href='#modalPassUsuario' iduser = '".$row->id_user."'
            data-toggle='modal' pass='' >
            <i class='icon-pencil icon-white'></i></a></center></td></tr>";
        } 
        
        echo "</tbody>".
           "</table>";
        
    }

    function empresa($cliente)
    {
        return ($cliente == "") ? "" : " - (".$cliente.")";
    }
    
    function perfil($row)
    {
        if($row->idperfil != 3)
        {
            return "<a class='btn-small btn-warning' href='#' idperfil='".$row->idperfil."' perfil =''
            iduser ='".$row->id_user."'>";
        }
        
        return $row->nombre_perfil;
    }
?>
</div>
<!-- Modal para cambiar contraseñas de los usuarios del sistema -->
    <form class="form-horizontal" method="post" action="<?php echo base_url("index.php/panelControl/cambiarPass"); ?>">
        <div class=" modal hide fade" id="modalPassUsuario">
            <div class="modal-header">
                <h4 id="myModalLabel">Cambiar contraseña</h4>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <label class="control-label"  >Teclee la contraseña anterior</label>
                    <div class="controls">
                        <input value="" class="input-large" name="passUserAnt" type='password'/> 
                        <input value="" type="hidden" id="iduser" name="idUser" />
                    </div> 
                </div>
                <div class="control-group">
                    <label class="control-label" >Teclee la nueva contraseña anterior</label>
                    <div class="controls">
                        <input type='password' value="" name="passUser1" class="input-large"  />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Repita nuevamente la  nueva contraseña</label>
                    <div class="controls">
                        <input type='password' value="" name="passUser2" class="input-large"/>
                    </div>
                </div>
            </div>
             <div class="modal-footer">
                <button class='btn btn-danger' type="submit" value="cambiar" name="cambiarPass">Cambiar contraseña</button>
                <button class='btn'  data-dismiss="modal">Cancelar</button>
             </div>
         </div>
    </form>

        <div class="modal hide fade" id="perfilesUsuario">
            <label>Perfiles</label>
            <select  class="input-medium">
                <option> Administrador </option>
                <option> Soporte </option>
                <option> Cliente </option>

            </select>
            <button class='btn btn-danger'  value='cambiar' name='cambiarContraseña'>Cambiar perfil</button>
            <button class='btn'  value='cambiar' name='cambiarContraseña'>Cancelar</button>
        </div>
   
        
        	
    