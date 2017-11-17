<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
	    if(($this->session->userdata('rol')==2)) //operador presupuestos
	    {
		
	    $data['contenido_principal'] = 'seguimiento/index';
	    $datosCapsula['data']=$data;
	    $this->load->view('template/template_menu',$datosCapsula);
	    }
	    else{
	        if(($this->session->userdata('rol')==3)) //Jefe de contrataciones
    	    {        		
        	    $data['contenido_principal'] = 'seguimiento/jefe_contrataciones';
        	    $datosCapsula['data']=$data;
        	    $this->load->view('template/template_menu',$datosCapsula);
    	    }
    	    else{
        	    if(($this->session->userdata('rol')==4)) //operador de contrataciones
        	    {        		
            	    $data['contenido_principal'] = 'seguimiento/jefe_contrataciones';
            	              	   	    	    
            	    $datosCapsula['data']=$data;
            	    $this->load->view('template/template_menu',$datosCapsula);
        	    }
        	    else{
        	        redirect('home/index','refresh');
        	    }
    	    }
	    }
	}	
}
