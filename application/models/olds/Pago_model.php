<?php
/*
*/
class Pago_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('pago',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_pago', $id);
        $this->db->update('pago', $data);        
    }

    function delete($id)
    {
		$this->db->where('id_pago', $id);
		$this->db->delete('pago');
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM pago');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("pago");        
        return $query->result();
    }
    
    public function get_contar_todos() {        
        return $this->db->count_all('pago');
    }
    
    function getbuscar($id_pago)
    {
        $query = $this->db->query('SELECT * FROM pago WHERE id_pago = ?',array($id_pago));
        return $query->row();
    }
    
    function get_para_pago($limite,$inicio,$id_planilla){
        $this->db->limit($limite, $inicio);
        $query = $this->db->query("SELECT p.*,c.monto_adjudicado,e.nombre,e.nit,d.item,d.descripcion as descripcion_detalle,
                                            pr.codigo_sisin,pr.apertura_programatica,pr.descripcion as descripcion_proyecto,pr.monto_total,
                                            pr1.codigo_sisin as codigo_sisin1,pr1.apertura_programatica as apertura_programatica1,pr1.descripcion as descripcion_proyecto1,pr1.monto_total as monto_total1
                                    from planilla pl  
                                    left join pago p on (p.id_planilla = pl.id_planilla)
                                    left join contrato c on (pl.id_contrato = c.id_contrato)
                                    left join detalle_proyecto d on (d.id_detalle_proyecto = c.id_detalle_proyecto)
                                    left join proyecto pr on (pr.codigo_sisin = d.codigo_sisin)
                                    left join proyecto pr1 on (pr1.codigo_sisin = pl.codigo_sisin)
                                    left join empresa e on(e.id_empresa = c.id_empresa)
                                    where pl.id_planilla = ".$id_planilla);
        $resultados = $query->result();
        return $resultados;
    }
    
    function get_para_pago_contar($id_planilla){
        $this->db->query("SELECT p.*,c.monto_adjudicado,e.nombre,e.nit,d.item,d.descripcion as descripcion_detalle,
                                            pr.codigo_sisin,pr.apertura_programatica,pr.descripcion as descripcion_proyecto,pr.monto_total,
                                            pr1.codigo_sisin as codigo_sisin1,pr1.apertura_programatica as apertura_programatica1,pr1.descripcion as descripcion_proyecto1,pr1.monto_total as monto_total1
                                    from planilla pl  
                                    left join pago p on (p.id_planilla = pl.id_planilla)
                                    left join contrato c on (pl.id_contrato = c.id_contrato)
                                    left join detalle_proyecto d on (d.id_detalle_proyecto = c.id_detalle_proyecto)
                                    left join proyecto pr on (pr.codigo_sisin = d.codigo_sisin)
                                    left join proyecto pr1 on (pr1.codigo_sisin = pl.codigo_sisin)
                                    left join empresa e on(e.id_empresa = c.id_empresa)
                                    where pl.id_planilla = ".$id_planilla);
        return $this->db->count_all_results();
    }
    
    function get_datos_pago($id_planilla){        
        $query = $this->db->query("SELECT pl.*,c.monto_adjudicado,e.nombre,e.nit,d.item,d.descripcion as descripcion_detalle,
                                            pr.codigo_sisin,pr.apertura_programatica,pr.descripcion as descripcion_proyecto,pr.monto_total,
                                            pr1.codigo_sisin as codigo_sisin1,pr1.apertura_programatica as apertura_programatica1,pr1.descripcion as descripcion_proyecto1,pr1.monto_total as monto_total1
                                    from planilla pl
                                    left join contrato c on (pl.id_contrato = c.id_contrato)
                                    left join detalle_proyecto d on (d.id_detalle_proyecto = c.id_detalle_proyecto)
                                    left join proyecto pr on (pr.codigo_sisin = d.codigo_sisin)
                                    left join proyecto pr1 on (pr1.codigo_sisin = pl.codigo_sisin)
                                    left join empresa e on(e.id_empresa = c.id_empresa)
                                    where pl.estado = 'A'
                                        and pl.id_planilla = ".$id_planilla);
        $resultados = $query->row();
        return $resultados;
    }
    
    function get_datos_pagados(){
        $query = $this->db->query("SELECT pl.*,c.monto_adjudicado,e.nombre,e.nit,d.item,d.descripcion as descripcion_detalle,
                                            pr.codigo_sisin,pr.apertura_programatica,pr.descripcion as descripcion_proyecto,pr.monto_total,
                                            pr1.codigo_sisin as codigo_sisin1,pr1.apertura_programatica as apertura_programatica1,pr1.descripcion as descripcion_proyecto1,pr1.monto_total as monto_total1,
                                            p.monto_cancelado, p.fecha_pago, f.sigla, p.observacion as pago_observacion
                                    from planilla pl
                                    inner join pago p on (pl.id_planilla = p.id_planilla)
                                    inner join fuente_organismo f on (p.id_fuente_organismo = f.id_fuente_organismo)
                                    left join contrato c on (pl.id_contrato = c.id_contrato)
                                    left join detalle_proyecto d on (d.id_detalle_proyecto = c.id_detalle_proyecto)
                                    left join proyecto pr on (pr.codigo_sisin = d.codigo_sisin)
                                    left join proyecto pr1 on (pr1.codigo_sisin = pl.codigo_sisin)
                                    left join empresa e on(e.id_empresa = c.id_empresa)
                                    where pl.estado = 'P'"
                                        );
        $resultados = $query->result();
        return $resultados;
    }
    
    function get_datos_por_pagar(){
        $query = $this->db->query("SELECT pl.*,c.monto_adjudicado,e.nombre,e.nit,d.item,d.descripcion as descripcion_detalle,
                                            pr.codigo_sisin,pr.apertura_programatica,pr.descripcion as descripcion_proyecto,pr.monto_total,
                                            pr1.codigo_sisin as codigo_sisin1,pr1.apertura_programatica as apertura_programatica1,pr1.descripcion as descripcion_proyecto1,pr1.monto_total as monto_total1
                                    from planilla pl                                    
                                    left join contrato c on (pl.id_contrato = c.id_contrato)
                                    left join detalle_proyecto d on (d.id_detalle_proyecto = c.id_detalle_proyecto)
                                    left join proyecto pr on (pr.codigo_sisin = d.codigo_sisin)
                                    left join proyecto pr1 on (pr1.codigo_sisin = pl.codigo_sisin)
                                    left join empresa e on(e.id_empresa = c.id_empresa)
                                    where pl.estado = 'A'"
        );
        $resultados = $query->result();
        return $resultados;
    }
}// fin class
