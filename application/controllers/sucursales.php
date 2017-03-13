<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sucursales
 *
 * @author IFE
 */
class sucursales extends Private_Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
		if(!$this->user )
		{
			redirect('welcome');
		}
		//print_r($this->user);
        $data['sucursales'] =$this->clientes_model->getSucursales($this->user->id_cliente);
		$this->load->view('head'); // head y menu
		$this->load->view('cliente/sucursales/sucursales_view', $data);
		$this->load->view('footer');
           	

    }
    
    public function crearSucursal()
    {
	
		if(!$this->user )
		{
			redirect('welcome');
		}
		
        $data['idCliente'] = $this->user->id_cliente;
		$this->load->view('head'); // head y menu
		$this->load->view('cliente/sucursales/crearSucursal_view', $data);
		$this->load->view('footer');
		
		$action = $this->input->post('registrarSucursal');
		
		if($action == 'registrar')
		{
			$this->form_validation->set_rules('numeroSuc','numero de sucursal',
                   'trim|required|xss_clean');
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
						  '<p class ="alert alert-success "><a class="close" data-dismiss="alert">x</a>Se ha registrado correctamente la sucursal</p>');
				  redirect('sucursales');
				}
			}
		}
    }
}

?>
