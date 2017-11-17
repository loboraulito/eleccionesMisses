<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
	    if(($this->session->userdata('rol')==3))
	    {		
    		
    	    $data['contenido_principal'] = 'seguimiento/listar_empresa';
    	   
    	    //config pagination 
    	    $config = $this->config_pagination->get_config();
    	    $config["base_url"] = base_url() . "seguimiento/empresa/index";	    
    	    $config["total_rows"] = $this->empresa_model->get_contar_todos();
    	    $this->pagination->initialize($config);	    
    	    $pageParam = $this->input->get('page');	    
    	    $page = $pageParam ? $pageParam : 0;
    	    $data["resultados"] = $this->empresa_model->get_todos_limite($config["per_page"], $page);	        
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
                
                'nombre'=>$this->input->post('nombre'),
                'telefono'=>$this->input->post('telefono'),
                'direccion'=>$this->input->post('direccion'),
                'email'=>$this->input->post('email'),
                'responsable_juridico'=>$this->input->post('responsable_juridico'),
                'fecha_creacion'=>date('Y-m-d H:i:s'),
                'nit'=>$this->input->post('nit'),
                'estado'=>'A',               
            );
       
        
        $this->empresa_model->insert($data);
	}
	
	public function editar($id_empleado){
	    $data = array(	        
	         
                'nombre'=>$this->input->post('nombre'),
                'telefono'=>$this->input->post('telefono'),
                'direccion'=>$this->input->post('direccion'),
                'email'=>$this->input->post('email'),
                'responsable_juridico'=>$this->input->post('responsable_juridico'),                
                'nit'=>$this->input->post('nit'),      
	           'estado'=>$this->input->post('estado'),
	    );
	    
	    $this->empresa_model->update($id_empleado,$data);
	}
	
	public function borrar($id){
	
	    $this->empresa_model->delete($id);
	}
    public function validar_nombre_empresa(){
        $nombre = $this->input->get('nombre');
        $existe = $this->empresa_model->get_buscar_nombre($nombre);
         
        if($existe) {
            $this->output->set_status_header('404');
        }
        else $this->output->set_status_header('200');
    }
      public function validar_nit(){
        $nit = $this->input->get('nit');
        $existe = $this->empresa_model->get_buscar_nit($nit);
         
        if($existe) {
            $this->output->set_status_header('404');
        }
        else $this->output->set_status_header('200');
    }
}
