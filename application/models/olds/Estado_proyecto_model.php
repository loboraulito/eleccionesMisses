<?php
/*
*/
class Estado_proyecto_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('estado_proyecto',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_estado_proyecto', $id);
        $this->db->update('estado_proyecto', $data);        
    }

    function delete($id)
    {
		$this->db->where('id_estado_proyecto', $id);
		$this->db->delete('estado_proyecto');
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM estado_proyecto');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("estado_proyecto");        
        return $query->result();
    }
    
    public function get_contar_todos() {        
        return $this->db->count_all('estado_proyecto');
    }
    
    function getbuscar($id_estado_proyecto)
    {
        $query = $this->db->query('SELECT * FROM estado_proyecto WHERE id_estado_proyecto = ?',array($id_estado_proyecto));
        return $query->row();
    }
    
}// fin class
