<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyecto_detalle extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index($codigo_sisin)
	{
	    if(($this->session->userdata('rol')==2))
	    {			
	    $data['contenido_principal'] = 'seguimiento/listar_proyecto_detalle';
	    $data['proyecto_model']=$this->proyecto_model->getbuscar($codigo_sisin);
	    
	    //config pagination 
	    $config = $this->config_pagination->get_config();
	    $config["base_url"] = base_url() . "seguimiento/proyecto_detalle/index";	    
	    $config["total_rows"] = $this->detalle_proyecto_model->get_contar_todos();
	    $this->pagination->initialize($config);	    
	    $pageParam = $this->input->get('page');	    
	    $page = $pageParam ? $pageParam : 0;
	    $data["resultados"] = $this->detalle_proyecto_model->get_todos_limiteProy($config["per_page"], $page,$codigo_sisin);	        
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
                'codigo_sisin'=>$this->input->post('codigo_sisin'),
                'item'=>$this->input->post('item'),
                'descripcion'=>$this->input->post('descripcion'),
                'unidad'=>$this->input->post('unidad'),
                'cantidad'=>$this->input->post('cantidad'),
                'precio_unidad'=>$this->input->post('precio_unidad'),
                'fecha_registro'=>$this->input->post('fecha_registro'),
                'estado'=>'N',                
            );        
        $this->detalle_proyecto_model->insert($data);
	}
	
	public function editar(){
	    
	    $data = array(                
                'item'=>$this->input->post('item'),
                'descripcion'=>$this->input->post('descripcion'),
                'unidad'=>$this->input->post('unidad'),
                'cantidad'=>$this->input->post('cantidad'),
                'precio_unidad'=>$this->input->post('precio_unidad'),
	    );	    
	    $this->detalle_proyecto_model->update($this->input->post('id_detalle_proyecto'),$data);
	}
	
}
