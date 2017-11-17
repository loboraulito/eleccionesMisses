<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template/header3',$data);
$this->load->view($contenido_principal,$data);
$this->load->view('template/footer3');