<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Private_Controller extends CI_Controller {

	public $user;

	/*
		La clase Private_Controller hereda de CI_Controller
		ahora aqui establecemos el usuario logueado.
	*/
	function __construct() 
        {
		parent::__construct();

		date_default_timezone_set("America/Monterrey");
                // CON ESTA VARIABLE QUE TRAE EL CONTRUCTOR, SERVIRA PARA CARGAR, DESDE EL CONTROLADOR,
                // EL MODELO CORRESPONDIENTE, EMPLEADOS_MODEL, LOGIN_MODEL, ETC.
                 $this->load->model('tickets_model');
                 $this->load->model('clientes_model');
                 $this->load->model('empleados_model');
                 $this->load->model('panelcontrol_model');
                 $this->load->model('login_model');
		// Se carga el helper url y form.
		$this->load->helper('url');
		$this->load->helper('form');

		// Se carga la libreria form_validation.
		$this->load->library('form_validation');

		// Se le asigna a la informacion a la variable $user.
		$this->user = @$this->session->userdata('logged_user');
	}
        
        
         

}