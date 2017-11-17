<?php
/*
*/
class Empresa_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('empresa',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_empresa', $id);
        $this->db->update('empresa', $data);        
    }

    function delete($id)
    {   
        $data=array('estado'=>'I');
		$this->db->where('id_empresa', $id);
		$this->db->update('empresa',$data);
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM empresa');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("empresa");        
        return $query->result();
    }
    
    public function get_contar_todos() {        
        return $this->db->count_all('empresa');
    }
    
    function getbuscar($id_empresa)
    {
        $query = $this->db->query('SELECT * FROM empresa WHERE id_empresa = ?',array($id_empresa));
        return $query->row();
    }
    
    function get_buscar_nombre($cod){
        $query = $this->db->query('SELECT * FROM empresa WHERE nombre = ?',array($cod));
        return $query->row();
    }
     function get_buscar_nit($cod){
        $query = $this->db->query('SELECT * FROM empresa WHERE nit = ?',array($cod));
        return $query->row();
    }
}// fin class
