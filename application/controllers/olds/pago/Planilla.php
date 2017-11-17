<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planilla extends CI_Controller {

    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
	    if(($this->session->userdata('rol')==6))
	    {		    			        
    	    $data['contenido_principal'] = 'pago/listar_items_para_planilla';
    	    $data['fuente_organismo_model'] = $this->contrato_model->get_todos(); //revizar
    	    $data['titulo'] = "Listado de Contratos para Pago";
    	    $data['menu'] = $this->menu_library->get_menu($this->session->userdata('rol'));
    	    $data['menu_titulo'] = 'Pago';
    	    $data['fuente_organismo_model'] = $this->fuente_organismo_model->get_todos();
    	    //config pagination 
    	    $config = $this->config_pagination->get_config();
    	    $config["base_url"] = base_url() . "pago/pago/index";	    
    	    $config["total_rows"] = $this->planilla_model->get_proyectos_para_pago_contar();
    	    $this->pagination->initialize($config);	    
    	    $pageParam = $this->input->get('page');	    
    	    $page = $pageParam ? $pageParam : 0;
    	    $data["resultados"] = $this->planilla_model->get_proyectos_para_pago($config["per_page"], $page);	        
    	    $data["links"] = $this->pagination->create_links();
    	    	    
    	    $datosCapsula['data']=$data;
    	    $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	public function nuevo($id){
         $data = array( 
                'monto_cancelado'=>$this->input->post('monto_cancelado'),
                'fecha_pago'=>$this->input->post('fecha_pago'),
                'observacion'=>$this->input->post('observacion'),
                'id_fuentes_organismos'=>$this->input->post('id_fuentes_organismos'),
                'id_contrato'=>$id,                
            );
        $this->pago_model->insert($data);
	}	
		
}
