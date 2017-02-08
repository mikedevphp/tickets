<?php


class Panelcontrol_Model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getUsers()
    {
        $this->db->select('nombre_perfil, usuarios_sistema_tbl.id_user, nombre_cliente ,usuarios_sistema_tbl.id_perfil as idperfil, nombre_usuario');
        $this->db->from('usuarios_sistema_tbl');
        $this->db->join('perfiles_tbl', 'usuarios_sistema_tbl.id_perfil = perfiles_tbl.id_perfil', 'inner');
        $this->db->join('clientes_tbl', 'usuarios_sistema_tbl.id_user = clientes_tbl.id_user', 'left');
        $this->db->order_by('nombre_usuario','asc');
       $query = $this->db->get();
       
       if($query->num_rows() > 0)
       {
           return $query->result();
       }
    }
    
    public function checkPass($iduser)
    {
        $this->db->select('password_usuario');
        $this->db->from('usuarios_sistema_tbl');
        $this->db->where('id_user', $iduser);
        
        $query = $this->db->get();
        
        if($query->num_rows() > 0)
       {
           return $query->row();
       }
       
       else
       {
           return null;
       }
        
    }
    
    public function updatePassword($data)
    {
        $iduser = $data['id_user'];
        $campos = array('password_usuario' => $data['password_usuario']);
        
        $this->db->where('id_user', $iduser);
        $this->db->update('usuarios_sistema_tbl', $campos); 
        return true;
    }
    
    public function updateProfileEmployee($data)
    {
        $iduser = $data['id_user'];
        $campos = array('id_perfil' => $data['id_perfil']);
        
        $this->db->where('id_user', $iduser);
        $this->db->update('usuarios_sistema_tbl', $campos); 
        return true;
    }
    
    public function getClientByID($idUser)
    {
        $this->db->select('id_cliente, id_user ,nombre_cliente ,ciudad_cliente, fracc_colonia_cliente,
        direccion as calle, telefono, telefono_cel, email');
        $this->db->from('clientes_tbl');
        $this->db->where('id_user', $idUser);
        
        $query = $this->db->get();
        
        return $query->row();
    }
	
	public function getEmployeeByID($idUser)
    {
        $this->db->select('id_empleado, id_user ,nombres ,apellido_paterno, apellido_materno, 
		ciudad, colonia, direccion, telefono, telefono_cel, email');
        $this->db->from('empleados_tbl');
        $this->db->where('id_user', $idUser);
        
        $query = $this->db->get();
        
        return $query->row();
    }
}

?>
