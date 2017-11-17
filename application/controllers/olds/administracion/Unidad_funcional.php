<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidad_funcional extends CI_Controller {

    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
	    if(($this->session->userdata('rol')==1))
	    {		
	    	$data['buscar']=$this->input->get('buscar');
	    	
    		$data['area_funcional_model']=$this->area_funcional_model->get_todos();    		
    	    $data['contenido_principal'] = 'administracion/listar_unidad_funcional';
    	  
    	    //config pagination 
    	    $config = $this->config_pagination->get_config();
    	    $config["base_url"] = base_url() . "administracion/unidad_funcional/index";	    
    	    $config["total_rows"] = $this->unidad_funcional_model->get_contar_todos_buscar($data['buscar']);    	    
    	    $this->pagination->initialize($config);	    
    	    $pageParam = $this->input->get('page');	    
    	    $page = $pageParam ? $pageParam : 0;
    	    $data["resultados"] = $this->unidad_funcional_model->get_todos_limite_buscar($config["per_page"], $page,$data['buscar']);	        
    	    $data["links"] = $this->pagination->create_links();
    	    	    
    	    $datosCapsula['data']=$data;
    	    $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	public function nuevo(){
         $data = array(
                'codigo_unidad'=>$this->input->post('codigo_unidad'),
                'sigla'=>$this->input->post('sigla'),
                'descripcion'=>$this->input->post('descripcion'),
                'estado'=>'A',
                'id_area_funcional'=>$this->input->post('id_area_funcional'),     
            );
       
        $this->unidad_funcional_model->insert($data);
	}
	
	public function editar($id){
	    $data = array(	
            'codigo_unidad'=>$this->input->post('codigo_unidad'),
            'sigla'=>$this->input->post('sigla'),
            'descripcion'=>$this->input->post('descripcion'),
            'id_area_funcional'=>$this->input->post('id_area_funcional'),  
	        'estado'=>$this->input->post('estado'), 
	    );
	    
	    $this->unidad_funcional_model->update($id,$data);
	}
	public function borrar($id){
	    $this->unidad_funcional_model->delete($id);
	}	

    public function validar_unidad($area){
        $cod_unidad = $this->input->get('codigo_unidad');
        $existe = $this->unidad_funcional_model->get_buscar_codigo_unidad($area,$cod_unidad);
         
        if($existe) {
            $this->output->set_status_header('404');
        }
        else $this->output->set_status_header('200');
    }
}
