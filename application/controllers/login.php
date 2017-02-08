<?php

class Login extends Private_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Users');
        
    }
    
    public function index()
    {
        
       echo' Aqui va el texto';
    }
    
    public function inicio()
    {
         // pasamos como parametro el numero 5, ya que es un id de usuario existente en la tabla
        //usuarios_sistema_tbl
        $userLogin = $this->login_model->loginEmpleado(3); 
        $tickets['ticketsShortcut'] = $this->login_model->countTicketbyAll();
        //$sessionUserCliente = array('idUser' => $userLogin->id_user, 'idCliente' => $userLogin->id_cliente,
       //     'cliente' => $userLogin->nombre_cliente, 'email' => $userLogin->email);
        
        $sessionUserEmpleado = array('idUser' => $userLogin->idUserEmpleado, 'idEmpleado' =>$userLogin->id_empleado,
                 'nombreUser' => $userLogin->nombre_usuario);// almacenamos los datos de la base de datos en un array
        
         $this->session->set_userdata('loggedIn',$sessionUserEmpleado); // array para tener en sesion 
         //los datos del usuario (empleado o cliente), Datos que se tendran en toda la aplicacion
         
        // variable que se manda, para cargar los css, debido a que las vistas en estan dividas por carpertas
        // se debe cambiar la ruta de los css
        $link['css'] = "<link href='../css/css/bootstrap.css' rel ='stylesheet'>";
        $link['js']= "<script src='../css/js/jquery-1.10.2.min.js' type='text/javascript'></script>";
        $link['jsBootstrap'] = "<script src='../css/js/bootstrap.js'></script>";
        $this->load->view('head',$link); // head y menu
        $this->load->view('index',$tickets);// contenido, y/o controles de usuario
        $this->load->view('footer');// footer
    }
    
    
}

?>
