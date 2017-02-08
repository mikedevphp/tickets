<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clientes_model
 *
 * @author IFE
 */
class Clientes_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getPerfil()
    {
        $this->db->select('id_perfil');
        $this->db->where('nombre_perfil','cliente');
        $queryPerfil = $this ->db->get('perfiles_tbl');
        
            if ($queryPerfil->num_rows() > 0)
            {
                return $queryPerfil->row();
            } 
           
    }

    public function createCliente($dataUsuario, $dataCliente)
    {
       $this->db->trans_begin();
        
       $this->db->insert('usuarios_sistema_tbl', array('id_perfil' => $dataUsuario['id_perfil'],
           'nombre_usuario' => $dataUsuario['nombre_usuario'], 'password_usuario' => $dataUsuario['password_usuario']));
       $this->db->select('id_user');
       $this->db->from('usuarios_sistema_tbl');
       $this->db->where('nombre_usuario', $dataUsuario['nombre_usuario']);
       $queryUsuario = $query = $this->db->get();
       $rowUsuario = $queryUsuario->row();
       $this->db->insert('clientes_tbl', array('id_user' => $rowUsuario->id_user ,
       'nombre_cliente' => $dataCliente['nombre_cliente'], 'ciudad_cliente' => $dataCliente['ciudad_cliente'],
       'fracc_colonia_cliente' =>$dataCliente['fracc_colonia_cliente'], 'direccion' => $dataCliente['direccion'],
       'telefono' => $dataCliente['telefono'], 'telefono_cel'=> $dataCliente['telefono_cel'] ,
       'email' => $dataCliente['email']));
       
       if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }
       
    }
    
    public function createSucursal($data)
    {
       $this->db->insert('clientes_sucursales_tbl', 
       array('id_sucursal' => $data['id_sucursal'], 'nombre_sucursal' => $data['nombre_sucursal'],
       'id_cliente' => $data['id_cliente'], 'ciudad_suc' => $data['ciudad_suc'],
       'fracc_colonia_suc' => $data['fracc_colonia_suc'], 'direccion' => $data['direccion'],
       'telefono' => $data['telefono'], 'telefono_cel_suc' => $data['telefono_cel_suc']));
       
       return TRUE;
    }
    
    public function updateCliente($data)
    {
        
        $this->db->where('id_cliente', $data['id_cliente']);
        $this->db->update('clientes_tbl', array('nombre_cliente' => $data['nombre_cliente'],
       'ciudad_cliente' => $data['ciudad_cliente'], 'fracc_colonia_cliente' => $data['fracc_colonia_cliente'], 
        'direccion' => $data['direccion'], 'telefono' => $data['telefono'], 'telefono_cel' => $data['telefono_cel'],
        'email' => $data['email']));
        
        
            return true;
        
    }
  
    public function deleteCliente($idUser)
    {
        $this->db->where('id_user', $idUser);
        $this->db->delete('usuarios_sistema_tbl'); 
        return true;
    }
    
    public function getClients($empresas=FALSE, $name='')
    {
        $name = ''; // variable reservada para buscar clientes por nombre de empresa
       if($empresas == FALSE)
       {
           $sqlQuery ='select u.id_user, nombre_usuario, id_cliente ,nombre_cliente,
              ciudad_cliente, fracc_colonia_cliente , direccion, telefono, telefono_cel ,email,
             (select count(*) from clientes_sucursales_tbl cs where cs.id_cliente = c.id_cliente) 
             as numSucs from clientes_tbl c 
             inner join usuarios_sistema_tbl u on c.id_user = u.id_user';
           
           $queryClients = $this->db->query($sqlQuery);
           
            /*$this->db->select('usuarios_sistema_tbl.id_user , nombre_usuario, nombre_cliente, direccion, telefono, email');       
            $this->db->from('perfiles_tbl');
            $this->db->like('nombre_usuario', $name, 'after'); 
            $this->db->join('usuarios_sistema_tbl', 'perfiles_tbl.id_perfil = usuarios_sistema_tbl.id_perfil','inner');
            $this->db->join('clientes_tbl', 'usuarios_sistema_tbl.id_user = clientes_tbl.id_user','inner');
            $this->db->order_by('id_user','asc');
            $queryClients = $this->db->get();*/
       }
        
       if($empresas == TRUE)
       {
            $this->db->select('id_cliente, nombre_cliente');
            $this->db->from('clientes_tbl');
            $queryClients = $this->db->get();
       }
       
       if($queryClients->num_rows() > 0)
       {
           return $queryClients;
       }
       
       else
       {
           return null;
       }

    }
    
    public function getSucursales($idEmpresa)
    {
        $this->db->select('cs.id_cliente, c.nombre_cliente as empresa, id_sucursal, nombre_sucursal, 
        ciudad_suc, fracc_colonia_suc, cs.direccion , cs.telefono, telefono_cel_suc');
        $this->db->from('clientes_sucursales_tbl cs');
        $this->db->join('clientes_tbl c', 'cs.id_cliente = c.id_cliente', 'inner');
        $this->db->where('cs.id_cliente', $idEmpresa);
        $query =  $this->db->get();
      
      if($query->num_rows() >0)
      {
          return $query->result();
      }
      
      else{ return null;}
    }
    
    public function deleteSucursal($data)
    {
        $this->db->where('id_sucursal', $data['id_sucursal']);
        $this->db->where('id_cliente', $data['id_cliente']);
        $this->db->delete('clientes_sucursales_tbl'); 
        return true;
    }
    
    public function updateSucursal($data)
    {
        $this->db->where('id_sucursal', $data['id_sucursal']);
        $this->db->where('id_cliente', $data['id_cliente']);
        $this->db->update('clientes_sucursales_tbl', array('id_sucursal' => $data['id_sucursal'],
        'nombre_sucursal' => $data['nombre_sucursal'], 'id_cliente' => $data['id_cliente'], 
        'ciudad_suc' => $data['ciudad_suc'], 'fracc_colonia_suc' => $data['fracc_colonia_suc'], 
        'direccion' => $data['direccion'],'telefono' => $data['telefono'], 'telefono_cel_suc' => $data['telefono_cel_suc']));
        
        
            return true;;
    }
}

?>
