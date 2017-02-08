<?php

class Clientes  extends Private_Controller
{
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index()
    {       
      if(!$this->user )
        {
            redirect('welcome');
        }
        
        if($this->user->id_perfil == 1)
        {
        
            $dataCliente['clientes'] = $this->clientes_model->getclients();
            $this->load->view('head'); // head y menu
            $this->load->view('cliente/cliente_buscar_view',$dataCliente);
            $this->load->view('footer');// footer
        } 
        else {redirect('welcome');}
    }
    
   private function _getOnlyNumbersUri($cadena)
	{
		return preg_replace("'/\D+/'", "", $cadena);
	}
    
    public function sucursalesCliente()
    {
		if(!$this->user )
		{
			redirect('welcome');
		}
       try
       {
           
            $uristring = $this->_getOnlyNumbersUri($this->uri->segment(3));
            $uri = (integer) $uristring;
            $data['uri'] = $uri;
            $data['sucursales'] = $this->clientes_model->getSucursales($uri);
            
            if(!is_string($uri) && $uri != 0 && !is_null($data['sucursales']))
            {
                
                $this->load->view('head'); // head y menu
                $this->load->view('cliente/cliente_sucursales_view',$data);
                $this->load->view('footer');// footer;
            }

            else {redirect('clientes');}
        }
        
        catch(Exception $e)
        {
           redirect('clientes') ;
        }
    }
    
    public function crearCliente()
    {
		if(!$this->user )
		{
			redirect('welcome');
		}
        $action = $this->input->post('registrarCliente');
        
        
            $dataCrearCliente['perfilCliente'] = $this->clientes_model->getperfil();

            $this->load->view('head'); // head y menu
            $this->load->view('cliente/crear_cliente_view',$dataCrearCliente);
            $this->load->view('footer');// footer
         

        if($action == 'registrar')
        {
            $this->form_validation->set_rules('nombreCliente','nombre de la empresa',
                   'trim|required|xss_clean');
			$this->form_validation->set_rules('ciudadCliente','ciudad',
                   'trim|required|xss_clean');
			$this->form_validation->set_rules('fraccCliente','colonia / fraccionamiento',
                   'trim|required|xss_clean');
			$this->form_validation->set_rules('calleCliente','calle',
					'trim|required|xss_clean');
			$this->form_validation->set_rules('telCliente','teléfono',
					'trim|required|exact_length[17]|xss_clean');
			$this->form_validation->set_rules('celCliente','teléfono celular',
					'trim|required|exact_length[18]|xss_clean');
			$this->form_validation->set_rules('emailCliente','email',
                   'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('passCliente','contraseña',
                   'trim|required|xss_clean');
			$this->form_validation->set_rules('passClienteR','repetir contraseña',
                   'trim|required|matches[passCliente]|xss_clean');
				   
            $this->form_validation->set_message('required', 'El campo %s es requerido.');
			$this->form_validation->set_message('valid_email', 'El campo %s debe ser un email válido.');
			$this->form_validation->set_message('matches', 'El campo %s debe coincidir con el campo contraseña.');
			$this->form_validation->set_message('exact_length', 'El campo %s debe ser llenado correctamente.');
            if ($this->form_validation->run() == FALSE)
            {
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a>', '</div>');
				$this->session->set_flashdata('error_validation',validation_errors());
				redirect(current_url());
            }

            else
            {
                $empresa = $this->input->post('nombreCliente');
                $dataUsuario = array('nombre_usuario' => $this->input->post('emailCliente'),
                        'password_usuario' => md5($this->input->post('passCliente')),
                        'id_perfil' => $this->input->post('idPerfil'));
                $dataCliente = array('nombre_cliente' => $this->input->post('nombreCliente'),
                   'ciudad_cliente' =>  $this->input->post('ciudadCliente'),
                    'fracc_colonia_cliente' => $this->input->post('fraccCliente'),
                    'direccion' => $this->input->post('calleCliente'),
                    'telefono' => $this->input->post('telCliente'), 'telefono_cel' => $this->input->post('celCliente'),
                    'email' => $this->input->post('emailCliente'));

                if($this->clientes_model->createCliente($dataUsuario, $dataCliente) === true)
                {
                  $this->session->set_flashdata('correcto', 
                   '<p class ="alert alert-success span4"><a class="close" data-dismiss="alert">x
                       </a>Se ha registrado correctamente la empresa'.$empresa.'</p>');
                  redirect('Clientes');
                }

                else
                {
                    $this->session->set_flashdata('incorrecto', 'No se ha registrado correctamente el usuario, 
                        favor de contactar al programador');
                  redirect('clientes');
                }
             }
                
           }
           
           
    }
    
    public function crearSucursal()
    {
		if(!$this->user )
		{
			redirect('welcome');
		}
        $action = $this->input->post('registrarSucursal');
        
        
            // Ponemos como parametro un true en el parametro de la funcion, para traernos solo
        // el nombre y id de los clientes(empresas)
		
            $dataCrearSuc['empresas'] = $this->clientes_model->getClients(TRUE);
            $this->load->view('head'); // head y menu
            $this->load->view('cliente/crearSucursal_view',$dataCrearSuc);
            $this->load->view('footer');// footer
           
            if($action == 'registrar')
            {
                //validaciones
                
				$this->form_validation->set_rules('numeroSuc','numero de sucursal',
                   'trim|required|xss_clean|is_unique[clientes_sucursales_tbl.id_sucursal]');
				$this->form_validation->set_rules('nombreSuc','nombre de sucursal',
                   'trim|required|xss_clean');
				$this->form_validation->set_rules('ciudadSuc','ciudad',
                   'trim|required|xss_clean');
				$this->form_validation->set_rules('fraccSuc','colonia / fraccionamiento',
                   'trim|required|xss_clean');
				$this->form_validation->set_rules('calleSuc','calle',
                   'trim|required|xss_clean');
				$this->form_validation->set_rules('telSuc','teléfono',
                   'trim|required|exact_length[17]|xss_clean');
				$this->form_validation->set_rules('celSuc','teléfono celular',
                   'trim|required|exact_length[18]|xss_clean');
                   
                $this->form_validation->set_message('is_unique', 'Ya existe el nombre de la sucursal.');
                $this->form_validation->set_message('required', 'El campo %s es requerido.');
                $this->form_validation->set_message('exact_length', 'El campo %s debe ser llenado correctamente.');
                if ($this->form_validation->run() == FALSE)
                {
					$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a>', '</div>');
					$this->session->set_flashdata('error_validation', validation_errors());
					
                    redirect(current_url());
					
                }
                else 
                {
                    $dataSuc = array('id_sucursal' => $this->input->post('numeroSuc'),
                    'nombre_sucursal' => $this->input->post('nombreSuc'),
                    'id_cliente' => $this->input->post('empresa'), 'ciudad_suc' => $this->input->post('ciudadSuc'),
                    'fracc_colonia_suc' => $this->input->post('fraccSuc'), 'direccion' => $this->input->post('calleSuc'),
                    'telefono' => $this->input->post('telSuc'), 'telefono_cel_suc' => $this->input->post('celSuc'));
                    
                    
                    
                    if($this->clientes_model->createSucursal($dataSuc) === true)
                    {
                      $this->session->set_flashdata('correcto_suc', 
                              '<p class ="alert alert-success span4"><a class="close" data-dismiss="alert">x</a>Se ha registrado correctamente la sucursal</p>');
                      redirect('clientes');
                    }

                    else
                    {
                        $this->session->set_flashdata('incorrecto_suc', 'No se ha registrado correctamente el usuario, 
                            favor de contactar al programador');
                      redirect('clientes');
                    }
                }
            }
            
    }
    public function editarCliente()
    {
		if(!$this->user )
		{
			redirect('welcome');
		}
        //$data['perfil'] = $this->clientes_model->getperfil();
        $action = $this->input->post('editarCliente');
 
        if($action == 'editar')
        {
			if($this->user->id_perfil == 1)
			{
				$this->form_validation->set_rules('nombreCliente','nombre de la empresa',
                   'trim|required|xss_clean');
			}
			
			$this->form_validation->set_rules('fraccCliente','colonia / fraccionamiento',
                   'trim|required|xss_clean');
			$this->form_validation->set_rules('calleCliente','calle',
					'trim|required|xss_clean');
			$this->form_validation->set_rules('telCliente','teléfono',
					'trim|required|exact_length[17]|xss_clean');
			$this->form_validation->set_rules('celCliente','teléfono celular',
					'trim|required|exact_length[18]|xss_clean');
			$this->form_validation->set_rules('emailCliente','email',
                   'trim|required|valid_email|xss_clean');
				   
            $this->form_validation->set_message('required', 'El campo %s es requerido.');
			$this->form_validation->set_message('valid_email', 'El campo %s debe ser un email válido.');
			$this->form_validation->set_message('exact_length', 'El campo %s debe ser llenado correctamente.');
			if($this->form_validation->run() == FALSE)
			{
				if($this->user->id_perfil == 1)
				{
					$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a>', '</div>');
					$this->session->set_flashdata('error_validation',validation_errors());
					redirect('clientes');
				}
				
				if($this->user->id_perfil == 3)
				{
					$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a>', '</div>');
					$this->session->set_flashdata('error_validation',validation_errors());
					redirect('panelControl');
				}
			}
			else
			{
				$empresa = $this->input->post('nombreCliente');
				$dataCliente= array('id_cliente' => $this->input->post('idCliente'), 
					'nombre_cliente' => $this->input->post('nombreCliente'),
					'ciudad_cliente' => $this->input->post('ciudadCliente'), 
					'fracc_colonia_cliente' => $this->input->post('fraccCliente'),
					'direccion' => $this->input->post('calleCliente'),
					'telefono' => $this->input->post('telCliente'), 
					'telefono_cel' => $this->input->post('celCliente'),
					 'email' => $this->input->post('emailCliente'));
			  
			  if($this->clientes_model->updateCliente($dataCliente) === true)
			  {
				  if($this->user->id_perfil == 1)
				  {
				  $this->session->set_flashdata('modificado_cliente', 
				  '<p class ="alert alert-success span5"><a class="close" data-dismiss="alert">x</a>
					Se ha modificado correctamente la empresa '.$empresa.'</p>');
					redirect('clientes');
				  }
											  
				  elseif ($this->user->id_perfil == 3) 
				  {
					  $this->session->set_flashdata('modificado_cliente', 
					'<p class ="alert alert-success"><a class="close" data-dismiss="alert">x</a>
					Se han modificado sus datos correctamente</p>');
					redirect('panelControl');
				  }
			  }
			}	
          
        }
        
       else{ redirect('clientes');}
        
    }
    
    public function eliminarCliente()
    {
		if(!$this->user )
		{
			redirect('welcome');
		}
		
       $action = $this->input->post('eliminarCliente');
       
         if($action == 'eliminar')
        {
             $empresa = $this->input->post('cliente');
             
            if($this->clientes_model->deleteCliente($this->input->post('idUser')) === true)
            {
				
				   $this->session->set_flashdata('eliminado_cliente', 
				  '<p class ="alert alert-success span5"><a class="close" data-dismiss="alert">x</a>
					Se ha eliminado correctamente la empresa '.$empresa.'</p>');
				   
					redirect('clientes');
				
				
				
            }
        }  
        
        else{redirect('clientes');}
    }
    
    public function eliminarSucursal()
    {
		if(!$this->user )
		{
			redirect('welcome');
		}
        $action = $this->input->post('eliminarSucursal');
        
        if($action == 'eliminar')
        {
            $data = array('id_cliente' => $this->input->post('idCliente'),
                            'id_sucursal' => $this->input->post('idSuc'));
            
            $empresa = $this->input->post('empresa');
            if($this->clientes_model->deleteSucursal($data) === true)
            {
				if($this->user->id_perfil == 1)
				{
					$this->session->set_flashdata('eliminado_sucursal', 
					'<p class ="alert alert-success"><a class="close" data-dismiss="alert">x</a>
					Se ha eliminado correctamente la sucursal '.$data['id_sucursal'].' de la empresa
						'.$empresa.'</p>');
				   
					redirect('clientes'); 
				}
				
				elseif($this->user->id_perfil == 3)
				{
					$this->session->set_flashdata('eliminado_sucursal', 
					'<p class ="alert alert-success"><a class="close" data-dismiss="alert">x</a>
					Se ha eliminado correctamente la sucursal '.$data['id_sucursal'].' de la empresa
						'.$empresa.'</p>');
				   
					redirect('sucursales');
				}
            }
        }
    }
    
    public function editarSucursal()
    {
		if(!$this->user )
		{
			redirect('welcome');
		}
       $action = $this->input->post('editarSucursal');
       
       if($action == 'editar')
       {
			$this->form_validation->set_rules('numSucursal','numero de sucursal',
                   'trim|required|xss_clean');
			$this->form_validation->set_rules('nomSucursal','nombre de sucursal',
			   'trim|required|xss_clean');
			$this->form_validation->set_rules('ciudadSucursal','ciudad',
			   'trim|required|xss_clean');
			$this->form_validation->set_rules('fraccSucursal','colonia / fraccionamiento',
			   'trim|required|xss_clean');
			$this->form_validation->set_rules('calleSucursal','calle',
			   'trim|required|xss_clean');
			$this->form_validation->set_rules('telSucursal','teléfono',
			   'trim|required|exact_length[17]|xss_clean');
			$this->form_validation->set_rules('celSucursal','teléfono celular',
			   'trim|required|exact_length[18]|xss_clean');
			
			$this->form_validation->set_message('required', 'El campo %s es requerido.');
			$this->form_validation->set_message('exact_length', 'El campo %s debe ser llenado correctamente.');
				
			if($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a>', '</div>');
				if($this->user->id_perfil == 1)
				{
					
					$this->session->set_flashdata('error_validation', validation_errors());
					redirect('clientes');
					
				}
				elseif($this->user->id_perfil == 3)
				{
					
					$this->session->set_flashdata('error_validation', validation_errors());
					redirect('sucursales');
				}
			}
			
			else
			{
			   $data = array('id_sucursal' => $this->input->post('numSucursal'),
				'nombre_sucursal' => $this->input->post('nomSucursal'), 'id_cliente' => $this->input->post('idEmpresa'), 
				'ciudad_suc' => $this->input->post('ciudadSucursal'), 'fracc_colonia_suc' => $this->input->post('fraccSucursal'), 
				'direccion' => $this->input->post('calleSucursal'),'telefono' => $this->input->post('telSucursal'), 
				'telefono_cel_suc' => $this->input->post('celSucursal'));
			   
			   $empresa = $this->input->post('empresa');
			   
			   if($this->clientes_model->updateSucursal($data) === true)
				{
					if($this->user->id_perfil == 1)
					{
					   $this->session->set_flashdata('modificado_sucursal', 
					  '<p class ="alert alert-success span6"><a class="close" data-dismiss="alert">x</a>
						Se ha editado correctamente la sucursal '.$data['id_sucursal'].' de la empresa
							'.$empresa.'</p>');
					   
						redirect('clientes'); 
					}
					
					elseif($this->user->id_perfil == 3)
					{
						$this->session->set_flashdata('modificado_sucursal', 
					  '<p class ="alert alert-success span6"><a class="close" data-dismiss="alert">x</a>
						Se ha editado correctamente la sucursal '.$data['id_sucursal'].'</p>');
					   
						redirect('sucursales');
					}
			}	}
       }
    }
}

?>
