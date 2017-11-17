<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fuente_organismo extends CI_Controller {

    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
	    if(($this->session->userdata('rol')==1))
	    {		
    		$data['fuente_organismo_model']=$this->fuente_organismo_model->get_todos();    		
    	    $data['contenido_principal'] = 'administracion/listar_fuente_organismo';    	
    	  
    	    $data["resultados"] = $this->fuente_organismo_model->get_todos();	          
    	    $datosCapsula['data']=$data;
    	    $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	public function nuevo(){
         $data = array(
                'sigla'=>$this->input->post('sigla'),
                'codigo_fuente'=>$this->input->post('codigo_fuente'),
                'descripcion_fuente'=>$this->input->post('descripcion_fuente'),
                'codigo_organismo'=>$this->input->post('codigo_organismo'),
                'descripcion_organismo'=>$this->input->post('descripcion_organismo'),
                'estado' => 'A',            
            );
        $this->fuente_organismo_model->insert($data);
	}
	
	public function editar($id){
	    $data = array(
            'sigla'=>$this->input->post('sigla'),
            'codigo_fuente'=>$this->input->post('codigo_fuente'),
            'descripcion_fuente'=>$this->input->post('descripcion_fuente'),
            'codigo_organismo'=>$this->input->post('codigo_organismo'),
            'descripcion_organismo'=>$this->input->post('descripcion_organismo'),  
	        'estado'=>$this->input->post('estado'),
	    );
	    
	    $this->fuente_organismo_model->update($id,$data);
	}
	
	public function borrar($id){
	    $this->fuente_organismo_model->delete($id);
	}	
	
	public function validar_cod_organismo(){	     
	    $cod_org = $this->input->get('codigo_organismo');
	    $existe = $this->fuente_organismo_model->get_buscar_codigo_organismo($cod_org);
	    
	    if($existe) {
	        $this->output->set_status_header('404');
	    }
	    else $this->output->set_status_header('200'); 
	}
}
