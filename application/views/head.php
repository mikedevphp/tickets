<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <!--<link href="css/css/bootstrap.css" rel="stylesheet">-->
    <!--<link rel="stylesheet" href="css/css/bootstrap.min.css">-->

    <link href="<?= base_url('css/css/bootstrap-responsive.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">

    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <!--<link href="css/css/bootstrap-responsive.css" rel="stylesheet">-->

      <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> VÍA INTERNET-->
      <!--<script src="css/js/jquery.min.js"></script>-->
      <!--<script src="css/js/bootstrap.min.js"></script>-->

      <script src="<?= base_url('css/js/jquery.min.js') ?>"></script>
      <script src="<?= base_url('css/js/bootstrap.min.js') ?>"></script>

      <!--Mas info: http://vincentlamanna.com/BootstrapFormHelpers/phone-->
      <script src="<?= base_url('css/js/bootstrap-formhelpers-phone.format.js') ?>"></script>
      <script src="<?= base_url('css/js/bootstrap-formhelpers-phone.js') ?>"></script>
      <!---->


    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="css/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="css/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="css/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="css/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="css/ico/favicon.png">
</head>
<body>


<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo base_url("index.php"); ?>">Soporte y Soluciones</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class=""><a href="<?php echo base_url("index.php"); ?>">Home</a></li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tickets<b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                  <li><a tabindex="-1" href="<?php echo base_url("index.php/tickets"); ?>">Tickets</a></li>
                  <!--<li><a tabindex="-1" href="#">Status</a></li>
                  <li><a tabindex="-1" href="#">Prioridades</a></li>
                  <li><a tabindex="-1" href="#">Servicios</a></li>
                  <li><a tabindex="-1" href="#">Tipos</a></li>-->
                </ul>
              </li>
              <?php 
              if($this->user->id_perfil == 1)
              {
              ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios<b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                  <li><a tabindex="-1" href="<?php echo base_url("index.php/clientes"); ?>">Clientes</a></li>
                  <li><a tabindex="-1" href="<?php echo base_url("index.php/empleados"); ?>">Empleados</a></li>
                </ul>
              </li>
              
              <li class=""><a href="<?php echo base_url("index.php/reportes"); ?>">Graficas/Reportes</a></li>
              <?php
              }  
              ?>
              <?php 
              if($this->user->id_perfil == 3)
              {
              ?>
              <li><a href="<?php echo base_url("index.php/sucursales"); ?>">Sucursales</a></li>
              <?php 
              
              }  
              
              if($this->user->id_perfil == 1)
              {
              ?>
              
              <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Panel de Control<b class="caret"></b></a>
               <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                  <li><a tabindex="-1" href="<?php echo base_url("index.php/panelControl"); ?>">Usuarios del Sistema</a></li>
                  <li><a tabindex="-1" href="<?php echo base_url("index.php/panelControl/catalogos"); ?>">Catalogos</a></li>
                  <li><a tabindex="-1" href="<?php echo base_url("index.php/panelControl/subcatalogos"); ?>">Sub - Catalogos</a></li>
                </ul>
               </li>
               <?php
               }
               else
               {
               ?>
               
               <li class=""><a href="<?php echo base_url("index.php/panelControl"); ?>">Panel de Control</a></li>
               <?php
               }
               ?>
            </ul>



            <form class="navbar-form pull-right">
            </br>
            Bienvenido 
            <?php 
                  if($this->user->id_perfil == 3)
                  {
                  echo $this->user->nombre_usuario; 
                   echo  " (".$this->user->nombre_cliente.") "; 
                  
                  }
                  else{echo $this->user->nombre_usuario;}
            ?> 
            - <a href="<?php echo site_url('welcome/logout'); ?>">Salir</a>         
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>