<?php
/*
*/
class Proyecto_fuente_model extends CI_Model{
       
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('proyecto_fuente',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_proyecto_fuente', $id);
        $this->db->update('proyecto_fuente', $data);        
    }

    function delete($id)
    {
        $data=array("estado"=>"I");
		$this->db->where('id_proyecto_fuente', $id);
		$this->db->update('proyecto_fuente',$data);
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT * FROM proyecto_fuente');
        return $query->result();	
    }
    
    public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
        $query = $this->db->get("proyecto_fuente");        
        return $query->result();
    }
    
    public function get_contar_todos() {        
        return $this->db->count_all('proyecto_fuente');
    }
    
    function getbuscar($codigo_sisin)
    {
        $query = $this->db->query('SELECT * FROM proyecto_fuente WHERE codigo_sisin = ?',array($codigo_sisin));
        return $query->row();
    }
    
  
    public function get_todos_limite_where( $codigo_sisin) {
         
        $query = $this->db->query("SELECT pf.*,f.sigla,f.descripcion_organismo,pf.id_fuente_organismo
                            from proyecto_fuente pf
                            inner join fuente_organismo f on (pf.id_fuente_organismo = f.id_fuente_organismo)
                            where pf.codigo_sisin = '".$codigo_sisin."'");   
       
        $resultado = $query->result();
       
        return $resultado;
    }    
}// fin class
