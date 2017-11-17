<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rector extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();  
    }
    
	public function index()
	{
        if (($this->session->userdata('rol') == 8)) // operador presupuestos
        {
            $data['contenido_principal'] = 'reporte/listar_proyectos';
            $data['proyectos']=$this->proyecto_model->get_todos();
            $datosCapsula['data'] = $data;
            $this->load->view('template/template_menu', $datosCapsula);
        } else {
            redirect('home/index', 'refresh');
        }
	}
	public function detalles($codigo_sisin)
	{
	    if (($this->session->userdata('rol') == 7)) // operador presupuestos
	    {
	        $id_empleado_tecnico = $this->session->userdata('id_usuario');
	        $data['contenido_principal'] = 'reporte/listar_detalles';
	        $data['proyecto_model']=$this->proyecto_model->getbuscar($codigo_sisin);
	        $data['resultados']=$this->proyecto_model->get_todos_reporte_tecnico_detalle($id_empleado_tecnico,$codigo_sisin);
	        $datosCapsula['data'] = $data;
	        $this->load->view('template/template_menu', $datosCapsula);
	    } else {
	        redirect('home/index', 'refresh');
	    }
	}
}
