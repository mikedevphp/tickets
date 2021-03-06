<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sucursalesInventario
 *
 * @author Miguel Davila
 */
class inventario extends Private_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('inventario_model','inventario');
    }
    
    public function index()
    {
        redirect('clientes');
    }
    
    // obtener el inventario de las sucursales
    public function sucursal()
    {
        
        
        if(!$this->user)
        {
            redirect('welcome');
        }
        
        if($this->uri->segment(4) == 'inventarioDetalle')
        {
           $this->_detail($this->uri->segment(3),$this->uri->segment(5)); 
           //return;
        }
        elseif($this->uri->segment(4) == '')
        {
            $sucursal_id = $this->uri->segment(3);
            
            if($this->inventario->sucursalExists($sucursal_id,$this->user))
            {
                $data['sucursal'] = $sucursal_id;
                $this->load->view('head');
                $this->load->view('cliente/sucursales/sucursal_inventario_view',$data);
        //echo $this->uri->segment(3);
        
                $this->load->view('footer');// footer
            }
            else
            {
                if($this->user == 3)
                {
                    redirect('sucursales');
                }
                else
                {
                    redirect('clientes');
                }
                
            }
            
        
        }
        else
        {
            redirect('clientes');
        }
        
    }
    
    private function _detail($sucursal,$inv_id)
    {
        $this->load->view('head');
        //echo $sucursal;
        $data['sucursal'] = $sucursal;
        $data['rows'] = $this->inventario->getInventoryByItemId($sucursal,$inv_id);
        $this->load->view('cliente/sucursales/sucursal_inventario_detail_view',$data);
        //print_r($data);
        $this->load->view('footer');// footer
    }
    
    public function getTypeItems()
    {
        
        echo json_encode(
                        array(
                            'items' => $this->db->select('a.*, i.*')
                            ->from('inventario_sucursal i')
                ->join('articulos_tbl a','i.articulo_id = a.articulo_id')
                ->where('i.sucusal_id',$this->uri->segment(3))
                        ->get()->result(),
                            'itemsTypes' =>$this->inventario->getTypesItems(),
                            'addonsType' => $this->inventario->getAddonsItems()
                ));
        return;
    }
    
    public function getAddonByItemId()
    {
        $result = $this->inventario->getAddonsItemsByItemId($this->uri->segment(3));

        echo json_encode(array('msg' => $result));
    }

    public function saveItem()
    {
        if($this->inventario->saveItem($this->input->post()))
        {
            return json_encode(array('msg' => TRUE));
        }
        
        return json_encode(array('msg' => FALSE));
    }
    
    public function saveAddon()
    {
        if($this->inventario->saveAddon($this->input->post()))
        {
            echo json_encode(array('msg' => TRUE));
            return;
        }
        
        echo json_encode(array('msg' => FALSE));
    }
    
    public function saveItemInventory()
    {
        $result = $this->inventario->saveItemInventory($this->input->post());
        //$result = true;
        echo json_encode(array('msg' => $result));
    }
    
    public function deleteAddon()
    {
        if($this->inventario->deleteAddon($this->input->post()))
        {
            echo json_encode(array('msg' => TRUE));
            return;
        }
        
        echo json_encode(array('msg' => FALSE));
    }
    
    public function addAddon()
    {
        //print_r($this->input->post());
        
        if($this->inventario->addAddon($this->input->post()))
        {
            echo json_encode(array('msg' => TRUE));
            return;
        }
        
        echo json_encode(array('msg' => FALSE));
    }

    public function searchAddonByIDActivo()
    {
        $result = $this->inventario->getAddonByIDActivo($this->uri->segment(3),$this->user);
          //$result = true;
          echo json_encode(array('msg' => $result));
    }
    
    public function deleteItem()
    {
        if($this->inventario->deleteItemById($this->input->post()))
        {
            echo json_encode(array('msg' => TRUE));
            return;
        }
        
        echo json_encode(array('msg' => FALSE));
        
        //print_r($this->input->post());
    }
}
