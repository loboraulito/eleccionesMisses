<?php
/*
*/
class Area_funcional_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('area_funcional',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_area_funcional', $id);
        $this->db->update('area_funcional', $data);        
    }

    function delete($id)
    {
		$data=array('estado'=>'I');
		$this->db->where('id_area_funcional', $id);
        $this->db->update('area_funcional', $data);
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM area_funcional');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("area_funcional");        
        return $query->result();
    }
    
    public function get_contar_todos() {        
        return $this->db->count_all('area_funcional');
    }
    
    function getbuscar($id_area_funcional)
    {
        $query = $this->db->query('SELECT * FROM area_funcional WHERE id_area_funcional = ?',array($id_area_funcional));
        return $query->row();
    }

    function get_buscar_codigo_area($cod){
        $query = $this->db->query('SELECT * FROM area_funcional WHERE codigo_area = ?',array($cod));
        return $query->row();
    }
    
    function get_last_item()
    {
        $this->db->order_by('id_area_funcional', 'DESC');
        $query = $this->db->get('area_funcional', 1);
    
        return $query->result();
    }
    
}// fin class
