<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
        $this->load->library('unit_test');
    }
    
	public function index()
	{
	    if(($this->session->userdata('rol')==1))
	    {
	        $data['buscar']=$this->input->get('buscar');
	        
    		$data['area_funcional_model']=$this->area_funcional_model->get_todos();
    		$data['unidad_funcional_model']=$this->unidad_funcional_model->get_todos();		
    		$data['usuario_model']=$this->usuario_model->get_todos();
    	    $data['contenido_principal'] = 'administracion/listar_empleados';    	        	        	  
    	  
            $config = $this->config_pagination->get_config();
            $config["base_url"] = base_url() . "administracion/empleado/index";       
            $config["total_rows"] = $this->empleado_model->get_todos_contar_buscar($data['buscar']);
            $this->pagination->initialize($config);     
            $pageParam = $this->input->get('page');     
            $page = $pageParam ? $pageParam : 0;
            $data["resultados"] = $this->empleado_model->get_todos_limite_buscar($config["per_page"], $page, $data['buscar']);            
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
                'nombres'=>$this->input->post('nombres'),
                'apellidos'=>$this->input->post('apellidos'),
                'ci'=>$this->input->post('ci'),
                'direccion'=>$this->input->post('direccion'),
                'telefonos'=>$this->input->post('telefonos'),
                'email'=>$this->input->post('email'),
                'cargo'=>$this->input->post('cargo'),
                'estado'=>'A',
                'id_unidad_funcional'=>$this->input->post('id_unidad_funcional'),                
            );
               
        $this->empleado_model->insert($data);
	}
	
	public function editar($id){
	    $data = array(	        
	         'nombres'=>$this->input->post('nombres'),
                'apellidos'=>$this->input->post('apellidos'),
                'ci'=>$this->input->post('ci'),
                'direccion'=>$this->input->post('direccion'),
                'telefonos'=>$this->input->post('telefonos'),
                'email'=>$this->input->post('email'),
                'cargo'=>$this->input->post('cargo'),
                'estado'=>$this->input->post('estado'),
                'id_unidad_funcional'=>$this->input->post('id_unidad_funcional1'),     
	    );
	    
	    $this->empleado_model->update($id,$data);
	}
    public function borrar($id){      
        
        $this->empleado_model->delete($id);
    }
	
    public function test_empleado(){    	 	
    	
    	//probamos crear un nuevo empleado
    	$_POST['nombres']='emp prueba';
    	$_POST['apellidos']='ape prueba';
    	$_POST['ci']='1111111 OR';
    	$_POST['direccion']='dir prueba';
    	$_POST['telefonos']='5211111';
    	$_POST['email']='email@prueba.com';
    	$_POST['cargo']='Cargo de Prueba';
    	$_POST['estado']='A';
    	$_POST['id_unidad_funcional']=11;
    	
    	$empleadosContadorAntes = $this->empleado_model->get_contar_todos();
    	
    	$this->nuevo();    	
    	
    	$empleadosContadorDespues = $this->empleado_model->get_contar_todos();
    	
    	$this->unit->run($empleadosContadorDespues, $empleadosContadorAntes+1, 'Cantidad Empleados en una inserción');
    	
    	$lastitem = $this->empleado_model->get_last_item();
    	
    	$this->unit->run($lastitem[0]->nombres, 'emp prueba', 'Nombre de Empleado en una inserción correcto');
    	//probamos editar un empleado
    	
    	$_POST['nombres']='emp1 prueba';
    	$_POST['apellidos']='ape prueba';
    	$_POST['ci']='1111111 OR';
    	$_POST['direccion']='dir prueba';
    	$_POST['telefonos']='5211111';
    	$_POST['email']='email@prueba.com';
    	$_POST['cargo']='Cargo de Prueba';
    	$_POST['estado']='A';
    	$_POST['id_unidad_funcional1']=11;
    	
    	$this->editar($lastitem[0]->id_empleado);
    	 
    	$empleado = $this->empleado_model->getbuscar($lastitem[0]->id_empleado);
    	 
    	$this->unit->run('emp1 prueba', $empleado->nombres, 'Nombre Empleado cambiado en una modificación');
    	
    	$this->unit->run('A', $empleado->estado, 'Estado Empleado antes de un borrado lógico');
    	
    	$this->borrar($empleado->id_empleado);
    	
    	$empleado = $this->empleado_model->getbuscar($lastitem[0]->id_empleado);
    	
    	$this->unit->run('I', $empleado->estado, 'Estado Empleado despues de un borrado lógico');
    	$this->load->view('test');
    	
    }
}
