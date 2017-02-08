<?php


class Panelcontrol extends Private_Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        if(!$this->user)
        {
            redirect('welcome');
        }
        
        $this->load->view('head'); // head y menu
        
        // Administrador
        if($this->user->id_perfil == 1)
        {
        	$data['usuarios'] = $this->panelcontrol_model->getUsers();
            $this->load->view('panelControl_view', $data);// contenido, y/o controles de usuario
        }
	else if($this->user->id_perfil == 2)
        {
            $data['datosUsuarioEmp'] = $this->panelcontrol_model->getEmployeeById($this->user->idUser);
            $this->load->view('panelControlnoAdmin_view', $data);
            
        }
        else if($this->user->id_perfil == 3)
        {
            $data['datosUsuario'] = $this->panelcontrol_model->getClientById($this->user->idUser);
            $this->load->view('panelControlnoAdmin_view', $data);
            
        }
        
        $this->load->view('footer');// footer
    }
    
    public function cambiarPass()
    {
		if(!$this->user )
		{
			redirect('welcome');
		}
		
        $action = $this->input->post('cambiarPass');
        
        if($action == 'cambiar')
        {
            $this->form_validation->set_rules('passUserAnt', 'contraseña anterior', 'trim|required');
            $this->form_validation->set_rules('passUser1', 'nueva contraseña', 'trim|required');
            $this->form_validation->set_rules('passUser2', 'repetir contraseña', 'trim|required|matches[passUser1]');
            $this->form_validation->set_message('required', 'El campo %s es requerido.');
            $this->form_validation->set_message('matches', 'El campo %s debe coincidir con el campo nueva contraseña.');
            if ($this->form_validation->run() == FALSE)
            {
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a>', '</div>');
                $this->session->set_flashdata('error_validation', validation_errors());
                    redirect('panelControl');
                    
            }
            else
            {
                  $pass = $this->panelcontrol_model->checkPass($this->input->post('idUser'));
                    
                 if($pass->password_usuario != $this->input->post('passUserAnt'))
                 {
                     $this->session->set_flashdata('pass_incorrecto', 'La contraseña anterior es incorrecta');
                    redirect('panelControl');
                 }
                 else
                {
                    $data['id_user'] = $this->input->post('idUser');
                    $data['password_usuario'] = $this->input->post('passUser1');

                    if($this->panelcontrol_model->updatePassword($data) === true)
                    {
                            $this->panelcontrol_model->updatePassword($data);
                            $this->session->set_flashdata('pass_correcto', 'Se ha actualizado correctamente la contraseña');
                            redirect('panelControl');
                    }	
                 }
            }
        }
        else{redirect('Panelcontrol');}
    }
    
    
    
    public function cambiarPerfil()
    {
        $data['id_user'] = $this->input->post('iduser'); 
        $data['id_perfil'] = $this->input->post('idperfil');
		
       if($this->input->is_ajax_request())   
        {
            
           
           if($this->panelcontrol_model->updateProfileEmployee($data) === true)
           {
               $this->panelcontrol_model->updateProfileEmployee($data);
               
               echo 'Se ha cambiado el perfil del usuario correctamente';
			
           }
		   
		   
        } 
        
    }
    
    // catalogos admin
    public function catalogos()
    {
        if(!$this->user)
        {
            redirect('welcome');
        }
        $data['usuarios'] = $this->panelcontrol_model->getUsers();
        $this->load->view('head'); // head y menu
        
        if($this->user->id_perfil == 1)
        {
            //$this->load->view('panelControl_view', $data);// contenido, y/o controles de usuario
             
            $this->load->library('Grocery_CRUD');
            $this->grocery_crud->set_table('catalogo_tickets_tbl');
            $this->grocery_crud->set_subject('Catalogos');
            $this->grocery_crud->columns('nombre_catalogo','descripcion');
            $this->grocery_crud->display_as('nombre_catalogo','Catalogo');
            $this->grocery_crud->display_as('descripcion','Descripcion de Catalogo');
            $this->grocery_crud->required_fields('nombre_catalogo','descripcion');
            $this->grocery_crud->set_language('spanish');
             $this->grocery_crud->unset_export();
             $this->grocery_crud->unset_print();
            $this->grocery_crud->set_theme('datatables');
            $output = $this->grocery_crud->render();
            
            $this->load->view('catalogoView', $output);
             $this->load->view('footer');// footer
        }
	/*else if($this->user->id_perfil == 2)
        {
            $data['datosUsuarioEmp'] = $this->panelcontrol_model->getEmployeeById($this->user->idUser);
            $this->load->view('panelControlnoAdmin_view', $data);
            
        }
        else if($this->user->id_perfil == 3)
        {
            $data['datosUsuario'] = $this->panelcontrol_model->getClientById($this->user->idUser);
            $this->load->view('panelControlnoAdmin_view', $data);
            
        }*/
        else
        {
        	redirect('panelControl');
        }
        
        
        
       
    }
    
    // subcatalogos admin
    public function subcatalogos()
    {
        if(!$this->user)
        {
            redirect('welcome');
        }
        $data['usuarios'] = $this->panelcontrol_model->getUsers();
        $this->load->view('head'); // head y menu
        
        if($this->user->id_perfil == 1)
        {
            //$this->load->view('panelControl_view', $data);// contenido, y/o controles de usuario
            $this->load->library('Grocery_CRUD');
            $this->grocery_crud->set_table('subcatalogo_tickets_tbl');
            $this->grocery_crud->set_subject('Subcatalogo');
            $this->grocery_crud->set_relation('id_catalogo','catalogo_tickets_tbl','nombre_catalogo');
            $this->grocery_crud->columns('id_catalogo','descripcion');
            $this->grocery_crud->display_as('id_catalogo','Tipo de Catalogo');
            $this->grocery_crud->display_as('descripcion','Descripcion del Subcatalogo');
            $this->grocery_crud->required_fields('id_catalogo','descripcion');
            $this->grocery_crud->set_language('spanish');
             $this->grocery_crud->unset_export();
             $this->grocery_crud->unset_print();
            $this->grocery_crud->set_theme('datatables');
            $output = $this->grocery_crud->render();
            
            
            $this->load->view('catalogoView', $output);
            $this->load->view('footer');// footer
        }
	/*else if($this->user->id_perfil == 2)
        {
            $data['datosUsuarioEmp'] = $this->panelcontrol_model->getEmployeeById($this->user->idUser);
            $this->load->view('panelControlnoAdmin_view', $data);
            
        }
        else if($this->user->id_perfil == 3)
        {
            $data['datosUsuario'] = $this->panelcontrol_model->getClientById($this->user->idUser);
            $this->load->view('panelControlnoAdmin_view', $data);
            
        }*/
        else
        {
        	redirect('Panelcontrol');
        }
       
        
        
        
        
       
    }
}


