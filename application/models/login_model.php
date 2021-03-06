<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_model
 *
 * @author IFE
 */
class Login_Model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
    
    // por el momento nos traeremos un usuario para efectos de test, 
    //aqui se hara una consulta a la tabla usuarios_sistema_tbl, para verificar
    //que los datos propocionados por el usuario corresponden a los existentes
    //en la tabla
    
    
    // FUNCION QUE SE TRAE DATOS DE UN USUARIO EXISTENTE, ESTOS DATOS SE UTILIZARAN PARA GUARDARLOS EN LA SESION
    /* SE MODIFICO LA FUNCION ACTUAL */
    
   public function get($username='', $password='') 
     {
        // VERIFICA ANTES QUE SE ENCUENTRE EL USUARIO REGISTRADO
        $this->db->select('id_perfil');
        $this->db->from('usuarios_sistema_tbl');
        $this->db->where(array('nombre_usuario' => $username, 'password_usuario' => $password));
        
       $userExists = $this->db->get()->row();
       
       if($userExists)
       {
        // VERIFICA SI EL ID DEL PERFIL ES EL NUMERO 3, ESTE NUMERO CORRESPONDE AL PERFIL CLIENTE
        // SE HACE ESTA CONSULTA PARA SABER SI ES CLIENTE O NO, PORQUE NECESITAMOS EL CAMPO
        // YA SEA EL ID DEL CLIENTE O DE UN EMPLEADO, EL CUAL SE USA PARA A LA HORA DE CREAR TICKETS
  
            if($userExists->id_perfil == 3)
            {
                return $this->_getClient($username);
            }
            
 
            return  $this->_getEmployee($username);
        
       }
        
        
    }
        
    private function _getEmployee($username)
    {
         $this->db->select('empleados_tbl.id_user as idUser, id_empleado, id_perfil, nombre_usuario, email');
                $this->db->from('usuarios_sistema_tbl');
                $this->db->join('empleados_tbl','usuarios_sistema_tbl.id_user = empleados_tbl.id_user','inner');
                $this->db->where('nombre_usuario',$username);

                return $this->db->get()->row();
    }
    
    private function _getClient($username)
    {
          $this->db->select('clientes_tbl.id_user as idUser, id_cliente, id_perfil, nombre_usuario, nombre_cliente, email');
                $this->db->from('usuarios_sistema_tbl');
                $this->db->join('clientes_tbl','usuarios_sistema_tbl.id_user = clientes_tbl.id_user','inner');
                $this->db->where('nombre_usuario',$username);

                return $this->db->get()->row();
    }
    
    // SIRVE PARA CONTAR TODOS LOS TICKETS CREADOS Y LOS MANDA POR ESTATUS
    public function countTicketbyAll()
    {
        $sqlquery = 'SELECT (SELECT COUNT( id_status ) FROM tickets_tbl WHERE id_status =1) AS Abierto, 
                        (SELECT COUNT( id_status ) FROM tickets_tbl WHERE id_status =2) AS Progreso, 
                        (SELECT COUNT( id_status ) FROM tickets_tbl WHERE id_status =3) AS Cerrado';
        
        $queryCountTickets = $this->db->query($sqlquery);
      
        if ($queryCountTickets->num_rows() > 0)
        {
            return $queryCountTickets->row();
        }
        else
        {
            return null;
        }
       
    }
    
}

?>
