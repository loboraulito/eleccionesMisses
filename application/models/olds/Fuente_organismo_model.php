<?php
/*
*/
class Fuente_organismo_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('fuente_organismo',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_fuente_organismo', $id);
        $this->db->update('fuente_organismo', $data);        
    }

    function delete($id)
    {
		$data=array('estado'=>'I');
		$this->db->where('id_fuente_organismo', $id);
        $this->db->update('fuente_organismo', $data);
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM fuente_organismo');
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("fuente_organismo");        
        return $query->result();
    }
    
    public function get_contar_todos() {        
        $query = $this->db->query('SELECT count(f.id_fuente_organismo) as resultado FROM fuente_organismo f');
        $resultado = $query->row();
        return $resultado->resultado;
    }
    
    function getbuscar($id_fuente_organismo)
    {
        $query = $this->db->query('SELECT * FROM fuente_organismo WHERE id_fuente_organismo = ?',array($id_fuente_organismo));
        return $query->row();
    }
    
    function get_buscar_codigo_organismo($cod){
        $query = $this->db->query('SELECT * FROM fuente_organismo WHERE codigo_organismo = ?',array($cod));
        return $query->row();
    }
    
    function get_buscar_por_planilla($id_planilla){
        $query = $this->db->query("SELECT f.* 
                                    from planilla pl
                                    inner join contrato c on (pl.id_contrato = c.id_contrato)
                                    inner join detalle_proyecto d on (d.id_detalle_proyecto = c.id_detalle_proyecto)
                                    inner join proyecto pr on (pr.codigo_sisin = d.codigo_sisin)
                                    inner join proyecto_fuente pf on (pr.codigo_sisin = pf.codigo_sisin)
                                    inner join fuente_organismo f on (f.id_fuente_organismo = pf.id_fuente_organismo)
                                    where pl.estado = 'A'
                                    and pl.id_planilla = ?
                                    UNION
                                    SELECT f.* 
                                    from planilla pl                                    
                                    inner join proyecto pr on (pr.codigo_sisin = pl.codigo_sisin)
                                    inner join proyecto_fuente pf on (pr.codigo_sisin = pf.codigo_sisin)
                                    inner join fuente_organismo f on (f.id_fuente_organismo = pf.id_fuente_organismo)
                                    where pl.estado = 'A'
                                    and pl.id_planilla = ?
            ",array($id_planilla,$id_planilla));
        return $query->result();
    }
    
}// fin class
