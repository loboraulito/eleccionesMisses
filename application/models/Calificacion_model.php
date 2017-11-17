<?php
/*
*/
class Calificacion_model extends CI_Model{
       
    function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('calificacion',$data);
    }

    function update($id, $data)
    {
        $this->db->where('idcalificacion', $id);
        $this->db->update('calificacion', $data);        
    }
    
    function get_todos()
    {
    	$query = $this->db->get('calificacion');
    	return $query->result();
    }
    
    function get($id)
    {
    	$this->db->where('idcalificacion', $id);
    	$query = $this->db->get('calificacion');
    	return $query->row();
    }

    function get_pasarela_y_calificacion_por_jurado_y_participante($idj,$idpar){
        $query = $this->db->query("SELECT p.idpasarela,p.nombre,p.ponderacion,pa.idparticipante,j.idjurado,c.calificacion FROM pasarela p
join participante pa
join jurado j
left join calificacion c on c.idpasarela = p.idpasarela and c.idparticipante = pa.idparticipante and c.idjurado = j.idjurado
where j.idjurado = $idj and pa.idparticipante = $idpar
order by j.nombre,pa.idparticipante,p.idpasarela");
        return $query->result();
    }

    function get_por_jurado_pasarela_participante($idj,$idpasa,$idpar)
    {
        $this->db->where('idjurado', $idj);
        $this->db->where('idpasarela', $idpasa);
        $this->db->where('idparticipante', $idpar);
        $query = $this->db->get('calificacion');
        return $query->row();
    }

    function get_calificaciones_sin_suma(){
        $query = $this->db->query("SELECT j.nombre as jnombre, pa.nombres, pa.apellidos, p.nombre as pnombre, c.calificacion FROM pasarela p
join participante pa
join jurado j
left join calificacion c on c.idpasarela = p.idpasarela and c.idparticipante = pa.idparticipante and c.idjurado = j.idjurado
order by j.nombre,pa.idparticipante,p.idpasarela");
        return $query->result();
    }

    function get_calificaciones_con_suma(){
        $query = $this->db->query("SELECT p.nombre as pnombre,pa.apellidos,pa.nombres,sum(c.calificacion) as suma FROM pasarela p
join participante pa
join jurado j
left join calificacion c on c.idpasarela = p.idpasarela and c.idparticipante = pa.idparticipante and c.idjurado = j.idjurado
group by pa.idparticipante,p.idpasarela
order by pa.idparticipante,p.idpasarela");
        return $query->result();
    }

    function get_calificaciones_finales(){
        $query = $this->db->query("SELECT pa.apellidos,pa.nombres,sum(c.calificacion) as suma FROM pasarela p
join participante pa
join jurado j
left join calificacion c on c.idpasarela = p.idpasarela and c.idparticipante = pa.idparticipante and c.idjurado = j.idjurado
group by pa.idparticipante
order by suma desc");
        return $query->result();
    }
}