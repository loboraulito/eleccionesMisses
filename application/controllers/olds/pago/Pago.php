<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pago extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index($id_planilla)
	{
	    if(($this->session->userdata('rol')==6))
	    {		    			        
    	    $data['contenido_principal'] = 'pago/listar_para_pago';
    	    $data['id_planilla'] = $id_planilla;
    	    $data['fuente_organismo_model'] = $this->fuente_organismo_model->get_buscar_por_planilla($id_planilla);
    	    $data['datos_pago'] = $this->pago_model->get_datos_pago($id_planilla);
    	   
    	    //config pagination 
    	    $config = $this->config_pagination->get_config();
    	    $config["base_url"] = base_url() . "pago/pago/index";	    
    	    $config["total_rows"] = $this->pago_model->get_para_pago_contar($id_planilla);
    	    $this->pagination->initialize($config);	    
    	    $pageParam = $this->input->get('page');	    
    	    $page = $pageParam ? $pageParam : 0;
    	    $data["resultados"] = $this->pago_model->get_para_pago($config["per_page"], $page, $id_planilla);	        
    	    $data["links"] = $this->pagination->create_links();
    	    	    
    	    $datosCapsula['data']=$data;
    	    $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	public function nuevo($id_planilla){
         $data = array(                 
                'monto_cancelado'=>$this->input->post('monto_cancelado'), 
                'fecha_pago'=>$this->input->post('fecha_pago'), 
                'observacion'=>$this->input->post('observacion'), 
                'id_fuente_organismo'=>$this->input->post('id_fuente_organismo'), 
                'estado'=>'E', 
                'id_planilla'=>$id_planilla                
            );
        $this->pago_model->insert($data);
        
        $data = array(
            
            'estado'=>'P',
            
        );
        $this->planilla_model->update($id_planilla,$data);
	}	
		
}
