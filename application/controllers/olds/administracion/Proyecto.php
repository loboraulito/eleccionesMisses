<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyecto extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
	    if(($this->session->userdata('rol')==1))
	    {
	    	$data['buscar']=$this->input->get('buscar');
	
			$data['datos']=$this->proyecto_model->get_todos();		
			$data['unidad_funcional_model']=$this->unidad_funcional_model->get_todos();
			$data['fuente_organismo_model']=$this->fuente_organismo_model->get_todos();
			$data['usuario_model']=$this->usuario_model->get_todos_usuarios();
			$data['empleado_model']=$this->empleado_model->get_todos_usuarios();
		    $data['contenido_principal'] = 'administracion/listar_proyectos';
		   
		    //config pagination 
		    $config = $this->config_pagination->get_config();
		    $config["base_url"] = base_url() . "administracion/proyecto/index";	    
		    $config["total_rows"] = $this->proyecto_model->get_contar_todos_buscar($data['buscar']);	    
		    
		    $this->pagination->initialize($config);	    
		    $pageParam = $this->input->get('page');	    
		    $page = $pageParam ? $pageParam : 0;
		    $data["results"] = $this->proyecto_model->get_todos_limite_buscar($config["per_page"], $page, $data['buscar']);	        
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
                'codigo_sisin' => $this->input->post('codigo_sisin'),                
                'id_unidad_funcional' => $this->input->post('id_unidad_funcional'),                
                'codigo_poa' => $this->input->post('codigo_poa'),
                'apertura_programatica' => $this->input->post('apertura_programatica'),
                'descripcion' => $this->input->post('descripcion'),
                'monto_total' => $this->input->post('monto_total'),
                'tipo_proyecto' => $this->input->post('tipo_proyecto'),                
                'fecha_registro' => date('Y-m-d H:i:s'),                
                'id_empleado_tecnico' => $this->input->post('id_empleado_tecnico'),
                'id_empleado_encargado' => $this->session->userdata('id_usuario'),
                'estado' => 'A',
                
            );
        
        $this->proyecto_model->insert($data);
	}
	
	public function editar($id){
	    $data = array(
	        'id_unidad_funcional' => $this->input->post('id_unidad_funcional'),                
                'codigo_poa' => $this->input->post('codigo_poa'),
                'apertura_programatica' => $this->input->post('apertura_programatica'),
                'descripcion' => $this->input->post('descripcion'),
                'monto_total' => $this->input->post('monto_total'),
                'tipo_proyecto' => $this->input->post('tipo_proyecto'),
                'id_empleado_tecnico' => $this->input->post('id_empleado_tecnico'),
	            'estado' => $this->input->post('estado'),
	    );
	 
	    $this->proyecto_model->update($id,$data);
	}	
	
	public function validar_codigo_sisin(){
	    $cod_org = $this->input->get('codigo_sisin');
	    $existe = $this->proyecto_model->get_buscar_codigo_sisin($cod_org);
	     
	    if($existe) {
	        $this->output->set_status_header('404');
	    }
	    else $this->output->set_status_header('200');
	}
}
