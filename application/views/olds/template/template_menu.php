<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template/header_menu');
$this->load->view('template/menu_menu',$data);
$datosCapsula['data']=$data;
$this->load->view('template/contenido_menu',$datosCapsula);
$this->load->view('template/footer');