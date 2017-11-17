<?php
/*
*/
class Planilla_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('planilla',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_planilla', $id);
        $this->db->update('planilla', $data);        
    }

    function delete($id)
    {   
        $data=array('estado'=>'I');
		$this->db->where('id_planilla', $id);
        $this->db->update('planilla', $data); 
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM planilla');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
         
        $query = $this->db->query("SELECT e.*,u.sigla as usigla,a.sigla as asigla
                            from planilla e
                            inner join unidad_funcional u on (e.id_unidad_funcional = u.id_unidad_funcional)
                            inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)");                
        return $query->result();
    }
    
    public function get_todos_proyecto($codigo_sisin) {
                
        $query = $this->db->query("SELECT e.*
                            from planilla e
                            
                            where e.codigo_sisin = $codigo_sisin");
        return $query->result();
    }
    
    public function get_contar_todos() { 
        $this->db->query("SELECT e.*,u.sigla as usigla,a.sigla as asigla
                            from planilla e
                            inner join unidad_funcional u on (e.id_unidad_funcional = u.id_unidad_funcional)
                            inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)");                
        return $this->db->count_all_results();
    }
    
    public function get_proyectos_para_pago($limite, $inicio) {
        $this->db->limit($limite, $inicio);
         
        $query = $this->db->query("SELECT p.*,c.monto_adjudicado,e.nombre,e.nit,d.item,d.descripcion as descripcion_detalle,
                                            pr.codigo_sisin,pr.apertura_programatica,pr.descripcion as descripcion_proyecto,pr.monto_total,
                                            pr1.codigo_sisin as codigo_sisin1,pr1.apertura_programatica as apertura_programatica1,pr1.descripcion as descripcion_proyecto1,pr1.monto_total as monto_total1
                                    from planilla p
                                    left join contrato c on (p.id_contrato = c.id_contrato)
                                    left join detalle_proyecto d on (d.id_detalle_proyecto = c.id_detalle_proyecto)
                                    left join proyecto pr on (pr.codigo_sisin = d.codigo_sisin)
                                    left join proyecto pr1 on (pr1.codigo_sisin = p.codigo_sisin)
                                    left join empresa e on(e.id_empresa = c.id_empresa)
                                    where p.estado = 'A'");
        return $query->result();
    }
    
    public function get_proyectos_para_pago_contar() {
        $this->db->query("SELECT p.*,c.monto_adjudicado,e.nombre,e.nit,d.item,d.descripcion as descripcion_detalle,
                                            pr.codigo_sisin,pr.apertura_programatica,pr.descripcion as descripcion_proyecto,pr.monto_total,
                                            pr1.codigo_sisin as codigo_sisin1,pr1.apertura_programatica as apertura_programatica1,pr1.descripcion as descripcion_proyecto1,pr1.monto_total as monto_total1
                                    from planilla p
                                    left join contrato c on (p.id_contrato = c.id_contrato)
                                    left join detalle_proyecto d on (d.id_detalle_proyecto = c.id_detalle_proyecto)
                                    left join proyecto pr on (pr.codigo_sisin = d.codigo_sisin)
                                    left join proyecto pr1 on (pr1.codigo_sisin = p.codigo_sisin)
                                    left join empresa e on(e.id_empresa = c.id_empresa)
                                    where p.estado = 'A'");
        return $this->db->count_all_results();
    }
    
    function getbuscar($id_planilla)
    {
        $query = $this->db->query('SELECT * FROM planilla WHERE id_planilla = ?',array($id_planilla));
        return $query->row();
    }
    
    public function get_todos_recepcines_pago($id_empleado_encargado) {
        $query = $this->db->query("SELECT p.*,d.item,d.descripcion as descripcion_detalle,c.monto_adjudicado,e.nombre as nombre_empresa,c.fecha_entrega_item,c.numero_contrato,r.fecha_recepcion,r.observacion as recepcion_observacion,pl.fecha_envio,pl.observacion_envio
            FROM proyecto p
            inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
            inner join contrato c on (c.id_detalle_proyecto = d.id_detalle_proyecto)
            inner join recepcion r on (r.id_contrato = c.id_contrato)
            inner join empresa e on (e.id_empresa = c.id_empresa)
            inner join planilla pl on (pl.id_contrato = c.id_contrato)
            where
            p.id_empleado_encargado = $id_empleado_encargado
            ");
        return $query->result();
    }
    
    public function get_todos_para_pago_dpdi($id_empleado_encargado) {
        $query = $this->db->query("select * from 
(SELECT CONCAT(coalesce(p.codigo_sisin,''),coalesce(p1.codigo_sisin,'')) as codigo_sisin,
                                    CONCAT(coalesce(p.descripcion,''),coalesce(p1.descripcion,'')) as descripcion,
                                    (coalesce(p.monto_total,0)+coalesce(p1.monto_total,0)) as monto_total,
                                    c.id_contrato,c.monto_adjudicado,pl.id_empleado as encargado 
                FROM planilla pl left join contrato c on (pl.id_contrato = c.id_contrato) 
                left join detalle_proyecto d on (d.id_detalle_proyecto = c.id_detalle_proyecto) 
                left join proyecto p on (p.codigo_sisin = d.codigo_sisin) 
                left join proyecto p1 on (pl.codigo_sisin = p1.codigo_sisin) 
                having(encargado =  $id_empleado_encargado)) as t
 group by codigo_sisin
            ");
        return $query->result();
    }
    
    public function get_todos_para_pago_dpdi_detalle($codigo_sisin) {
        $query = $this->db->query("SELECT pl.*
            from planilla pl
            left join contrato c on (pl.id_contrato = c.id_contrato)
            left join detalle_proyecto d on (d.id_detalle_proyecto = c.id_detalle_proyecto)
            left join proyecto p on (p.codigo_sisin = d.codigo_sisin)
            where p.codigo_sisin = '$codigo_sisin'
            and pl.estado ='A'
            
            union
            SELECT pl.*
            from planilla pl
            
            where pl.codigo_sisin = '$codigo_sisin'
            and pl.estado ='A'
                
            ");
        return $query->result();
    }
    
}// fin class
