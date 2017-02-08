<?php

class Empleados extends Private_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('empleados_model');
        
    }
    
    public function index()
    { 
        if(!$this->user)
        {
            redirect('welcome');
        }
        
        if($this->user->id_perfil == 1)
        {
            $dataEmpleado['empleados'] = $this->empleados_model->getemployees();
            $dataEmpleado['perfiles'] = $this->empleados_model->getperfiles();
            $this->load->view('head'); // head y menu
            $this->load->view('empleado/empleado_buscar_view',$dataEmpleado);
            $this->load->view('footer');// footer
        }
        else{redirect('welcome');}
         
    }
    
    

    public function crearEmpleado()
    {
		if(!$this->user )
		{
			redirect('welcome');
		}
       $action = $this->input->post('crearEmpleados');
       
       
            $dataCrearEmpleado['perfiles'] = $this->empleados_model->getperfiles();

            $this->load->view('head'); // head y menu
            $this->load->view('empleado/crear_empleado_view', $dataCrearEmpleado);
            $this->load->view('footer');// footer
         
         
       if($action == 'crear')
           {
            
			$this->form_validation->set_rules('perfilesEmp','tipo de cuenta',
                   'trim|is_natural_no_zero|xss_clean');
			$this->form_validation->set_rules('nombresEmp','nombres',
					'trim|required|xss_clean');
			$this->form_validation->set_rules('apellidoPatEmp','apellido paterno',
					'trim|required|xss_clean');
			$this->form_validation->set_rules('apellidoMatEmp','apellido materno',
					'trim|required|xss_clean');
			$this->form_validation->set_rules('userEmp','nombre de usuario',
					'trim|required|xss_clean');
			$this->form_validation->set_rules('ciudadEmp','ciudad',
					'trim|required|xss_clean');
			$this->form_validation->set_rules('colEmp','colonia / fraccionamiento',
					'trim|required|xss_clean');
			$this->form_validation->set_rules('calleEmp','calle',
					'trim|required|xss_clean');
			$this->form_validation->set_rules('telEmp','telefono',
					'trim|required|exact_length[17]|xss_clean');
			$this->form_validation->set_rules('celEmp','telefono celular',
					'trim|required|exact_length[18]|xss_clean');
			$this->form_validation->set_rules('emailEmp','email',
					'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('passEmp','contraseña',
                   'trim|required|xss_clean');
			$this->form_validation->set_rules('passEmpR','repetir contraseña',
                   'trim|required|matches[passEmp]|xss_clean');
            $this->form_validation->set_message('required', 'El campo %s es requerido.');
			$this->form_validation->set_message('is_natural_no_zero', 'El campo %s es necesario escoger un valor.');
			$this->form_validation->set_message('matches', 'El campo %s debe coincidir con el campo contraseña.');
			$this->form_validation->set_message('valid_email', 'El campo %s debe registrarse un email válido.');
			$this->form_validation->set_message('exact_length', 'El campo %s debe ser llenado correctamente.');
            if ($this->form_validation->run() == FALSE)
            {
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a>', '</div>');
				$this->session->set_flashdata('error_validation', validation_errors());
				redirect(current_url());
            }
			else
			{
				$dataUsuario = array('id_perfil' => $this->input->post('perfilesEmp'),
						  'nombre_usuario' => $this->input->post('userEmp'),
						  'password_usuario' => md5($this->input->post('passEmp')));

				  $dataEmpleado = array('nombres' => $this->input->post('nombresEmp'),
					  'apellido_paterno' => $this->input->post('apellidoPatEmp'),
					  'apellido_materno' => $this->input->post('apellidoMatEmp'),
					  'ciudad' => $this->input->post('ciudadEmp'),
					  'colonia' => $this->input->post('colEmp'),
					  'direccion' => $this->input->post('calleEmp'),
					  'telefono' => $this->input->post('telEmp'),
					  'telefono_cel' => $this->input->post('celEmp'),
					  'email' => $this->input->post('emailEmp'));

				  if($this->empleados_model->createemployee($dataUsuario, $dataEmpleado) === TRUE)
				  {
					$this->session->set_flashdata('correcto_empleado', '<p class ="alert alert-success span5"><a class="close" data-dismiss="alert">x
				  </a>Se ha registrado correctamente el usuario '.$dataUsuario['nombre_usuario'].'</p>');
					redirect('empleados');
				  }      
			}  
           }
    
    }
    
    public function eliminarEmpleado()
    {
	
        if(!$this->user )
        {
                redirect('welcome');
        }
		
        $action = $this->input->post('eliminarEmpleado');
        
        if($action == 'eliminar')
        {
           $empleado = $this->input->post('empleado');
             
            if($this->empleados_model->deleteEmployee($this->input->post('idUserEmp')) === true)
            {
               $this->session->set_flashdata('eliminado_empleado', 
              '<p class ="alert alert-success span6"><a class="close" data-dismiss="alert">x</a>
                Se ha eliminado correctamente el empleado '.$empleado.'</p>');
               
                redirect('empleados');
            } ;
        }
        else{redirect('empleados'); }
    }
    
    public function editarEmpleado()
    {
	
		if(!$this->user )
		{
			redirect('welcome');
		}
		
       $action = $this->input->post('editarEmpleado') ;
       
       if($action == 'editar')
        {
			if($this->user->id_perfil == 1)
			{
				$this->form_validation->set_rules('nombreEmpleado','nombres',
						'trim|required|xss_clean');
				$this->form_validation->set_rules('apellidoPatEmp','apellido paterno',
						'trim|required|xss_clean');
				$this->form_validation->set_rules('apellidoMatEmp','apellido materno',
					'trim|required|xss_clean');
			}
			
			$this->form_validation->set_rules('fraccEmpleado','colonia / fraccionamiento',
					'trim|required|xss_clean');
			$this->form_validation->set_rules('calleEmpleado','calle',
					'trim|required|xss_clean');
			$this->form_validation->set_rules('telEmpleado','telefono',
					'trim|required|exact_length[17]|xss_clean');
			$this->form_validation->set_rules('celEmpleado','telefono celular',
					'trim|required|exact_length[18]|xss_clean');
			$this->form_validation->set_rules('emailEmpleado','email',
					'trim|required|valid_email|xss_clean');
			$this->form_validation->set_message('required', 'El campo %s es requerido.');
			$this->form_validation->set_message('valid_email', 'El campo %s debe registrarse un email válido.');
			$this->form_validation->set_message('exact_length', 'El campo %s debe ser llenado correctamente.');
					
			if($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a>', '</div>');
				$this->session->set_flashdata('error_validation', validation_errors());
				if($this->user->id_perfil == 1) {redirect('empleados');}
				if($this->user->id_perfil == 2) {redirect('panelControl');}
			}
			else
			{       
				$empleado = $this->input->post('nombreEmpleado')." ".$this->input->post('apellidoPatEmp').
					   " ".$this->input->post('apellidoMatEmp');
			   
				$dataEmpleado = array('id_empleado' => $this->input->post('idEmpleado'), 
					'nombres' => $this->input->post('nombreEmpleado'),
					'apellido_paterno' => $this->input->post('apellidoPatEmp'),
					'apellido_materno' => $this->input->post('apellidoMatEmp'),
					'ciudad' => $this->input->post('ciudadEmpleado'), 
					'colonia' => $this->input->post('fraccEmpleado'),
					'direccion' => $this->input->post('calleEmpleado'),
					'telefono' => $this->input->post('telEmpleado'), 
					'telefono_cel' => $this->input->post('celEmpleado'),
					 'email' => $this->input->post('emailEmpleado'));
			   
				if($this->empleados_model->updateEmployee($dataEmpleado) === true)
				{
					if($this->user->id_perfil == 1)
					{
						$this->session->set_flashdata('modificado_empleado', 
						'<p class ="alert alert-success"><a class="close" data-dismiss="alert">x</a>
						Se ha modificado correctamente el empleado '.$empleado.'</p>');
					  
						redirect('empleados');
					}
					elseif($this->user->id_perfil == 2)
					{
						$this->session->set_flashdata('modificado_empleado', 
						'<p class ="alert alert-success"><a class="close" data-dismiss="alert">x</a>
						Se ha modificado correctamente sus datos personales</p>');
					  
						redirect('panelControl');
					}
				}
			}
        }
        else{redirect('empleados');}
    }
}

?>
