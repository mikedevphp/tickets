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
    
    public function sucursalExists($sucursal_id, $user)
    {
        if($user->id_perfil == 3)
        {
            $rows = $this->db->select('*')
                    ->from('clientes_sucursales_tbl')
                    ->where('id_sucursal',$sucursal_id)
                    ->where('id_cliente',$user->id_cliente)
                    ->get()->result();
            
            return (count($rows) > 0) ? TRUE : FALSE;
        }
        
        $rows = $this->db->select('*')
                ->from('clientes_sucursales_tbl')
                ->where('id_sucursal',$sucursal_id)
                    ->get()->result();
        return (count($rows) > 0) ? TRUE : FALSE;
    }
    
    public function getAddonsItems()
    {
        return $this->db->select('*')
                ->from('componentes_tbl')
                ->get()->result();
    }
    
    public function getAddonsItemsByItemId($inv_id)
    {
        return $this->db->select('*')
                ->from('inventario_sucursal_componente isc')
                ->join('componentes_tbl c','isc.componente_id = c.componente_id','left')
                ->join('inventario_sucursal s','isc.inv_id = s.inv_id')
                ->where('isc.inv_id',$inv_id)
                ->where('isc.is_deleted',0)
                
                ->get()->result();
    }
    
    public function getAddonByIDActivo($placa,$user)
    {
        if($user->id_perfil == 3)
        {
            return $this->db->select('*')
                ->from('inventario_sucursal')
                ->join('inventario_sucursal_componente isc','isc.inv_id = inventario_sucursal.inv_id')
                ->join('clientes_sucursales_tbl cs','inventario_sucursal.sucusal_id = cs.id_sucursal')
                    ->where('cs.id_cliente',$user->id_cliente)
                ->like('placa_activo',$placa)->get()->result();
        }
        return $this->db->select('*')
                ->from('inventario_sucursal_componente isc')
                ->join('inventario_sucursal','isc.inv_id = inventario_sucursal.inv_id')
                ->like('placa_activo',$placa)->get()->result();
    }
    
    public function saveItem($item)
    {
        return $this->db->where('inv_id',$item['inv_id'])
                ->update('inventario_sucursal',array('descripcion_alt' => $item['descripcion_alt']));
    }
    
    public function saveAddon($addon)
    {
        return $this->db->where('inv_com_id',$addon['inv_com_id'])
                ->update('inventario_sucursal_componente',array('placa_activo' => $addon['placa_activo']));
    }
    
    public function deleteAddon($addon)
    {
        $this->db->trans_begin();
        
        $this->db->where('inv_com_id',$addon['inv_com_id'])
                ->where('inv_id',$addon['inv_id'])
                ->update('inventario_sucursal_componente',array('is_deleted' => TRUE));
        
        $this->db->insert('inventario_mov',array(
                                                        'inv_id' => $addon['inv_id'],
                                                        'sucursal_id' =>$addon['sucursal_id'],
                                                        'inv_com_id' =>$addon['inv_com_id'],
                                                        'status_mov' =>'baja',
                                                        'comentarios' => 'Se dio de baja el componente',
                                                        'fecha_mov' =>date("Y-m-d H:i:s")
                                                )
                );
        
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
           $inv_id = $this->db->insert_id();
           $this->db->insert('inventario_sucursal_componente',
                                                            array(
                                                                'inv_id' => $inv_id,
                                                                'placa_activo' =>$post['placa_activo'],
                                                        'articulo_id' =>$post['articulo_id'],
                                                        'componente_id' =>0,
                                                            ));
           $inv_com_id = $this->db->insert_id();
            $this->db->insert('inventario_mov',
                                                    array(
                                                        'inv_id' => $inv_id,
                                                        'sucursal_id' =>$post['sucursal_id'],
                                                        'inv_com_id' =>$inv_com_id,
                                                        'status_mov' =>'alta',
                                                        'comentarios' => 'Se dio de alta el componente',
                                                        'fecha_mov' =>date("Y-m-d H:i:s")
                                                    )
                    );
            
            
        }
        else
        {
            //$arr = array();
            //$arr_com = array();
            //$arr_mov = array();
            $this->db->insert('inventario_sucursal',
                                                    array(
                                                        'articulo_id' => $post['articulo_id'],
                                                        //'placa_activo' =>$post['placa_activo'],
                                                        'sucusal_id' =>$post['sucursal_id'],
                                                        //'componente_id' =>NULL,
                                                        
                                                        'descripcion_alt' =>$post['descripcion_alt']
                                                    )
                    );
            $inv_id = $this->db->insert_id();
            foreach($componentes as $c)
            {
                if(!is_null($c))
                {
                    /*$arr[] = array('articulo_id' => $post['articulo_id'],
                                                            'sucusal_id' =>$post['sucursal_id'],
                                                            'componente_id' =>$c['id'],
                                                            'placa_activo' =>empty($c['placa_activo']) ? NULL : $c['placa_activo'],
                                                            'descripcion_alt' =>$post['descripcion_alt']);*/
                    
                    /*$arr_com[] = array('articulo_id' => $post['articulo_id'],
                                                            'sucusal_id' =>$post['sucursal_id'],
                                                            'componente_id' =>$c['id'],
                                                            'placa_activo' =>empty($c['placa_activo']) ? 0 : $c['placa_activo'],
                                                            'descripcion_alt' =>$post['descripcion_alt']);*/
                    
                    $this->db->insert('inventario_sucursal_componente',array(
                                                            'articulo_id' => $post['articulo_id'],
                                                            'inv_id' => $inv_id,
                                                            'componente_id' =>$c['id'],
                                                            'placa_activo' =>empty($c['placa_activo']) ? 0 : $c['placa_activo'],
                                                            ));
                    $inv_com_id = $this->db->insert_id();
                    $this->db->insert('inventario_mov',array('inv_id' => $inv_id,
                                                        'sucursal_id' =>$post['sucursal_id'],
                                                        'inv_com_id' => $inv_com_id,
                                                        'status_mov' =>'alta',
                                                        'comentarios' => 'Se dio de alta el componente',
                                                        'fecha_mov' =>date("Y-m-d H:i:s")));
                    
                    /*$arr_mov[] =                        array('articulo_id' => $post['articulo_id'],
                                                        'sucursal_id' =>$post['sucursal_id'],
                                                        'componente_id' =>empty($c['id']) ? 0 : $c['id'],
                                                        'status_mov' =>'alta',
                                                        'fecha_mov' =>date("Y-m-d H:i:s"));*/
                }
            }
            
            
            
            
            //$this->db->insert_batch('inventario_sucursal_componente',$arr_com);
            //$this->db->insert_batch('inventario_mov',$arr_mov);
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
    
    public function getInventoryByItemId($sucursal,$inv_id)
    {
        /*return $this->db->select('c.nombre as componente, isc.placa_activo, im.status_mov, im.fecha_mov, im.comentarios')
                ->from('inventario_sucursal_componente isc')
                ->join('inventario_mov im','isc.inv_id = im.inv_id')
                ->join('articulos_tbl a','isc.articulo_id = a.articulo_id')
                ->join('componentes_tbl c','isc.componente_id = c.componente_id')
                ->where('im.sucursal_id',$sucursal)
                ->where('im.inv_id',$inv_id)
                //->group_by('componente')
                ->get()->result();*/
        
        return $this->db->select('*,'
                . '('
                . 'select c.nombre from componentes_tbl c '
                . 'inner join inventario_sucursal_componente isc on isc.componente_id = c.componente_id '
                . 'where isc.inv_com_id = im.inv_com_id'
                . ') as componente,'
                . '('
                . 'select placa_activo from inventario_sucursal_componente where inv_com_id = im.inv_com_id'
                . ') as placa_activo',FALSE)
                ->from('inventario_mov im')
                ->where('im.sucursal_id',$sucursal)
                ->where('im.inv_id',$inv_id)->get()->result();
        
        
    }
}
