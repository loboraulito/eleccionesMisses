<?php
/*
*/
class Observacion_model extends CI_Model{
    
    function insert($data)
    {
        $data["fecha"]=date('Y-m-d H:i:s');
        $this->db->set($data);
        $this->db->insert('observacion',$data);
    }

    function update($id, $data)
    {
        $data["fecha_ult"]=date('Y-m-d H:i:s');
        $this->db->where('id_observacion', $id);
        $this->db->update('observacion', $data);        
    }

    function delete($id)
    {
		$this->db->where('id_observacion', $id);
		$this->db->delete('observacion');
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM observacion');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("observacion");        
        return $query->result();
    }
        
    public function get_todos_limiteProy($codigo_sisin) {       
         
        $query = $this->db->query("SELECT o.*,CONCAT(e.nombres,' ',e.apellidos) as nombre_completo, CONCAT(eu.nombres,' ',eu.apellidos) as nombre_completo_ult
                            from observacion o
                            inner join empleado e on (e.id_empleado = o.id_empleado)
                            left join empleado eu on (eu.id_empleado = o.id_empleado_ult)
                            where o.codigo_sisin = '".$codigo_sisin."'");
         
        return $query->result();
    }
    
    public function get_todos_limiteProy_contar($codigo_sisin) {       
         
        $this->db->query("SELECT o.*,CONCAT(e.nombres,' ',e.apellidos) as nombre_completo
                            from observacion o
                            inner join empleado e on (e.id_empleado = o.id_empleado)
                            where o.codigo_sisin = '".$codigo_sisin."'");
         
        return $this->db->count_all_results();
    }
    public function get_contar_todos() {        
        return $this->db->count_all('observacion');
    }
    
    function getbuscar($id_observacion)
    {
        $query = $this->db->query('SELECT * FROM observacion WHERE id_observacion = ?',array($id_observacion));
        return $query->row();
    }
    
    public function contarObservacionesActivas($codigo_sisin) { 
        $this->db->where('codigo_sisin', $codigo_sisin);
        $this->db->where('estado', 'A');
        $this->db->from('observacion');
        
        return $this->db->count_all_results();
    }
    
}// fin class
