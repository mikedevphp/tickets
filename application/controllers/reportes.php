<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reportes
 *
 * @author Miguel Davila
 */
class reportes extends Private_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('reportes_model');
    }
    
    public function index()
    {
         if(!@$this->user) redirect ('welcome/login');
         
        
        
        $this->load->view('head');
        $this->load->view('reportes/reportesView');
        $this->load->view('footer');
    }
    
    public function obtenerCliente()
    {
        if(!@$this->user) redirect ('welcome/login');
        
        $data = $this->reportes_model->getClientsByName($this->input->get('term'));
        echo json_encode($data);
    }
    
    public function clienteReporte()
    {
        if(!@$this->user) redirect ('welcome/login');
        
        $data = $this->reportes_model->getTicketsReportByClientId($this->input->post('cliente_id'));
        echo json_encode($data);
        
    }
}
