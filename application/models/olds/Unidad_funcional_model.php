<?php
/*
*/
class Unidad_funcional_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('unidad_funcional',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_unidad_funcional', $id);
        $this->db->update('unidad_funcional', $data);        
    }

    function delete($id)
    {
		$data=array('estado'=>'I');
		$this->db->where('id_unidad_funcional', $id);
        $this->db->update('unidad_funcional', $data);
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT u.*,a.sigla as asigla,a.codigo_area
                            from unidad_funcional u
                            inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)
                            order by a.codigo_area,u.codigo_unidad');
        return $query->result();
    }
    
	public function get_todos_limite($limite, $inicio) {
        $this->db->limit($limite, $inicio);
         
        $query = $this->db->query("SELECT u.*,a.sigla as asigla,a.codigo_area
                            from unidad_funcional u
                            inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)
                            order by a.codigo_area,u.codigo_unidad
                            limit ".$inicio.",".$limite);   
        //$query = $this->db->get("empleado");        
        return $query->result();
    }
        
    public function get_contar_todos() { 
        $query = $this->db->query("SELECT count(u.id_unidad_funcional) as resultado
                            from unidad_funcional u
                            inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)"
                            );
        $resultado = $query->row();
        return $resultado->resultado;
    }
    
    public function get_todos_limite_buscar($limite, $inicio, $buscar) {
    	$buscar = '%'.$buscar.'%';
    	 
    	$this->db->limit($limite, $inicio);
    
    	$query = $this->db->query("SELECT u.*,a.sigla as asigla,a.codigo_area
    		from unidad_funcional u
    		inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)
    		where u.sigla like '$buscar'
    		order by a.codigo_area,u.codigo_unidad
    		limit ".$inicio.",".$limite);
    	//$query = $this->db->get("empleado");
    	return $query->result();
    }
    
    public function get_contar_todos_buscar($buscar) {
    	$buscar = '%'.$buscar.'%';
    	
    	$query = $this->db->query("SELECT count(u.id_unidad_funcional) as resultado
                            from unidad_funcional u
                            inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)
    						where u.sigla like '$buscar'"
    	);
    	$resultado = $query->row();
    	return $resultado->resultado;
    }
    
    function getbuscar($id_unidad_funcional)
    {
        $query = $this->db->query('SELECT * FROM unidad_funcional WHERE id_unidad_funcional = ?',array($id_unidad_funcional));
        return $query->row();
    }
    function get_buscar_codigo_unidad($area,$cod){
        $query = $this->db->query('SELECT * FROM unidad_funcional WHERE codigo_unidad = ? and id_area_funcional = ?',array($cod,$area));
        echo $query;
        return $query->row();
    }
    
}// fin class
