<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/nombre_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
	    $data['contenido_principal'] = 'home';    
	    $data['error'] = 0;
	    $this->load->view('template/template2',$data);
	}
	public function login()
	{
		$data = array();
	    $nombre = $this->input->get('nombre');
	    $resultado = $this->jurado_model->get_por_nombre($nombre);
		
	    if(count($resultado)!=0)
	    {
	        $session = array(
	            'idjurado' => $resultado['idjurado'],
	            'nombre' => $resultado['nombre'],	            
	            'estado' => $resultado['estado'],	            
	        );
	        $this->session->set_userdata($session);
	    }else	    
	    {
	        $data['contenido_principal'] = 'home';    
    	    $data['error'] = 1;
    	    $this->load->view('template/template2',$data);
	    }
	    if(($this->session->idjurado))
	    {	       
	        redirect(base_url().'index.php/votacion/index','refresh');
	    }	    
	}
	public function logout()
	{
	    $data = array();
	    $this->session->sess_destroy();
	    redirect(base_url()."home",'refresh');	
	}
}
