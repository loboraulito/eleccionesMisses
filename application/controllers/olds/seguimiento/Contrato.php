<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contrato extends CI_Controller {

    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
	    if(($this->session->userdata('rol')==4))
	    {		    		
	        $data['empresa_model'] = $this->empresa_model->get_todos();
    	    $data['contenido_principal'] = 'seguimiento/listar_convocatorias';
    	  
    	    //config pagination 
    	    $config = $this->config_pagination->get_config();
    	    $config["base_url"] = base_url() . "seguimiento/contrato/index";	    
    	    $config["total_rows"] = $this->detalle_proyecto_model->get_todos_para_contrato();
    	    $this->pagination->initialize($config);	    
    	    $pageParam = $this->input->get('page');	    
    	    $page = $pageParam ? $pageParam : 0;
    	    $data["resultados"] = $this->detalle_proyecto_model->get_todos_limite_para_contrato($config["per_page"], $page);	        
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
                'monto_adjudicado'=>$this->input->post('monto_adjudicado'),
                'numero_contrato'=>$this->input->post('numero_contrato'),
                'fecha_registro'=>date('Y-m-d H:i:s'),
                'fecha_entrega_item'=>$this->input->post('fecha_entrega_item'),
                'fecha_contrato'=>$this->input->post('fecha_contrato'),
                'observacion'=>$this->input->post('observacion'),
                'id_detalle_proyecto'=>$id,
                'estado'=>'A',
                'id_empresa'=>$this->input->post('id_empresa'),                
            );
       
        
        $this->contrato_model->insert($data);
        
        $data = array(
            'estado' => 'C'
        );
        $this->detalle_proyecto_model->update($id,$data);
	}	
	
	
	
	public function enviar_para_recepcion_y_pago()
	{
	    if(($this->session->userdata('rol')==4))
	    {
	        $data['contenido_principal'] = 'seguimiento/listar_para_pago';
	        $data['titulo'] = "Listado de Items para Recepción y Pago";
	        $data['menu'] = $this->menu_library->get_menu($this->session->userdata('rol'));
	        $data['menu_titulo'] = 'Seguimiento';
	        //config pagination
	        $config = $this->config_pagination->get_config();
	        $config["base_url"] = base_url() . "seguimiento/contrato/enviar_para_pago";
	        $config["total_rows"] = $this->detalle_proyecto_model->get_todos_para_recepcion_contar();
	        $this->pagination->initialize($config);
	        $pageParam = $this->input->get('page');
	        $page = $pageParam ? $pageParam : 0;
	        $data["resultados"] = $this->detalle_proyecto_model->get_todos_limite_para_recepcion($config["per_page"], $page);
	        $data["links"] = $this->pagination->create_links();
	
	        $datosCapsula['data']=$data;
	        $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	
	public function enviar_para_pago($id_detalle,$id_contrato){
	    $data = array(
	        'id_contrato'=>$id_contrato,
            'fecha_envio'=>$this->input->post('fecha_envio'),
            'observacion_envio'=>$this->input->post('observacion_envio'),
            'estado'=>'A',
	        'id_empleado' => $this->session->userdata('id_empleado'),
	    );
	     
	    $this->planilla_model->insert($data);
	    
	    $data = array(
	        'estado'=>'E',
	    );
	    $this->detalle_proyecto_model->update($id_detalle,$data);
	}
	
	public function recepcionar($id_detalle,$id_contrato){
	    $data = array(	        
            'fecha_recepcion'=>$this->input->post('fecha_recepcion'),
            'observacion'=>$this->input->post('observacion'),
            'id_contrato'=>$id_contrato,
	    );
	
	    $this->recepcion_model->insert($data);
	    
	    $data = array(	                    
            'estado'=>'R',
	    );
	    $this->detalle_proyecto_model->update($id_detalle,$data);
	
	}
}
