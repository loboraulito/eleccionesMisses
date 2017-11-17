<?php
/*
*/
class Recepcion_model extends CI_Model{
            
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('recepcion',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_recepcion', $id);
        $this->db->update('recepcion', $data);        
    }

    function delete($id)
    {
		$this->db->where('id_recepcion', $id);
		$this->db->delete('recepcion');
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM recepcion');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("recepcion");        
        return $query->result();
    }
    
    public function get_contar_todos() {        
        return $this->db->count_all('recepcion');
    }
    
    function getbuscar($id_recepcion)
    {
        $query = $this->db->query('SELECT * FROM recepcion WHERE id_recepcion = ?',array($id_recepcion));
        return $query->row();
    }
    function getbuscar_todos($id_empleado)
    {
        $query = $this->db->query('SELECT * FROM recepcion WHERE id_empleado = ?',array($id_empleado));
        return $query->result();
    }    
    
    public function get_todos_recepcines($id_empleado_encargado) {
        $query = $this->db->query("SELECT p.*,d.item,d.descripcion as descripcion_detalle,c.monto_adjudicado,e.nombre as nombre_empresa,c.fecha_entrega_item,c.numero_contrato,r.fecha_recepcion,r.observacion as recepcion_observacion
            FROM proyecto p
            inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
            inner join contrato c on (c.id_detalle_proyecto = d.id_detalle_proyecto)
            inner join recepcion r on (r.id_contrato = c.id_contrato)
            inner join empresa e on (e.id_empresa = c.id_empresa)
            where
            p.id_empleado_encargado = $id_empleado_encargado
            ");
        return $query->result();
    }
}// fin class
