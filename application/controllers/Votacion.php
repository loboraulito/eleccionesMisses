<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Votacion extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/nombre_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
	     
	    $data['error'] = 0;
	    $data['pasarelas'] = $this->pasarela_model->get_todos(); 
	    $data['participantes'] = $this->participante_model->get_todos(); 
	    $datos['data'] = $data;
	    $datos['contenido_principal'] = 'votar';   
	    $this->load->view('template/template3',$datos);
	}
	public function participante($id){
		$data['pasarelas'] = $this->calificacion_model->get_pasarela_y_calificacion_por_jurado_y_participante($this->session->idjurado,$id);	
		$data['participantes'] = $this->participante_model->get_todos();
		$data['participante'] = $this->participante_model->get($id);
		$data['fotos'] = $this->foto_model->get_fotos_participante($id);
	    $datos['data'] = $data;
	    $datos['contenido_principal'] = 'votar_por_participante';   
	    $this->load->view('template/template3',$datos);
	}	
	public function guardar_voto($idpar,$idpasa,$calificacion)
	{
		$idjur = $this->session->idjurado;
		//echo $idpar.$idpasa.$calificacion.$idjur."";
		$cali = $this->calificacion_model->get_por_jurado_pasarela_participante($idjur,$idpasa,$idpar);
		if(!$cali){
			$data = array(
	                'idjurado'=>$idjur,
	                'idpasarela'=>$idpasa,
	                'idparticipante'=>$idpar,
	                'calificacion'=>$calificacion,                            
	            );
	              
	        $this->calificacion_model->insert($data);
    	}else{
    		$data = array(	                
	                'calificacion'=>$calificacion,                            
	            );
	              
	        $this->calificacion_model->update($cali->idcalificacion, $data);
    	}
	}
}
