<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_funcional extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
    }
    
	public function index()
	{
	    if(($this->session->userdata('rol')==1))
	    {		
    		$data['area_funcional_model']=$this->area_funcional_model->get_todos();
    		
    	    $data['contenido_principal'] = 'administracion/listar_area_funcional';
    	  
    	    //config pagination 
    	    $config = $this->config_pagination->get_config();
    	    $config["base_url"] = base_url() . "administracion/area_funcional/index";	    
    	    $config["total_rows"] = $this->area_funcional_model->get_contar_todos();
    	    $this->pagination->initialize($config);	    
    	    $pageParam = $this->input->get('page');	    
    	    $page = $pageParam ? $pageParam : 0;
    	    $data["resultados"] = $this->area_funcional_model->get_todos_limite($config["per_page"], $page);	        
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
                'codigo_area'=>$this->input->post('codigo_area'),
                'sigla'=>$this->input->post('sigla'),
                'descripcion'=>$this->input->post('descripcion'),
                'estado' => 'A',             
            );
        $this->area_funcional_model->insert($data);
	}
	
	public function editar($id){
	    $data = array(
            'codigo_area'=>$this->input->post('codigo_area'),
            'sigla'=>$this->input->post('sigla'),
            'descripcion'=>$this->input->post('descripcion'),
	        'estado'=>$this->input->post('estado'),
	    );
	    
	    $this->area_funcional_model->update($id,$data);
	}
	
	public function borrar($id){	
	    $this->area_funcional_model->delete($id);
	}
    public function validar_area(){
        $cod_area = $this->input->get('codigo_area');
        $existe = $this->area_funcional_model->get_buscar_codigo_area($cod_area);
         
        if($existe) {
            $this->output->set_status_header('404');
        }
        else $this->output->set_status_header('200');
    }
    
    public function test_area_funcional(){
         
        //probamos crear un nuevo empleado
        $_POST['codigo_area']='Z';
        $_POST['sigla']='area prueba';
        $_POST['descripcion']='descripcion';
        $_POST['estado']='A';
         
        $areaContadorAntes = $this->area_funcional_model->get_contar_todos();
         
        $this->nuevo();
         
        $empleadosContadorDespues = $this->area_funcional_model->get_contar_todos();
         
        $this->unit->run($empleadosContadorDespues, $areaContadorAntes+1, 'Cantidad Areas en una inserción');
         
        $lastitem = $this->area_funcional_model->get_last_item();
         
        $this->unit->run($lastitem[0]->codigo_area, 'Z', 'Codigo de Area en una inserción correcto');
        //probamos editar un empleado
         
        $_POST['codigo_area']='Y';
        $_POST['sigla']='area prueba';
        $_POST['descripcion']='descripcion';
        $_POST['estado']='A';
         
        $this->editar($lastitem[0]->id_area_funcional);
    
        $area = $this->area_funcional_model->getbuscar($lastitem[0]->id_area_funcional);
    
        $this->unit->run('Y', $area->codigo_area, 'Nombre Empleado cambiado en una modificación');
         
        $this->unit->run('A', $area->estado, 'Estado Empleado antes de un borrado lógico');
         
        $this->borrar($area->id_area_funcional);
         
        $area = $this->area_funcional_model->getbuscar($lastitem[0]->id_area_funcional);
         
        $this->unit->run('I', $area->estado, 'Estado Empleado despues de un borrado lógico');
        
        $_GET['codigo_area']='X';        
        $existe = $this->area_funcional_model->get_buscar_codigo_area('X');
        $this->unit->run(false, $existe, 'Codigo Area disponible');
        
        $_GET['codigo_area']='Z';
        $existe = $this->area_funcional_model->get_buscar_codigo_area('Z');
        $this->unit->run(false, $existe, 'Codigo Area No disponible');
        
        $this->load->view('test');
         
    }
}
