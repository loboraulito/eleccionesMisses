<?php
/*
*/
class Historial_aprobaciones_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('historial_aprobaciones',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_historial_aprobaciones', $id);
        $this->db->update('historial_aprobaciones', $data);        
    }

    function delete($id)
    {
		$this->db->where('id_historial_aprobaciones', $id);
		$this->db->delete('historial_aprobaciones');
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM historial_aprobaciones');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("historial_aprobaciones");        
        return $query->result();
    }
    
    public function get_contar_todos() {        
        return $this->db->count_all('historial_aprobaciones');
    }
    
    function getbuscar($id_historial_aprobaciones)
    {
        $query = $this->db->query('SELECT * FROM historial_aprobaciones WHERE id_historial_aprobaciones = ?',array($id_historial_aprobaciones));
        return $query->row();
    }
    
}// fin class
