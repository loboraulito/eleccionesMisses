<?php
/*
*/
class Empleado_model extends CI_Model{
    
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('empleado',$data);
    }

    function update($id, $data)
    {
        $this->db->where('id_empleado', $id);
        $this->db->update('empleado', $data);        
    }

    function delete($id)
    {   
        $data=array('estado'=>'I');
		$this->db->where('id_empleado', $id);
        $this->db->update('empleado', $data); 
    }
    
    function get_todos(){
        $query = $this->db->query('SELECT e.*,u.sigla as usigla,a.sigla as asigla, a.id_area_funcional
                            from empleado e
                            inner join unidad_funcional u on (e.id_unidad_funcional = u.id_unidad_funcional)
                            inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)
                            order by e.apellidos, e.nombres');
        return $query->result();
    }
    
    function get_todos_usuarios(){
        $query = $this->db->query(
            "SELECT * FROM empleado e
            inner join usuario u on (u.id_empleado = e.id_empleado)
            where u.rol =7");
        return $query->result();
    }
    
    function get_todos_operador_contrataciones(){
        $query = $this->db->query(
            "SELECT * FROM empleado e
            inner join usuario u on (u.id_empleado = e.id_empleado)
            where u.rol =4");
        return $query->result();
    }
    
    public function get_todos_limite($limite, $inicio) {        
         
        $query = $this->db->query("SELECT e.*,u.sigla as usigla,a.sigla as asigla, a.id_area_funcional
                            from empleado e
                            inner join unidad_funcional u on (e.id_unidad_funcional = u.id_unidad_funcional)
                            inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)
                            order by e.apellidos, e.nombres
                            limit ".$inicio.", ".$limite);   
        //$query = $this->db->get("empleado");  
        //$this->db->limit($limite, $inicio);      
        $resultado = $query->result();
       
        return $resultado;
    }
    
    public function get_todos_limite_buscar($limite, $inicio, $buscar) {
        $buscar = '%'.$buscar.'%';
        
        $query = $this->db->query("SELECT e.*,u.sigla as usigla,a.sigla as asigla, a.id_area_funcional
                            from empleado e
                            inner join unidad_funcional u on (e.id_unidad_funcional = u.id_unidad_funcional)
                            inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)
                            where e.nombres like '$buscar'
                            or e.apellidos like '$buscar'
                            or e.ci like '$buscar'
                            order by e.apellidos, e.nombres
                            limit ".$inicio.", ".$limite);
        //$query = $this->db->get("empleado");
        //$this->db->limit($limite, $inicio);
        $resultado = $query->result();
         
        return $resultado;
    }
    
    public function get_todos_contar_buscar($buscar) {
        $buscar = '%'.$buscar.'%';
        
        $query = $this->db->query("SELECT count(e.id_empleado) as resultado
                            from empleado e
                            inner join unidad_funcional u on (e.id_unidad_funcional = u.id_unidad_funcional)
                            inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)
                            where e.nombres like '$buscar'
                            or e.apellidos like '$buscar'
                            or e.ci like '$buscar'
                            order by e.apellidos, e.nombres"
                            );
        //$query = $this->db->get("empleado");
        //$this->db->limit($limite, $inicio);
        $resultado = $query->row();
               
        return $resultado->resultado;
    }
    
    public function get_contar_todos() { 
        $query = $this->db->query("SELECT count( e.id_empleado ) as resultado
                            from empleado e
                            inner join unidad_funcional u on (e.id_unidad_funcional = u.id_unidad_funcional)
                            inner join area_funcional a on (a.id_area_funcional = u.id_area_funcional)
                            order by e.apellidos, e.nombres");
        
        $resultado = $query->row();
               
        return $resultado->resultado;
    }
    
    function getbuscar($id_empleado)
    {
        $query = $this->db->query('SELECT * FROM empleado WHERE id_empleado = ?',array($id_empleado));
        return $query->row();
    }
    
    function get_last_item()
    {
    	$this->db->order_by('id_empleado', 'DESC');
    	$query = $this->db->get('empleado', 1);
    
    	return $query->result();
    }
    
}// fin class
