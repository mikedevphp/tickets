<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?= base_url('css/css/bootstrap-responsive.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">
    <script src="<?= base_url('css/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('css/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('css/js/utf8_encode.js') ?>"></script>
    <script src="<?= base_url('css/js/md5.js') ?>"></script>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <script type="text/javascript">
        
        $(document).ready(function()
        {
            $('#btnlogin').click(function()
            {
                var pass = ($('#password').val().length === 0) ? "" : md5($('#password').val());
                $.post('<?php echo base_url('index.php/welcome/login') ?>',
                {username: $('#username').val(),
                password: pass},
                function(data)
                {
                    
                    if(data === "Login Correcto" )
                    {
                     $('center')[0].innerHTML = "<p class='alert alert-success'>"+data+
                        "<a class='close' data-dismiss='alert'>x</a></p>";
                        
                        setTimeout(function()
                        {
                            window.location.href = "<?php echo base_url('index.php/welcome'); ?>";
                        }, 1000);
                    }
                    
                    else if( data === "Error de usuario o contraseña")
                    {
                        $('center')[0].innerHTML = "<p class='alert alert-error'>"+data+
                        "<a class='close' data-dismiss='alert'>x</a></p>";
                    }
                    else
                    {
                        $('center')[0].innerHTML = data;
                    }
                
                    
                });
            });
        });
        
    </script>
     
</head>
<body background="<?= base_url('css/img/bg_ss.png') ?>" background-repeat: no-repeat;>
<br><br><br>
<div class="container">
	<div class="row">
		<div class="span4 offset4 well">
<a class="btn btn-mini btn-info pull-right" href="http://soporte-soluciones.com.mx"><i class="icon-chevron-left icon-white"></i>Regresar</a>
			<legend>Inicio de sesión</legend> 

          	
                
                        <center></center>
                
                
            

			<form method="POST" action="" accept-charset="UTF-8">
			<input type="text" id="username" class="span4" name="username" placeholder="Usuario" value="<?php echo set_value('username'); ?>">
			<input type="password" id="password" class="span4" name="password" placeholder="Contraseña" value="<?php echo set_value('password'); ?>">
            <!-- <label class="checkbox">
            	<input type="checkbox" name="remember" value="1"> Recordarme
            </label> -->
			<button type="button" id="btnlogin" name="submit" class="btn btn-info btn-block">Entrar</button>
			</form>    
		</div>
	</div>
</div>



    
    
      <footer>
       
      </footer>
</body>
</html>