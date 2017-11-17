<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyecto_observacion extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index($codigo_sisin)
	{
	    if(($this->session->userdata('rol')==2))
	    {			
	    $data['contenido_principal'] = 'seguimiento/listar_proyecto_observacion';
	    $data['proyecto_model']=$this->proyecto_model->getbuscar($codigo_sisin);
	   
	    $data["resultados"] = $this->observacion_model->get_todos_limiteProy($codigo_sisin);	        
	  
	    $datosCapsula['data']=$data;
	    $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	public function nuevo(){
         $data = array(
                'observacion'=>$this->input->post('observacion'),                
                'codigo_sisin'=>$this->input->post('codigo_sisin'),                
                'id_empleado'=>$this->session->userdata('id_empleado'),
                'estado' => 'A',                
            );        
        $this->observacion_model->insert($data);

          $data=array('estado' => 'O');
        $this->proyecto_model->update($this->input->post('codigo_sisin'),$data);
	}
	
	public function editar(){
	    
	    $data = array(
            'observacion'=>$this->security->xss_clean($this->input->post('observacion')), 
            'id_empleado_ult'=>$this->session->userdata('id_empleado'),            
	    );	    
	    $this->observacion_model->update($this->input->post('id_observacion'),$data);

	}
	
	public function anular($id_observacion){
	     
	    $data = array(
	        'estado'=>'N',
	        'id_empleado_ult'=>$this->session->userdata('id_empleado'),	        
	    );
	    $this->observacion_model->update($id_observacion,$data);
	    
	 //  $dato=array('estado' => 'A');                                                   revisar no actualiza el proyecto
      //  $this->proyecto_model->update($this->input->post('codigo_sisin'),$dato);

	}
	
}
