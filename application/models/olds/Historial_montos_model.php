<?php
/*
*/
class Historial_montos_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('historial_montos',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_presupuesto_proyecto', $id);
        $this->db->update('historial_montos', $data);        
    }

    function delete($id)
    {
		$this->db->where('id_presupuesto_proyecto', $id);
		$this->db->delete('historial_montos');
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM historial_montos');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("historial_montos");        
        return $query->result();
    }
    
    public function get_contar_todos() {        
        return $this->db->count_all('historial_montos');
    }
    
    function getbuscar($id_presupuesto_proyecto)
    {
        $query = $this->db->query('SELECT * FROM historial_montos WHERE id_presupuesto_proyecto = ?',array($id_presupuesto_proyecto));
        return $query->row();
    }
    
}// fin class
