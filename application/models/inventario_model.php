<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inventario_model
 *
 * @author Miguel Davila
 */
class Inventario_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function getTypesItems()
    {
        return $this->db->select('*')
                ->from('articulos_tbl')
                ->get()->result();
    }
    
    public function getAddonsItems()
    {
        return $this->db->select('*')
                ->from('componentes_tbl')
                ->get()->result();
    }
    
    public function saveItemInventory($post)
    {
        $this->db->trans_begin();
        $componentes = json_decode($post['componente_id'],TRUE);
        
       if(!empty($post['placa_activo']))
       {
           $this->db->insert('inventario_sucursal',
                                                    array(
                                                        'articulo_id' => $post['articulo_id'],
                                                        //'placa_activo' =>$post['placa_activo'],
                                                        'sucusal_id' =>$post['sucursal_id'],
                                                        //'componente_id' =>NULL,
                                                        
                                                        'descripcion_alt' =>$post['descripcion_alt']
                                                    )
                    );
           
           $this->db->insert('inventario_sucursal_componente',
                                                            array(
                                                                'placa_activo' =>$post['placa_activo'],
                                                        'articulo_id' =>$post['articulo_id'],
                                                        'componente_id' =>0,
                                                            ));
           
            $this->db->insert('inventario_mov',
                                                    array(
                                                        'articulo_id' => $post['articulo_id'],
                                                        'sucursal_id' =>$post['sucursal_id'],
                                                        'componente_id' =>0,
                                                        'status_mov' =>'alta',
                                                        'fecha_mov' =>date("Y-m-d H:i:s")
                                                    )
                    );
            
            
        }
        else
        {
            //$arr = array();
            $arr_com = array();
            $arr_mov = array();
            foreach($componentes as $c)
            {
                if(!is_null($c))
                {
                    /*$arr[] = array('articulo_id' => $post['articulo_id'],
                                                            'sucusal_id' =>$post['sucursal_id'],
                                                            'componente_id' =>$c['id'],
                                                            'placa_activo' =>empty($c['placa_activo']) ? NULL : $c['placa_activo'],
                                                            'descripcion_alt' =>$post['descripcion_alt']);*/
                    
                    $arr_com[] = array('articulo_id' => $post['articulo_id'],
                                                            /*'sucusal_id' =>$post['sucursal_id'],*/
                                                            'componente_id' =>$c['id'],
                                                            'placa_activo' =>empty($c['placa_activo']) ? 0 : $c['placa_activo'],
                                                            /*'descripcion_alt' =>$post['descripcion_alt']*/);
                    
                    $arr_mov[] = array('articulo_id' => $post['articulo_id'],
                                                        'sucursal_id' =>$post['sucursal_id'],
                                                        'componente_id' =>empty($c['id']) ? 0 : $c['id'],
                                                        'status_mov' =>'alta',
                                                        'fecha_mov' =>date("Y-m-d H:i:s"));
                }
            }
            
            
            $this->db->insert('inventario_sucursal',
                                                    array(
                                                        'articulo_id' => $post['articulo_id'],
                                                        //'placa_activo' =>$post['placa_activo'],
                                                        'sucusal_id' =>$post['sucursal_id'],
                                                        //'componente_id' =>NULL,
                                                        
                                                        'descripcion_alt' =>$post['descripcion_alt']
                                                    )
                    );
            
            $this->db->insert_batch('inventario_sucursal_componente',$arr_com);
            $this->db->insert_batch('inventario_mov',$arr_mov);
       }
        
        
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return FALSE;
        }
        else
        {
                $this->db->trans_commit();
                return TRUE;
        }
        
        
        
        
    }
}
