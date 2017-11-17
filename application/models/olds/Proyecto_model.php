<?php
/*
*/
class Proyecto_model extends CI_Model{
       
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('proyecto',$data);
    }

    function update($id, $data)
    {
        $this->db->where('codigo_sisin', $id);
        $this->db->update('proyecto', $data);        
    }
    
    
    
    function get_todos(){
        $query = $this->db->query('SELECT p.*,u.sigla as usigla
                            from proyecto p
                            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional)');
        return $query->result();
    }
    
    function get_todos_reporte(){
        $query = $this->db->query('SELECT p.*,u.sigla as usigla,CONCAT(e.apellidos," ",e.nombres) as empleado_encargado
                            from proyecto p
                            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional)
                            left join empleado e on (p.id_empleado_tecnico = e.id_empleado)');
        return $query->result();
    }
    function get_todos_reporteobservados(){
        $query = $this->db->query('SELECT p.*,u.sigla as usigla,CONCAT(e.apellidos," ",e.nombres) as empleado_encargado
                            from proyecto p
                            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional)
                            left join empleado e on (p.id_empleado_tecnico = e.id_empleado)
                            inner join observacion o on (o.codigo_sisin = p.codigo_sisin)
        					group by p.codigo_sisin' );
        return $query->result();
    }
    public function get_todos_limite($limite, $inicio) {
        //$this->db->limit($limite, $inicio);
         
        $query = $this->db->query("SELECT p.*,u.sigla as usigla
                            from proyecto p
                            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional)
                            limit ".$inicio.",".$limite);   
        //$query = $this->db->get("empleado");        
        return $query->result();
    }
    
    public function get_contar_todos() { 
        $query = $this->db->query("SELECT count(p.codigo_sisin) as resultado
                            from proyecto p
                            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional)
                            ");
        $resultado = $query->row();
        return $resultado->resultado;
    }
    
    public function get_todos_limite_buscar($limite, $inicio, $buscar) {
    	//$this->db->limit($limite, $inicio);
    	$buscar = '%'.$buscar.'%';
    	 
    	$query = $this->db->query("SELECT p.*,u.sigla as usigla, count(pf.id_fuente_organismo) as num_fuentes
                            from proyecto p
                            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional)
    						left join proyecto_fuente pf on (pf.codigo_sisin = p.codigo_sisin)
    						where p.codigo_sisin like '$buscar'
    						or p.descripcion like '$buscar'
    						group by p.codigo_sisin
                            limit ".$inicio.",".$limite);
    	//$query = $this->db->get("empleado");
    	return $query->result();
    }
    
    public function get_contar_todos_buscar($buscar) {
    	$query = $this->db->query("SELECT count(p.codigo_sisin) as resultado
                            from proyecto p
                            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional)
    						where p.codigo_sisin like '$buscar'
                            ");
    	$resultado = $query->row();
    	return $resultado->resultado;
    }
    
    public function get_todos_limite_aprobar($limite, $inicio) {
        //$this->db->limit($limite, $inicio);
         
        $query = $this->db->query("SELECT p.*,u.sigla as usigla, coalesce(t.c_obs,0) as c_obs,coalesce(d.c_det,0) as c_det
                            from proyecto p
                            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional)
                            left join (
                                select p.codigo_sisin,count(o.id_observacion) as c_obs
                                from proyecto p
                                left join observacion o on (o.codigo_sisin = p.codigo_sisin and o.estado='A')
                                group by p.codigo_sisin
                            ) as t on(t.codigo_sisin = p.codigo_sisin)
                            left join (
                                select p.codigo_sisin, count(d.id_detalle_proyecto) as c_det
                                from proyecto p 
                                left join detalle_proyecto d on (d.codigo_sisin = p.codigo_sisin and d.estado <> 'I')                                
                                group by p.codigo_sisin
                            ) as d on(d.codigo_sisin = p.codigo_sisin)
                            where p.tipo_proyecto in ('Equipamiento','Construcción')
                            limit ".$inicio.",".$limite);
        //$query = $this->db->get("empleado");
        return $query->result();
    }
    
    public function get_contar_todos_aprobar() {
        $query = $this->db->query("select count(s.codigo_sisin) as resultado
                                    from (SELECT p.*,u.sigla as usigla, coalesce(t.c_obs,0),coalesce(d.c_det,0)
                                            from proyecto p
                                            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional)
                                            left join (
                                                select p.codigo_sisin, count(o.id_observacion) as c_obs
                                                from proyecto p 
                                                inner join observacion o on (o.codigo_sisin = p.codigo_sisin)
                                                where o.estado = 'A'
                                                group by p.codigo_sisin
                                            ) as t on(t.codigo_sisin = p.codigo_sisin)
                                            left join (
                                                select p.codigo_sisin, count(d.id_detalle_proyecto) as c_det
                                                from proyecto p 
                                                inner join detalle_proyecto d on (d.codigo_sisin = p.codigo_sisin)
                                                where d.estado = 'A'
                                                group by p.codigo_sisin
                                            ) as d on(d.codigo_sisin = p.codigo_sisin)
                                            where p.tipo_proyecto in ('Equipamiento','Construcción')
                                     ) as s                                    
                            ");
        $resultado = $query->row();
        return $resultado->resultado;
    }
    
    public function get_todos_limite_aprobar_dpdi($limite, $inicio) {
        //$this->db->limit($limite, $inicio);
         
        $query = $this->db->query("SELECT p.*,u.sigla as usigla,0 as monto_adjudicado
            from proyecto p 
            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional) 
            where p.tipo_proyecto in ('Investigación','Evaluación') 
            UNION 
            SELECT p.*,u.sigla as usigla, c.monto_adjudicado
            from proyecto p 
            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional) 
            inner join detalle_proyecto d on (d.codigo_sisin = p.codigo_sisin) 
            inner join contrato c on (c.id_detalle_proyecto = d.id_detalle_proyecto) 
            where p.tipo_proyecto in ('Construcción')
            limit ".$inicio.",".$limite);
        //$query = $this->db->get("empleado");
        return $query->result();
    }
    
    public function get_todos_limite_aprobar_dpdi2() {
        //$this->db->limit($limite, $inicio);
         
        $query = $this->db->query("SELECT p.*,u.sigla as usigla
            from proyecto p
            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional)
            where p.tipo_proyecto in ('Investigación','Evaluación')
            UNION
            SELECT p.*,u.sigla as usigla
            from proyecto p
            inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional)
            inner join detalle_proyecto d on (d.codigo_sisin = p.codigo_sisin)
            inner join contrato c on (c.id_detalle_proyecto = d.id_detalle_proyecto)
            where p.tipo_proyecto in ('Construcción')
            ");
        //$query = $this->db->get("empleado");
        return $query->result();
    }
    
    public function get_todos_planillas_solicitadas() {
        //$this->db->limit($limite, $inicio);
         
        $query = $this->db->query("SELECT CONCAT(coalesce(p.codigo_sisin,''),coalesce(p1.codigo_sisin,'')) as codigo_sisin,
            CONCAT(coalesce(p.descripcion,''),coalesce(p1.descripcion,'')) as descripcion,
            (coalesce(p.monto_total,0)+coalesce(p1.monto_total,0)) as monto_total,
            c.id_contrato,c.monto_adjudicado,pl.id_empleado as encargado 
            FROM planilla pl left join contrato c on (pl.id_contrato = c.id_contrato) 
            left join detalle_proyecto d on (d.id_detalle_proyecto = c.id_detalle_proyecto) 
            left join proyecto p on (p.codigo_sisin = d.codigo_sisin) 
            left join proyecto p1 on (pl.codigo_sisin = p1.codigo_sisin) 
            having(encargado = 6)
            ");
        //$query = $this->db->get("empleado");
        return $query->result();
    }
    
    public function get_contar_todos_aprobar_dpdi() {
        $query = $this->db->query("
            select count(tabla.codigo_sisin) as resultado
            from (
                SELECT p.*,u.sigla as usigla 
                from proyecto p 
                inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional) 
                where p.tipo_proyecto in ('Investigación','Evaluación') 
                UNION 
                SELECT p.*,u.sigla as usigla 
                from proyecto p 
                inner join unidad_funcional u on (p.id_unidad_funcional = u.id_unidad_funcional) 
                inner join detalle_proyecto d on (d.codigo_sisin = p.codigo_sisin) 
                inner join contrato c on (c.id_detalle_proyecto = d.id_detalle_proyecto) 
                where p.tipo_proyecto in ('Construcción')
            ) as tabla
                            ");
        if($query->num_rows() > 0){
            $resultado = $query->row();
            $final = $resultado->resultado;
        }
        else 
            $final = 0;
        
        return $final;
    }
    
    function get_todos_where($where){
        $query = $this->db->get_where('proyecto', $where);
        return $query->result();
    }
     function get_todos_aprobados1(){
        $query = $this->db->query("SELECT p.*,CONCAT(e.apellidos,' ',e.nombres) as tecnico_asignado
                                    FROM proyecto p  
                                    inner join historial_aprobaciones ha on (ha.codigo_sisin = p.codigo_sisin)                                   
                                    left join empleado e on (e.id_empleado = ha.id_empleado)
                                    where 
                                      ha.estado ='P'
                                   ");
        return $query->result();
    }
    function get_todos_aprobados2(){
        $query = $this->db->query("SELECT p.*,CONCAT(e.apellidos,' ',e.nombres) as tecnico_asignado
                                    FROM proyecto p                                    
                                    left join empleado e on (e.id_empleado = p.id_empleado_encargado)
                                    where 
                                      p.estado ='P' and p.codigo_contrataciones != ''
                                   ");
        return $query->result();
    }
     function get_todos_aprobadosreport(){
        $query = $this->db->query("SELECT p.*,CONCAT(e.apellidos,' ',e.nombres) as tecnico_asignado
                                    FROM proyecto p                                    
                                    left join empleado e on (e.id_empleado = p.id_empleado_tecnico)
                                    where 
                                      p.estado ='P' 
                                   ");
        return $query->result();
    }
    
    public function get_todos_limite_where($limite, $inicio, $where) {
        $query = $this->db->get_where('proyecto', $where, $limite, $inicio);        
        return $query->result();
    }
    
    function getbuscar($codigo_sisin)
    {
      //  $query = $this->db->query('SELECT * FROM proyecto, empleado WHERE codigo_sisin = '.$codigo_sisin.' and id_empleado_tecnico=id_empleado');
        //return $query->row();

       $query = $this->db->query('SELECT p.*,e.nombres,e.apellidos FROM proyecto p left join empleado e on (p.id_empleado_tecnico = e.id_empleado) WHERE codigo_sisin = '.$codigo_sisin);
        return $query->row();
    }
        
    public function get_todos_limite_para_publicar_contar_todos($id_empleado_encargado) {        
        $query = $this->db->query("SELECT count(p.codigo_sisin) as resultado
                                    FROM proyecto p
                                    inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
                                    left join empleado e on (e.id_empleado = p.id_empleado_encargado)
                                    where 
                                      p.estado in ('P','D')
                                      and d.estado in ('N','P','D')
                                      and p.fecha_registro_contrataciones is not NULL
                                      and p.id_empleado_encargado = ".$id_empleado_encargado."
                                    group by p.codigo_sisin");
        if($query->num_rows() > 0){
            $resultado = $query->row();
            $final = $resultado->resultado;
        }
        else 
            $final = 0;
        
        return $final;
    }
    
    public function get_todos_limite_para_publicar($limite, $inicio,$id_empleado_encargado) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->query("SELECT p.*,e.apellidos,e.nombres,c.fecha_apertura
                                    FROM proyecto p
                                    inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
                                    left join empleado e on (e.id_empleado = p.id_empleado_encargado)
                                     left join convocatoria c on (c.id_detalle_proyecto = d.id_detalle_proyecto)
                                    where
                                      p.estado in ('P','D')
                                      and d.estado in ('N','P','D')
                                      and p.fecha_registro_contrataciones is not NULL 
                                      and p.id_empleado_encargado = $id_empleado_encargado

                                    group by p.codigo_sisin");
        return $query->result();
    }
    
    public function get_todos_para_publicar($id_empleado_encargado) {        
        $query = $this->db->query("SELECT p.*,e.apellidos,e.nombres
            FROM proyecto p
            inner join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
            left join empleado e on (e.id_empleado = p.id_empleado_encargado)
            where
            p.estado in ('P','D')
            and d.estado in ('N','P','D')
            and p.fecha_registro_contrataciones is not NULL
            and p.id_empleado_encargado = $id_empleado_encargado
            group by p.codigo_sisin");
        return $query->result();
    }
    
    public function get_todos_proyectos_sin_publicar($id_empleado_encargado) {
        $query = $this->db->query("SELECT p.*
            FROM proyecto p
            right join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)            
            where
            p.estado in ('P','D')
            and d.estado in ('N','D')
            and p.fecha_registro_contrataciones is not NULL
            and p.id_empleado_encargado = $id_empleado_encargado
            group by p.codigo_sisin");
        return $query->result();
    }
    
    public function get_todos_items_sin_publicar($codigo_sisin) {
        $query = $this->db->query("SELECT d.*
            FROM detalle_proyecto d 
            where            
            d.estado in ('N','D')            
            and d.codigo_sisin = $codigo_sisin
            ");
        return $query->result();
    }
    
    public function get_todos_proyectos_publicados($id_empleado_encargado) {
        $query = $this->db->query("SELECT p.*
            FROM proyecto p
            right join detalle_proyecto d on (p.codigo_sisin = d.codigo_sisin)
            where
            p.estado in ('P','D') 
            and d.estado = ('P')
            and p.fecha_registro_contrataciones is not NULL
            and p.id_empleado_encargado = $id_empleado_encargado
            group by p.codigo_sisin");
        return $query->result();
    }
    
    public function get_todos_items_publicados($codigo_sisin) {
        $query = $this->db->query("SELECT d.* , c.fecha_publicacion, c.fecha_apertura, c.fecha_contrato, c.fecha_entrega
            FROM detalle_proyecto d
            inner join convocatoria c on (d.id_detalle_proyecto = c.id_detalle_proyecto)
            where
            d.estado = 'P' and
            d.codigo_sisin = $codigo_sisin
            ");
        return $query->result();
    }
    
    function get_buscar_codigo_sisin($cod){
        $query = $this->db->query('SELECT * FROM proyecto WHERE codigo_sisin = ?',array($cod));
        return $query->row();
    }
    
    public function get_todos_para_asignar_contar() {
        $this->db->query("SELECT p.*
                            FROM proyecto p                             
                            where
                            p.estado = 'P'
                            and p.fecha_registro_contrataciones is NULL
                            and p.codigo_sisin not in (
                                	select distinct(d.codigo_sisin)
                                    from detalle_proyecto d
                                    where
                                    d.estado != 'N'
                                )
                            and p.tipo_proyecto in ('Equipamiento','Construcción')");
        return $this->db->count_all_results();
    }
    
    public function get_todos_para_asignar($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->query("SELECT p.*
                            FROM proyecto p                             
                            where
                            p.estado = 'P'
                            and p.fecha_registro_contrataciones is NULL
                            and p.codigo_sisin not in (
                                	select distinct(d.codigo_sisin)
                                    from detalle_proyecto d
                                    where
                                    d.estado != 'N'
                                )
                            and p.tipo_proyecto in ('Equipamiento','Construcción')");
        return $query->result();
    }
    
    public function get_todos_reporte_tecnico($id_empleado_tecnico) {        
        $query = $this->db->query("Select p.*,u.sigla as usigla
                                    from proyecto p
                                    left join unidad_funcional u on (u.id_unidad_funcional = p.id_unidad_funcional)
                                    left join detalle_proyecto d on (d.codigo_sisin = p.codigo_sisin)
                                    left join convocatoria c on (d.id_detalle_proyecto = c.id_detalle_proyecto)
                                    left join contrato co on (d.id_detalle_proyecto = co.id_detalle_proyecto)
                                    left join empresa e on (co.id_empresa = e.id_empresa)
                                    left join planilla pl on (pl.id_contrato = co.id_contrato)
                                    left join pago pa on (pa.id_planilla = pl.id_planilla)
                                    
                                    left join planilla pl1 on (pl1.codigo_sisin = p.codigo_sisin)
                                    left join pago pa1 on (pa1.id_planilla = pl1.id_planilla)
                                    where p.id_empleado_tecnico = ".$id_empleado_tecnico);
        return $query->result();
    }
    
    public function get_todos_reporte_tecnico_detalle($id_empleado_tecnico,$codigo_sisin) {
        $query = $this->db->query("Select d.*
                                    from proyecto p
                                    left join unidad_funcional u on (u.id_unidad_funcional = p.id_unidad_funcional)
                                    left join detalle_proyecto d on (d.codigo_sisin = p.codigo_sisin)
                                    left join convocatoria c on (d.id_detalle_proyecto = c.id_detalle_proyecto)
                                    left join contrato co on (d.id_detalle_proyecto = co.id_detalle_proyecto)
                                    left join empresa e on (co.id_empresa = e.id_empresa)
                                    left join planilla pl on (pl.id_contrato = co.id_contrato)
                                    left join pago pa on (pa.id_planilla = pl.id_planilla)
    
                                    left join planilla pl1 on (pl1.codigo_sisin = p.codigo_sisin)
                                    left join pago pa1 on (pa1.id_planilla = pl1.id_planilla)
                                    where p.id_empleado_tecnico = ".$id_empleado_tecnico.
                                    " and p.codigo_sisin = '".$codigo_sisin."'");
        return $query->result();
    }
    
    public function get_todos_reporte_tecnico2($id_empleado_tecnico) {
        $query = $this->db->query("Select p.*,u.sigla as usigla
                                    from proyecto p
                                    left join unidad_funcional u on (u.id_unidad_funcional = p.id_unidad_funcional)                                    
                                    where p.id_empleado_tecnico = ".$id_empleado_tecnico);
        return $query->result();
    }
}// fin class
