<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
        if (($this->session->userdata('rol') == 5)) // operador presupuestos
        {
            
            $data['contenido_principal'] = 'planilla/index';
            $datosCapsula['data'] = $data;
            $this->load->view('template/template_menu', $datosCapsula);
        } else {
            redirect('home/index', 'refresh');
        }
	}	
}
