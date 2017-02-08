<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reportes_model
 *
 * @author Miguel Davila
 */
class Reportes_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getClientsByName($name)
    {
        return $this->db->select('id_cliente, nombre_cliente')->from('clientes_tbl')
                ->like('nombre_cliente',$name)->get()->result();
    }
    
    public function getTicketsReportByClientId($idCliente)
    {
        return $this->db->select('t.id_catalogo as idCatalogo, '
                                . '(select count(*) from tickets_tbl where id_catalogo =  idCatalogo) as numTickets,'
                                . ' ct.nombre_catalogo as nombreCatalogo',FALSE)
                                ->from('tickets_tbl t')
                                ->join('catalogo_tickets_tbl ct','t.id_catalogo = ct.id_catalogo','inner')
                                ->where('id_cliente', $idCliente)
                                ->group_by('t.id_catalogo')
                                ->get()->result();
    }
}
