<?php
/*
*/
class Jurado_model extends CI_Model{
       
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('jurado',$data);
    }

    function update($id, $data)
    {
        $this->db->where('idjurado', $id);
        $this->db->update('jurado', $data);        
    }
    
    function get_todos()
    {
    	$query = $this->db->get('jurado');
    	return $query->result();
    }
    
    function get($id)
    {
    	$this->db->where('idjurado', $id);
    	$query = $this->db->get('jurado');
    	return $query->row();
    }

    function get_por_nombre($nombre)
    {
        $this->db->where('nombre', $nombre);
        $query = $this->db->get('jurado');
        return $query->row_array();
    }
}