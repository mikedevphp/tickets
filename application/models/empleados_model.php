<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of empleados_model
 *
 * @author IFE
 */
class Empleados_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getPerfiles()
    {
        $this->db->select('id_perfil, nombre_perfil'); 
        $this->db->where('nombre_perfil !=','Cliente');
        $query = $this ->db->get('perfiles_tbl');
        
            if ($query->num_rows() > 0)
            {
                return $query;
            } 
           
    }
    
    public function updateEmployee($data)
    {
        $this->db->where('id_empleado', $data['id_empleado']);
        $this->db->update('empleados_tbl', array('nombres' => $data['nombres'], 
        'apellido_paterno' => $data['apellido_paterno'], 'apellido_materno' => $data['apellido_materno'],
        'ciudad' => $data['ciudad'], 'colonia' => $data['colonia'], 'direccion' => $data['direccion'],
        'telefono' => $data['telefono'], 'telefono_cel' => $data['telefono_cel'],
        'email' => $data['email']));
        
        return true;
    }
    
    public function deleteEmployee($idUser)
    {
        $this->db->where('id_user', $idUser);
        $this->db->delete('usuarios_sistema_tbl');
        return true;
    }
    
    public function getEmployeebyID($id)
    {
       /*$this->db->select('id_perfil, nombre_usuario, descripcion_usuario');
       $this->db->from('usuarios_sistema_tbl');
       $this->db->where('id_user', $id);
       $query = $this->db->get();
       
       if($query->num_rows() > 0)
       {
           return $query;
       }
       
       else
       {
           return null;
       }*/
       
    }
    
    public function createEmployee($dataUsuario, $dataEmpleado)
    {
       $this->db->trans_begin();
        
       $this->db->insert('usuarios_sistema_tbl', array('id_perfil' => $dataUsuario['id_perfil'],
           'nombre_usuario' => $dataUsuario['nombre_usuario'], 
           'password_usuario' => $dataUsuario['password_usuario']));
       
       $this->db->select('id_user');
       $this->db->from('usuarios_sistema_tbl');
       $this->db->where('nombre_usuario', $dataUsuario['nombre_usuario']);
       $query = $query = $this->db->get();
       $row = $query->row();
       
       $this->db->insert('empleados_tbl', array('id_user' => $row->id_user ,
           'nombres' => $dataEmpleado['nombres'],
           'apellido_paterno' => $dataEmpleado['apellido_paterno'], 
           'apellido_materno' => $dataEmpleado['apellido_materno'],
           'ciudad' =>$dataEmpleado['ciudad'] ,
           'colonia' => $dataEmpleado['colonia'],
           'direccion' => $dataEmpleado['direccion'],
           'telefono_cel' => $dataEmpleado['telefono_cel'],
           'telefono' => $dataEmpleado['telefono'],
           'email' => $dataEmpleado['email']));
       
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
    
    public function getEmployees($name='')
    {
        $name = ''; // Variable para busqueda por nombre de usuario 
        
       $this->db->select('usuarios_sistema_tbl.id_user , empleados_tbl.id_empleado as idempleado ,nombre_usuario, perfiles_tbl.id_perfil as idperfil ,nombre_perfil,
           nombres, apellido_paterno, apellido_materno, ciudad, colonia ,direccion as calle,
           telefono, telefono_cel, email');       
       $this->db->from('perfiles_tbl');
       //$this->db->like('nombre_usuario', $name, 'after'); 
       $this->db->join('usuarios_sistema_tbl', 'perfiles_tbl.id_perfil = usuarios_sistema_tbl.id_perfil', 'inner');
       $this->db->join('empleados_tbl', 'usuarios_sistema_tbl.id_user = empleados_tbl.id_user', 'inner');
       $this->db->where('usuarios_sistema_tbl.id_user !=', $this->user->idUser);
       $this->db->order_by('id_user','asc');
       $query = $this->db->get();
       
       if($query->num_rows() > 0)
       {
           return $query;
       }
       
       else
       {
           return null;
       }

    }
}

?>
