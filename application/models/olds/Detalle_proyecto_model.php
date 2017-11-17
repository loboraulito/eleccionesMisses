<?php
/*
*/
class Detalle_proyecto_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('detalle_proyecto',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_detalle_proyecto', $id);
        $this->db->update('detalle_proyecto', $data);        
    }

    function delete($id)
    {
		$this->db->where('id_detalle_proyecto', $id);
		$this->db->delete('detalle_proyecto');
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM detalle_proyecto');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("detalle_proyecto");        
        return $query->result();
    }
    
    public function get_todos_limiteProy($limite, $inicio, $codigo_sisin) {
        $this->db->limit($limite, $inicio);
        $this->db->where('codigo_sisin', $codigo_sisin);
        $query = $this->db->get("detalle_proyecto");
        return $query->result();
    }
    
    public function get_contar_todos() {        
        return $this->db->count_all('detalle_proyecto');
    }
    
    function getbuscar($id_detalle_proyecto)
    {
        $query = $this->db->query('SELECT * FROM detalle_proyecto WHERE id_detalle_proyecto = ?',array($id_detalle_proyecto));
        return $query->row();
    }
    
    public function get_contar_detalles($codigo_sisin) {        
        $this->db->where('codigo_sisin', $codigo_sisin);
        $this->db->get("detalle_proyecto");
        $cont = $this->db->count_all_results();        
        return $cont;
    }
    
    function get_todos_para_publicar($limite,$inicio,$codigo_sisin){
        $this->db->limit($limite, $inicio);
        $query = $this->db->query("SELECT p.codigo_sisin,p.codigo_contrataciones,p.id_empleado_encargado,d.*,c.fecha_apertura
                                    FROM proyecto p
                                    inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
                                    left join convocatoria c on (c.id_detalle_proyecto = d.id_detalle_proyecto)
                                    where
                                    p.estado in ('P','D')
                                    and d.estado in ('N','D','P','A')
                                    and p.codigo_sisin = '".$codigo_sisin."'");
        $resultados = $query->result();        
        return $resultados;
    }
    
    function get_todos_para_publicar2($codigo_sisin){
        
        $query = $this->db->query("SELECT p.codigo_sisin,p.codigo_contrataciones,p.id_empleado_encargado,d.*
                                    FROM proyecto p
                                    inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
                                    where
                                    p.codigo_sisin = '".$codigo_sisin."'");
        $resultados = $query->result();
        return $resultados;
    }
    
    function get_todos_para_publicar3($codigo_sisin){
    
        $query = $this->db->query("SELECT p.codigo_sisin,p.codigo_contrataciones,p.id_empleado_encargado,d.*
                                    FROM proyecto p
                                    inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
                                    where
                                    p.codigo_sisin = '".$codigo_sisin."'
                                    and d.estado = 'A'");
        $resultados = $query->result();
        return $resultados;
    }
    
    function get_todos_para_publicar4($codigo_sisin){
    
        $query = $this->db->query("SELECT p.codigo_sisin,p.codigo_contrataciones,p.id_empleado_encargado,d.*
                                    FROM proyecto p
                                    inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
                                    where
                                    p.codigo_sisin = '".$codigo_sisin."'
                                    and d.estado in ('R','P')");
        $resultados = $query->result();
        return $resultados;
    }
    
    function get_todos_para_publicar_contar($codigo_sisin){
        $this->db->query("SELECT p.codigo_sisin,p.codigo_contrataciones,p.id_empleado_encargado,d.*
                                    FROM proyecto p
                                    inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
                                    where
                                    p.estado in ('P','D')
                                    and d.estado in ('N','D','P','A')
                                    and p.codigo_sisin = '".$codigo_sisin."'");
        return $this->db->count_all_results();
    }
    
    function get_todos_limite_para_contrato($limite,$inicio){
        $this->db->limit($limite, $inicio);
        $query = $this->db->query("SELECT d.*,p.codigo_contrataciones, p.descripcion as descrip, c.fecha_apertura
            from detalle_proyecto d
            inner join proyecto p on (p.codigo_sisin = d.codigo_sisin)
            left join convocatoria c on (c.id_detalle_proyecto = d.id_detalle_proyecto)
            where d.estado='A'");
        $resultados = $query->result();
        return $resultados;
    }
    
    function get_todos_para_contrato(){
        $this->db->query("SELECT d.*,p.codigo_contrataciones
            from detalle_proyecto d
            inner join proyecto p on (p.codigo_sisin = d.codigo_sisin)
            where d.estado='A'");
        return $this->db->count_all_results();
    }
    
    function get_todos_limite_para_recepcion($limite,$inicio){
        $this->db->limit($limite, $inicio);
        $query = $this->db->query("SELECT d.*,p.codigo_contrataciones, e.nombre as empresa, c.id_contrato, c.monto_adjudicado,DATE(c.fecha_entrega_item) as fecha_entrega_item
            from detalle_proyecto d
            inner join proyecto p on (p.codigo_sisin = d.codigo_sisin)
            inner join contrato c on (d.id_detalle_proyecto = c.id_detalle_proyecto)
            inner join empresa e on (c.id_empresa = e.id_empresa)
            where d.estado in ('C','R')
            and p.tipo_proyecto = 'Equipamiento'
            ");
        $resultados = $query->result();
        return $resultados;
    }
    
    function get_todos_para_recepcion_contar(){
        $this->db->query("SELECT d.*,p.codigo_contrataciones, e.nombre as empresa, c.id_contrato, c.monto_adjudicado,DATE(c.fecha_entrega_item) as fecha_entrega_item
            from detalle_proyecto d
            inner join proyecto p on (p.codigo_sisin = d.codigo_sisin)
            inner join contrato c on (d.id_detalle_proyecto = c.id_detalle_proyecto)
            inner join empresa e on (c.id_empresa = e.id_empresa)
            where d.estado in ('C','R')
            and p.tipo_proyecto = 'Equipamiento'
            ");
        return $this->db->count_all_results();
    }
    
    function get_todos_por_proyecto($codigo_sisin){
        $query = $this->db->query("SELECT d.*
                                    FROM detalle_proyecto d
                                    where
                                    d.codigo_sisin = '".$codigo_sisin."'");
        return $query->result();
    }
}// fin class
