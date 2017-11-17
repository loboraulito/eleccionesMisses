<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyecto extends CI_Controller {

    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
	    if(($this->session->userdata('rol')==5))
	    {
		//$this->load->view('welcome_message');
		$data['datos']=$this->proyecto_model->get_todos();		
		$data['unidad_funcional_model']=$this->unidad_funcional_model->get_todos();
		$data['fuente_organismo_model']=$this->fuente_organismo_model->get_todos();
		$data['usuario_model']=$this->usuario_model->get_todos_usuarios();
		$data['empleado_model']=$this->empleado_model->get_todos_usuarios();
	    $data['contenido_principal'] = 'planilla/listar_proyectos';
	   
	    //config pagination 
	    $config = $this->config_pagination->get_config();
	    $config["base_url"] = base_url() . "administracion/proyecto/index";	    
	    $config["total_rows"] = $this->proyecto_model->get_contar_todos_aprobar_dpdi();	    
	    
	    $this->pagination->initialize($config);	    
	    $pageParam = $this->input->get('page');	    
	    $page = $pageParam ? $pageParam : 0;
	    $data["results"] = $this->proyecto_model->get_todos_limite_aprobar_dpdi($config["per_page"], $page);	        
	    $data["links"] = $this->pagination->create_links();
	    	    
	    $datosCapsula['data']=$data;
	    $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	
	public function planilla($codigo_sisin){
         $data = array(	        
            'fecha_envio'=>date('Y-m-d H:i:s'),
             'observacion_envio'=>$this->input->post('detalle'),
             'monto'=>$this->input->post('monto_a_pagar'),
             'codigo_sisin'=>$codigo_sisin,
             'id_empleado' => $this->session->userdata('id_empleado'),
            'estado'=>'A',
	    );
	     
	    $this->planilla_model->insert($data);	    
	}

}
