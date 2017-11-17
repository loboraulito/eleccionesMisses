<?php
/*
*/
class Contrato_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('contrato',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_contrato', $id);
        $this->db->update('contrato', $data);        
    }

    function delete($id)
    {
		$this->db->where('id_contrato', $id);
		$this->db->delete('contrato');
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM contrato');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("contrato");        
        return $query->result();
    }
    
    public function get_contar_todos() {        
        return $this->db->count_all('contrato');
    }
    
    function getbuscar($id_contrato)
    {
        $query = $this->db->query('SELECT * FROM contrato WHERE id_contrato = ?',array($id_contrato));
        return $query->row();
    }
    
    function get_todos_para_pago(){
        $this->db->query("SELECT ct.*, cv.fecha_registro, d.item,d.descripcion,d.cantidad,d.precio_unidad
                from contrato ct
                inner join convocatoria cv on (ct.id_convocatoria = cv.id_convocatoria)
                inner join detalle_proyecto d on (cv.id_detalle_proyecto = d.id_detalle_proyecto)
                where ct.estado = 'E'
            ");
        return $this->db->count_all_results();
    }
    
    public function get_todos_limite_para_pago($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->query("SELECT ct.*, cv.fecha_registro, d.item,d.descripcion,d.cantidad,d.precio_unidad
                from contrato ct
                inner join convocatoria cv on (ct.id_convocatoria = cv.id_convocatoria)
                inner join detalle_proyecto d on (cv.id_detalle_proyecto = d.id_detalle_proyecto)
                where ct.estado = 'E'
            ");
        return $query->result();
    }
    
    public function get_todos_contratos_proyecto_detalle($id_empleado_encargado) {
        $query = $this->db->query("SELECT p.*,d.item,d.descripcion as descripcion_detalle,c.monto_adjudicado,e.nombre as nombre_empresa,c.fecha_entrega_item,c.numero_contrato
            FROM proyecto p
            inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
            inner join contrato c on (c.id_detalle_proyecto = d.id_detalle_proyecto)
            inner join empresa e on (e.id_empresa = c.id_empresa)
            where
            p.id_empleado_encargado = $id_empleado_encargado
            ");
        return $query->result();
    }
}// fin class
