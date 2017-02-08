<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tickets_model
 *
 * @author IFE
 */
class Tickets_model extends CI_Model
{
    
   
    
    public function __construct() 
    { 
        parent::__construct();
        $this->load->database();
    }
    
    public function getLastTicketCreated($idCliente="")
    {
        if($idCliente == "")
        {
           return $this->db->select('*')->from('tickets_tbl')
                ->order_by('fecha_inicio','desc')->limit(1)->get()->row(); 
        }
        else
        {
            
            return $this->db->select('*')->from('tickets_tbl')->where('id_cliente', $idCliente)
                ->order_by('fecha_inicio','desc')->limit(1)->get()->row();
        }
        
    }
    
    public function getClientInfoByTicketCreated($sucursal, $idCliente)
    {
    	if($sucursal <> " ")
    	{
    		return $this->db->select('c.nombre_cliente as nombreCliente, cs.nombre_sucursal as sucursal, cs.ciudad_suc as ciudad, cs.direccion')
    		->from('clientes_tbl c')->join('clientes_sucursales_tbl cs','c.id_cliente = cs.id_cliente','inner')
    		->where('cs.id_sucursal', $sucursal)->get()->row();
    		
    	}
    	
    	
    	return $this->db->select('nombre_cliente as nombreCliente, ciudad_cliente as ciudad, direccion')
    		->from('clientes_tbl')->where('id_cliente', $idCliente)->get()->row();
    }
    
    public function getNewsticketsByDate($time)
    {
        return $this->db->select('*')->from('tickets_tbl')
                ->where('fecha_inicio >', $time)->get()->num_rows();
    }
    
    public function getTypePriorities()
    {
        $this->db->select('id_prioridad, nombre_prioridad'); 
        $queryPrioridad = $this ->db->get('prioridad_tickets_tbl');
        
        if ($queryPrioridad->num_rows() > 0)
        {
            return $queryPrioridad;
        }
    }
    
    public function getTypeStatus()
    {
        $this->db->select('id_status, nombre_status'); 
        $queryPrioridad = $this ->db->get('status_tickets_tbl');
        
        if ($queryPrioridad->num_rows() > 0)
        {
            return $queryPrioridad;
        }
    }
	
	public function getEmailForClient($idCliente)
	{
		$this->db->select('email');
		$this->db->from('clientes_tbl');
		$this->db->where('id_cliente',$idCliente);
		
		$query = $this->db->get();
		
		return $query->row();
	}
    
    public function getTypeTicket()
    {
        $this->db->select('id_catalogo ,nombre_catalogo'); 
        $queryTipo = $this ->db->get('catalogo_tickets_tbl');
        
            if ($queryTipo->num_rows() > 0)
            {
                return $queryTipo;
            }
    }
    
    public function getSubTypeTicket($id)
    {
       $this->db->select('id_subcatalogo ,descripcion');
       $this->db->where('id_catalogo',$id);
        $querySubTipo = $this ->db->get('subcatalogo_tickets_tbl'); 
        
        if ($querySubTipo->num_rows() > 0)
        {
            return $querySubTipo;
        }
    }
    
    public function getTypeTicketById($id)
    {
    	return $this->db->select('nombre_catalogo as tipoTicket')->from('catalogo_tickets_tbl')
    	->where('id_catalogo', $id)->get()->row();
    }
    
    public function getSubTypeTicketById($id)
    {
    	return $this->db->select('descripcion as tipoSubTicket')->from('subcatalogo_tickets_tbl')
    	->where('id_subcatalogo', $id)->get()->row();
    }
    
    public function getBranchesClient($idCliente)
    {
        $this->db->select('id_sucursal');
        $this->db->where('id_cliente', $idCliente);
       $queryBranches = $this->db->get('clientes_sucursales_tbl');
       
       if($queryBranches->num_rows() > 0)
       {
           return $queryBranches;
       }
        else 
        {
           return null;
        }
    }
    
    public function getClients()
    {
       $this->db->select('id_cliente, nombre_cliente');   
       $queryClients = $this->db->get('clientes_tbl');
       
       if($queryClients->num_rows() > 0)
       {
           return $queryClients;
       }
        else 
        {
           return null;
        }
       
    }
    
    public function getNumRowsTickets($idCliente='', $datos=null)
    {
        $parametrosRows = array();
        if($idCliente == '')
        {
            $parametrosRows['empresa'] =($datos['empresa'] == -1) ?  "" : "AND t.id_cliente =".$datos['empresa']." ";
        }
        $parametrosRows['sucursal'] = ($datos['sucursal'] == " ") ? "" : "AND t.id_sucursal ='".$datos['sucursal']."' " ;
        $parametrosRows['ticket'] = ($datos['ticket'] == 0) ? ""  : "AND t.id_catalogo =".$datos['ticket']." ";
        $parametrosRows['status'] = ($datos['status'] == 0) ? "": "AND t.id_status=".$datos['status']." ";
        $parametrosRows['prioridad'] = ($datos['prioridad'] == 0) ? "": "AND t.id_prioridad=".$datos['prioridad']." ";
      
        
        if($idCliente == '' )
        {
            
        
            $sqlQuery = 'Select * from tickets_tbl t WHERE t.id_cliente is not null '.$parametrosRows['empresa'].
                $parametrosRows['sucursal'].$parametrosRows['ticket'].
                $parametrosRows['status'].$parametrosRows['prioridad'].'';
            $numRowsTickets = $this->db->query($sqlQuery);
        }
        else
        {
          $sqlQuery = 'Select * from tickets_tbl t where t.id_cliente ='.$idCliente.' '.
                $parametrosRows['sucursal'].$parametrosRows['ticket'].
                $parametrosRows['status'].$parametrosRows['prioridad'].'';
          $numRowsTickets = $this->db->query($sqlQuery);
        }
      
        
      
        if ($numRowsTickets->num_rows() > 0)
        {
            return $numRowsTickets->num_rows();
        }
        else
        {
            return null;
        } 
        
    }
    
    
    public function createTicket($dataTicket)
    {
        $this->db->trans_begin();
        
        $idTicketLast = $this->db->select('id_ticket')->from('tickets_tbl')
                        ->order_by('id_ticket','desc')->limit(1)->get()->result();
        
        if(count($idTicketLast) == 0)
        {
            $idTicket = 10000;
        }
        else 
       {
            settype($idTicketLast[0]->id_ticket, 'integer');
            
            $idTicket = $idTicketLast[0]->id_ticket + 1;
            
            
       }
          
        $this->db->insert('tickets_tbl', array('id_ticket' => $idTicket, 
            'id_cliente'=> $dataTicket['id_cliente'],'id_sucursal' =>$dataTicket['id_sucursal'], 
            'id_empleado' => $dataTicket['id_empleado'],'id_catalogo'=> $dataTicket['id_catalogo'],
            'id_subcatalogo' =>$dataTicket['id_subcatalogo'], 'id_prioridad' => $dataTicket['id_prioridad'],
            'observaciones_tickets'=> $dataTicket['observaciones_tickets'],
            'fecha_inicio' => $dataTicket['fecha_inicio']));

        if ($this->db->trans_status() === FALSE)
      {
          $this->db->trans_rollback();
          return false;
      }
      else
      {
          $this->db->trans_commit();
          
      }
        return TRUE;
       
       
       
    }
    
    public function openTicket($data)
    {
       $this->db->trans_begin();
       $this->db->where('id_ticket',$data['id_ticket']);
      $this->db->update('tickets_tbl',array('id_status' => '2')); // el numero 2 es el id del status en progreso
      $this->db->insert('tickets_abierto_tbl', array('id_ticket' => $data['id_ticket'],
          'id_empleado' => $data['id_empleado'], 'fecha_abierto' =>$data['fecha_abierto']));                                                           // la tabla de la base de datos
              
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
    
    public function updateTicket($data)
    {
        
        $this->db->insert('tickets_seguimiento_detalles_tbl', array('id_ticket' => $data['id_ticket'],
          'id_empleado' => $data['id_empleado'], 'fecha_seguimiento' =>$data['fecha_seguimiento'], 
            'detalles_seguimiento' => $data['detalles_seguimiento']));
        
        return true;
    }
    
    public function closeTicket($data)
    {
        $this->db->trans_begin();
        $this->db->where('id_ticket',$data['id_ticket']);
        $this->db->update('tickets_tbl',array('id_status' => '3')); // el numero 3 es el id del status cerrado
        $this->db->insert('tickets_cerrados_tbl', array('id_ticket' => $data['id_ticket'],
          'id_empleado' => $data['id_empleado'], 'fecha_cerrado' =>$data['fecha_cerrado'], 
            'detalles_cerrado' => $data['detalles_cerrado']));
       
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
    
    public function getTickets($perPage , $cliente='', $datos=null)
    {
        
        
        if($cliente == '')
        {
     
            return $this->_getTickets($perPage,'',$datos);
            
        }
        
        else 
        {
            return $this->_getTickets($perPage, $cliente, $datos);
        }
    }
      
    
    public function getNotasSeguimiento($idTicket)
    {
        $sqlquery = "select (select nombre_usuario from usuarios_sistema_tbl u inner join empleados_tbl e on u.id_user = e.id_user 
                    where e.id_empleado = tickets_seguimiento_detalles_tbl.id_empleado) as userEmpleado, fecha_seguimiento, 
                    detalles_seguimiento from tickets_seguimiento_detalles_tbl where id_ticket ='".$idTicket."'
                        order by fecha_seguimiento desc";
        
        $queryNotasSeguimiento = $this->db->query($sqlquery);
        
        if ($queryNotasSeguimiento->num_rows() > 0)
        {
            return $queryNotasSeguimiento->result_array();
        }
        else
        {
            return null;
        }
    }
    
    private function _getTickets($perPage, $cliente='', $datos=null)
    {
        $parametros = array();
        
        $page = $datos['page'];
        if($cliente =='')
        {
            $parametros['empresa'] =($datos['empresa'] == -1) ?  " " : "AND t.id_cliente =".$datos['empresa']." ";
        }
        $parametros['sucursal'] = ($datos['sucursal'] == " ") ? " " : "AND t.id_sucursal ='".$datos['sucursal']."' ";
        $parametros['ticket'] = ($datos['ticket'] == 0) ? " " : "AND t.id_catalogo =".$datos['ticket']." ";
        $parametros['status'] = ($datos['status'] == 0) ? " ": "AND t.id_status=".$datos['status']." ";
        $parametros['prioridad'] = ($datos['prioridad'] == 0) ? " ": "AND t.id_prioridad=".$datos['prioridad']." ";
            
            
          
         
          
        if($cliente == '')
        {
   
            $sqlquery = "SELECT (SELECT nombre_usuario FROM usuarios_sistema_tbl u inner join empleados_tbl e 
                on u.id_user = e.id_user where e.id_empleado = ta.id_empleado) AS empTicketAbierto, 
                (SELECT nombre_usuario FROM usuarios_sistema_tbl u inner join empleados_tbl e
                on u.id_user = e.id_user where e.id_empleado = tc.id_empleado) AS empTicketCerrado,        
                ta.fecha_abierto, tc.fecha_cerrado, detalles_cerrado, t.id_ticket AS ticket, e.nombres 	as nomEmpTicket, 
                e.apellido_paterno as apellido1emp, e.apellido_materno as apellido2emp, 
                nombre_cliente as nomCliente, ciudad_cliente, fracc_colonia_cliente as coloniaCliente, 
                c.telefono_cel as celCliente, c.direccion as dirCliente, c.telefono as telCliente, 
                c.email as emailCliente, cs.id_sucursal as sucursal, nombre_sucursal, cs.ciudad_suc as ciudadSuc, cs.fracc_colonia_suc as coloniaSuc , 
                cs.telefono as telSucursal, cs.direccion as dirSuc, telefono_cel_suc as celSuc ,nombre_catalogo, 
                subcat.descripcion, nombre_prioridad, observaciones_tickets, 
                fecha_inicio, nombre_status FROM tickets_tbl t
                LEFT JOIN clientes_tbl c ON t.id_cliente = c.id_cliente
                LEFT JOIN clientes_sucursales_tbl cs on t.id_sucursal = cs.id_sucursal
                LEFT JOIN empleados_tbl e ON t.id_empleado = e.id_empleado
                INNER JOIN catalogo_tickets_tbl cat ON t.id_catalogo = cat.id_catalogo
                INNER JOIN status_tickets_tbl st ON t.id_status = st.id_status
                INNER JOIN prioridad_tickets_tbl prio ON t.id_prioridad = prio.id_prioridad
                INNER JOIN subcatalogo_tickets_tbl subcat ON t.id_subcatalogo = subcat.id_subcatalogo
                LEFT JOIN tickets_abierto_tbl ta ON t.id_ticket = ta.id_ticket 
                LEFT JOIN tickets_cerrados_tbl tc ON t.id_ticket = tc.id_ticket 
                WHERE t.id_cliente is not null ".$parametros['empresa'].$parametros['sucursal'].$parametros['ticket'].$parametros['status'].$parametros['prioridad']." order by fecha_inicio desc 
                LIMIT ".$page.",".$this->db->escape($perPage)."";

            
        }
        
        else 
        {
            $sqlquery = "SELECT (SELECT nombre_usuario FROM usuarios_sistema_tbl u inner join empleados_tbl e 
                    on u.id_user = e.id_user where e.id_empleado = tickets_abierto_tbl.id_empleado) AS empTicketAbierto,
                    (SELECT nombre_usuario FROM usuarios_sistema_tbl u inner join empleados_tbl e
                    on u.id_user = e.id_user where e.id_empleado = tickets_cerrados_tbl.id_empleado) AS empTicketCerrado,
                    tickets_abierto_tbl.fecha_abierto ,tickets_cerrados_tbl.fecha_cerrado ,detalles_cerrado, 
                    t.id_ticket AS ticket, e.nombres as nomEmpTicket, e.apellido_paterno as apellido1emp, 
                    e.apellido_materno as apellido2emp , cs.id_sucursal as sucursal, nombre_catalogo, subcatalogo_tickets_tbl.descripcion, 
                    nombre_prioridad, observaciones_tickets, fecha_inicio, nombre_status FROM tickets_tbl t
                    LEFT JOIN empleados_tbl e ON t.id_empleado = e.id_empleado
                    LEFT JOIN clientes_sucursales_tbl cs ON t.id_sucursal = cs.id_sucursal
                    INNER JOIN catalogo_tickets_tbl ON t.id_catalogo = catalogo_tickets_tbl.id_catalogo
                    INNER JOIN status_tickets_tbl ON t.id_status = status_tickets_tbl.id_status
                    INNER JOIN prioridad_tickets_tbl ON t.id_prioridad = prioridad_tickets_tbl.id_prioridad
                    INNER JOIN subcatalogo_tickets_tbl ON t.id_subcatalogo = subcatalogo_tickets_tbl.id_subcatalogo
                    LEFT JOIN tickets_abierto_tbl ON t.id_ticket = tickets_abierto_tbl.id_ticket
                    LEFT JOIN tickets_cerrados_tbl ON t.id_ticket = tickets_cerrados_tbl.id_ticket
                    
                    WHERE  t.id_cliente =".$this->db->escape($cliente).$parametros['sucursal'].$parametros['ticket'].
                    $parametros['status'].$parametros['prioridad']. " order by fecha_inicio desc
                        LIMIT ".$page.",".$this->db->escape($perPage)."";
        }
              
       $queryTicketsProgreso = $this->db->query($sqlquery);
      
        if ($queryTicketsProgreso->num_rows() > 0)
        {
            return $queryTicketsProgreso;
        }
        else
        {
            return null;
        } 
    }
    
   
    
    
}


