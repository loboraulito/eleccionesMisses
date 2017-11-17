<?php
/*
*/
class Pasarela_model extends CI_Model{
       
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('pasarela',$data);
    }

    function update($id, $data)
    {
        $this->db->where('idpasarela', $id);
        $this->db->update('pasarela', $data);        
    }
    
    function get_todos()
    {
    	$query = $this->db->get('pasarela');
    	return $query->result();
    }
    
    function get($id)
    {
    	$this->db->where('idpasarela', $id);
    	$query = $this->db->get('pasarela');
    	return $query->row();
    }
}