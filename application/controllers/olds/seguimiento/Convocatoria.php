<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Convocatoria extends CI_Controller {

	    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
	if(($this->session->userdata('rol')==4))
	    {
	        $id_empleado_encargado = $this->session->userdata('id_empleado');
	        //$this->load->view('welcome_message');
	        
	        $data['contenido_principal'] = 'seguimiento/listar_proyectos_sin_publicar';
	       	        
	        //config pagination
	        $config = $this->config_pagination->get_config();
	        $config["base_url"] = base_url() . "seguimiento/convocatoria/index";
	        $config["total_rows"] = $this->proyecto_model->get_todos_limite_para_publicar_contar_todos($id_empleado_encargado);
	        $this->pagination->initialize($config);
	        $pageParam = $this->input->get('page');
	        $page = $pageParam ? $pageParam : 0;
	        $data["resultados"] = $this->proyecto_model->get_todos_limite_para_publicar($config["per_page"], $page,$id_empleado_encargado);
	        $data["links"] = $this->pagination->create_links();
	    
	        $datosCapsula['data']=$data;
	        $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	
	public function observar($id){	   
        $data = array(
            'observacion'=>$this->input->post('observacion'),
            'codigo_sisin'=>$id,
            'id_empleado'=>$this->session->userdata('id_empleado'),
            'estado' => 'A',
        );
        $this->observacion_model->insert($data);
        
        $data=array('estado' => 'O');
        $this->proyecto_model->update($id,$data);
	}
	
	public function listar_items($codigo_sisin)
	{	    
	    if(($this->session->userdata('rol')==4))
	    {
	        //$this->load->view('welcome_message');	        
	        $data['contenido_principal'] = 'seguimiento/listar_items_sin_publicar';	     
	        $data['proyecto_model']=$this->proyecto_model->getbuscar($codigo_sisin);
	        //config pagination
	        $config = $this->config_pagination->get_config();
	        $config["base_url"] = base_url() . "seguimiento/convocatoria/listar_items";
	        $config["total_rows"] = $this->detalle_proyecto_model->get_todos_para_publicar_contar($codigo_sisin);
	        $this->pagination->initialize($config);
	        $pageParam = $this->input->get('page');
	        $page = $pageParam ? $pageParam : 0;
	        $data["resultados"] = $this->detalle_proyecto_model->get_todos_para_publicar($config["per_page"], $page,$codigo_sisin);
	        $data["links"] = $this->pagination->create_links();
	         
	        $datosCapsula['data']=$data;
	        $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	
	public function nuevo($id_detalle_proyecto){
         $data = array(             
             'tipo_convocatoria'=>'Primera Convocatoria',
             'estado_convocatoria'=>'Publicado',
             'fecha_registro'=>date('Y-m-d H:i:s'),
             'fecha_publicacion'=>$this->input->post('fecha_publicacion'),
             'fecha_apertura'=>$this->input->post('fecha_apertura'),
             'fecha_contrato'=>$this->input->post('fecha_contrato'),
             'fecha_entrega'=>$this->input->post('fecha_entrega'),
             
             'id_detalle_proyecto'=>$id_detalle_proyecto,
             'estado'=>'A',               
            );
               
        $this->convocatoria_model->insert($data);
        
        $detalle = $this->detalle_proyecto_model->getbuscar($id_detalle_proyecto);
        $siguiente_estado = '';
        switch ($detalle->estado_publicacion) {
            case 'N':
                $siguiente_estado = 'P';
            break;
            case 'P':
                $siguiente_estado = 'S';
            break;
            case 'S':
                $siguiente_estado = 'I';
            break;
            case 'I':
                $siguiente_estado = 'C';
            break;            
        }
        
        $data = array(
            'estado_publicacion' => $siguiente_estado,
            'estado' => 'P',
        );
        
        $this->detalle_proyecto_model->update($id_detalle_proyecto,$data);
	}
	
	public function editar($id_empleado){
	    $data = array(	        	        
	        'fecha_publicacion'=>$this->input->post('fecha_publicacion'),
	        'fecha_apertura'=>$this->input->post('fecha_apertura'),
	        'fecha_contrato'=>$this->input->post('fecha_contrato'),
	        'fecha_entrega'=>$this->input->post('fecha_entrega'),	                            
	    );
	    
	    $this->convocatoria_model->update($id_empleado,$data);
	}
		
	public function registrar_estado($id)
	{
	    $estado = $this->input->post('estado');
	    $data = array(
	        'estado'=>$estado,
	    );
	   
	    $this->detalle_proyecto_model->update($id,$data);
	    
	    if ($estado == 'D') {
	        $detalle = $this->detalle_proyecto_model->getbuscar($id);
	        $data = array(
    	        'estado'=>'D',
    	    );
    	   
    	    $this->proyecto_model->update($detalle->codigo_sisin,$data);;
	    }
	    
// 	    $data = array(	        	        
// 	       'estado_convocatoria'=>$this->input->post('estado_convocatoria'),                            
// 	    );
	    
// 	    $this->convocatoria_model->update_por_detalle($id,$data);
	}
	
	
}
