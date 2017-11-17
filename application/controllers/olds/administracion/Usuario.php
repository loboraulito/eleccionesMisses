<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index($id_empleado)
	{
	    if(($this->session->userdata('rol')==1))
	    {		    		
	        
    		$data['resultados']=$this->usuario_model->getbuscar_todos($id_empleado);    		
    		$data['empleado_model']=$this->empleado_model->getbuscar($id_empleado);
    		
    		$data['contenido_principal'] = 'administracion/listar_usuarios';        	   
    	    $datosCapsula['data']=$data;

    	    $this->load->view('template/template_menu',$datosCapsula);    	     

	    }
	    else{
	        redirect('home/index','refresh');
	    }
	}
	public function nuevo(){
         $data = array(
                'cuenta'=>$this->input->post('cuenta'),
                'password'=>md5($this->input->post('password')),
                'rol'=>$this->input->post('rol'),
                'id_empleado'=>$this->input->post('id_empleado'),
                'estado'=>'A',               
            );
              
        $this->usuario_model->insert($data);
	}
	
	public function editar($id){		
	    $data = array(	        
	         'cuenta'=>$this->input->post('cuenta'),
             'password'=>md5($this->input->post('passworda')),
             'rol'=>$this->input->post('rol'),       
	    );
	    
	    $this->usuario_model->update($id,$data);
	}
	public function borrar($id){	
	    $this->usuario_model->delete($id);
	}
	 public function validar_cuenta(){
        $cod_cuenta = $this->input->get('cuenta');
        $existe = $this->usuario_model->get_buscar_cuenta($cod_cuenta);
         
        if($existe) {
            $this->output->set_status_header('404');
        }
        else $this->output->set_status_header('200');
    }
	
}
