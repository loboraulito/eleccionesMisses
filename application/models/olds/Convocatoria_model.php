<?php
/*
*/
class Convocatoria_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('convocatoria',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_convocatoria', $id);
        $this->db->update('convocatoria', $data);        
    }
    
    function update_por_detalle($id, $data)
    {
        $this->db->where('id_detalle_proyecto', $id);
        $this->db->update('convocatoria', $data);        
    }

    function delete($id)
    {
		$this->db->where('id_convocatoria', $id);
		$this->db->delete('convocatoria');
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM convocatoria');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("convocatoria");        
        return $query->result();
    }
    
    public function get_contar_todos() {        
        return $this->db->count_all('convocatoria');
    }
    
    function getbuscar($id_convocatoria)
    {
        $query = $this->db->query('SELECT * FROM convocatoria WHERE id_convocatoria = ?',array($id_convocatoria));
        return $query->row();
    }
    
    function get_todos_where_contar($where){
        $this->db->get_where('convocatoria', $where);
        return $this->db->count_all_results();
    }
    
    public function get_todos_limite_where($limite, $inicio, $where) {
        $query = $this->db->get_where('convocatoria', $where, $limite, $inicio);
        return $query->result();
    }
    
    function get_todos_para_contrato(){
        $this->db->query("SELECT p.codigo_sisin,p.codigo_contrataciones,p.id_empleado_encargado,d.*,c.id_convocatoria
                                    FROM proyecto p
                                    inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
                                    inner join convocatoria c on (c.id_detalle_proyecto = d.id_detalle_proyecto)
                                    where
                                    p.estado = 'P'
                                    and c.estado_convocatoria = 'Adjudicado'");
        return $this->db->count_all_results();
    }
    
    public function get_todos_limite_para_contrato($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->query("SELECT p.codigo_sisin,p.codigo_contrataciones,p.id_empleado_encargado,d.*,c.id_convocatoria
                                    FROM proyecto p
                                    inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
                                    inner join convocatoria c on (c.id_detalle_proyecto = d.id_detalle_proyecto)
                                    where
                                    p.estado = 'P'
                                    and c.estado_convocatoria = 'Adjudicado'");
        return $query->result();
    }
    
}// fin class
