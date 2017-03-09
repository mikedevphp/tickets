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
        $data['sucursal'] = $this->uri->segment(3);
        $this->load->view('head');
        $this->load->view('cliente/sucursales/sucursal_inventario_view',$data);
        //echo $this->uri->segment(3);
        
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
            return json_encode(array('msg' => TRUE));
        }
        
        return json_encode(array('msg' => FALSE));
    }
    
    public function saveItemInventory()
    {
        $result = $this->inventario->saveItemInventory($this->input->post());
        //$result = true;
        echo json_encode(array('msg' => $result));
    }

      public function searchAddonByIDActivo()
      {
          $result = $this->inventario->getAddonByIDActivo($this->uri->segment(3));
            //$result = true;
            echo json_encode(array('msg' => $result));
      }
}
