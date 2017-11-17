<?php
/*
*/
class Foto_model extends CI_Model{
       
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('foto',$data);
    }

    function update($id, $data)
    {
        $this->db->where('idfoto', $id);
        $this->db->update('foto', $data);        
    }
    
    function get_todos()
    {
    	$query = $this->db->get('foto');
    	return $query->result();
    }
    
    function get($id)
    {
    	$this->db->where('idfoto', $id);
    	$query = $this->db->get('foto');
    	return $query->row();
    }

    function get_fotos_participante($id)
    {
        $this->db->where('idparticipante', $id);
        $query = $this->db->get('foto');
        return $query->result();
    }
}