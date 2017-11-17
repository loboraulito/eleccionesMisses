<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyecto_fuente extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index($id)
	{
	    if(($this->session->userdata('rol')==1))
	    {		    		
	          		
    		$data['fuente_organismo_model']=$this->fuente_organismo_model->get_todos();
    		$data['proyecto_model']=$this->proyecto_model->getbuscar($id);
            $data["resultados"] = $this->proyecto_fuente_model->get_todos_limite_where($id);     
    	    $data['contenido_principal'] = 'administracion/listar_proyecto_fuente';
    	   
    	  
    	    $datosCapsula['data']=$data;
    	    $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	public function nuevo($id){
         $data = array(
                'monto'=>$this->input->post('monto'),
                'codigo_sisin'=>$id,
                'id_fuente_organismo'=>$this->input->post('id_fuente_organismo'),
                'estado' => 'A',               
            );
       
        
        $this->proyecto_fuente_model->insert($data);
	}
	
	public function editar($id){
	    $data = array(	        
	         'monto'=>$this->input->post('monto'),                
             'id_fuente_organismo'=>$this->input->post('id_fuente_organismo'),  
	         'estado' => $this->input->post('estado'),
	    );
	    
	    $this->proyecto_fuente_model->update($id,$data);
	}

	public function borrar($id){
	    $this->proyecto_fuente_model->delete($id);
	}
}
