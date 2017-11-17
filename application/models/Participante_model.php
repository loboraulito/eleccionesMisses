<?php
/*
*/
class Participante_model extends CI_Model{
       
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('participante',$data);
    }

    function update($id, $data)
    {
        $this->db->where('idparticipante', $id);
        $this->db->update('participante', $data);        
    }
    
    function get_todos()
    {
    	$query = $this->db->get('participante');
    	return $query->result();
    }
    
    function get($id)
    {
    	$this->db->where('idparticipante', $id);
    	$query = $this->db->get('participante');
    	return $query->row();
    }
}