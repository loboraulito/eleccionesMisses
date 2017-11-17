<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyecto extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
	    if(($this->session->userdata('rol')==2))
	    {
		$data['datos']=$this->proyecto_model->get_todos();		
	    $data['contenido_principal'] = 'seguimiento/listar_proyectos';
	    
	    //config pagination 
	    $config = $this->config_pagination->get_config();
	    $config["base_url"] = base_url() . "seguimiento/proyecto/index";	    
	    $config["total_rows"] = $this->proyecto_model->get_contar_todos_aprobar();
	    $this->pagination->initialize($config);	    
	    $pageParam = $this->input->get('page');	    
	    $page = $pageParam ? $pageParam : 0;
	    $data["resultados"] = $this->proyecto_model->get_todos_limite_aprobar($config["per_page"], $page);	        
	    $data["links"] = $this->pagination->create_links();
	    	    
	    $datosCapsula['data']=$data;
	    $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	
	public function aprobar($codigo_sisin){	    
	    $observaciones = $this->observacion_model->contarObservacionesActivas($codigo_sisin);	
	    
	    $detalles = $this->detalle_proyecto_model->get_contar_detalles($codigo_sisin);
	    
	    if($observaciones == 0 && $detalles > 0) {	        
    	    $data = array(                
                'estado' => 'P',
    	        'fecha_aprobado' => date('Y-m-d H:i:s'),    	        
    	    );	    
    	    $this->proyecto_model->update($codigo_sisin,$data);
    	    
    	    $data = array(
    	        'codigo_sisin' => $codigo_sisin,
    	        'estado' => 'P',
    	        'fecha_aprobacion' => date('Y-m-d H:i:s'),
    	        'id_empleado' => $this->session->userdata('id_empleado')
    	    );
    	    $this->historial_aprobaciones_model->insert($data);
    	    
    	    $resultado = 0;
	    }else $resultado = 1;
	    echo $resultado;	    
	}
	
	public function nuevo(){
         $data = array(
                'id_observacion'=>$this->input->post('id_observacion'),
                'observacion'=>$this->input->post('observacion'),
                'fecha'=>$this->input->post('fecha'),
                'codigo_sisin'=>$this->input->post('codigo_sisin'),
                'estado'=>$this->input->post('estado'),
                'id_empleado'=>$this->input->post('id_empleado'),
                'estado' => 'A',
                
            );        
        $this->proyecto_model->insert($data);
	}
	
	public function editar(){
	    $data = array(
	        'id_observacion'=>$this->input->post('id_observacion'),
            'observacion'=>$this->input->post('observacion'),
            'fecha'=>$this->input->post('fecha'),
            'codigo_sisin'=>$this->input->post('codigo_sisin'),
            'estado'=>$this->input->post('estado'),
            'id_empleado'=>$this->input->post('id_empleado'),
            'estado' => 'A',
	    );	    
	    $this->proyecto_model->update($this->input->post('codigo_sisin'),$data);
	}
	
	public function listar_asignar(){
	    if(($this->session->userdata('rol')==3))
	    {
	        //$this->load->view('welcome_message');
	        
	        $data['contenido_principal'] = 'seguimiento/listar_proyectos_aprobados';	       
	        $data['empleado_model']=$this->empleado_model->get_todos_operador_contrataciones();
	        //config pagination
	        $config = $this->config_pagination->get_config();
	        $config["base_url"] = base_url() . "seguimiento/proyecto/index";
	        $config["total_rows"] = $this->proyecto_model->get_todos_para_asignar_contar();
	        $this->pagination->initialize($config);
	        $pageParam = $this->input->get('page');
	        $page = $pageParam ? $pageParam : 0;
	        $data["resultados"] = $this->proyecto_model->get_todos_para_asignar($config["per_page"], $page, array('estado'=>'P'));
	        $data["links"] = $this->pagination->create_links();
	    
	        $datosCapsula['data']=$data;
	        $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	
	public function asignar($codigosisin){
	    $data = array(
	        'codigo_contrataciones'=>$this->input->post('codigo_contrataciones'),
	        'id_empleado_encargado'=>$this->input->post('id_empleado_encargado'),	
	        'fecha_registro_contrataciones'=>date('Y-m-d H:i:s'),
	    );
	    $this->proyecto_model->update($codigosisin,$data);
	}
}
