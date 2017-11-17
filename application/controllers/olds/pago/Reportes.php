<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index(){
        if(($this->session->userdata('rol')==6))
        {            
            $data['contenido_principal'] = 'pago/reportes';
            $datosCapsula['data']=$data;
        
            $this->load->view('template/template_menu',$datosCapsula);
        
        }
        else{
            redirect('home/index','refresh');
        }
    }
    
    function proyectos_pagados()
    {
        $pagos = $this->pago_model->get_datos_pagados();
        
        
        $this->load->library('Pdf');
        $pdf = new Pdf('I', 'mm', 'usletter', true, 'UTF-8', false); // 'I'' es para ;a pagina horizontal 'P' vertical
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('UTO');
        $pdf->SetTitle('Universidad Técnica de Oruro');
        $pdf->SetSubject('SisCat.UTO');
        $pdf->SetKeywords('uto');
        
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Universidad Técnica de Oruro', 'SisCat.UTO', array(
            0,
            0,
            0
        ), array(
            0,
            64,
            128
        ));
        $pdf->setFooterData(array(
            0,
            64,
            0
        ), array(
            0,
            64,
            128
        ));
        
        // set header and footer fonts
        $pdf->setHeaderFont(Array(
            PDF_FONT_NAME_MAIN,
            '',
            PDF_FONT_SIZE_MAIN
        ));
        $pdf->setFooterFont(Array(
            PDF_FONT_NAME_DATA,
            '',
            PDF_FONT_SIZE_DATA
        ));
        
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once (dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        
        // ---------------------------------------------------------
        
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        // $pdf->SetFont('dejavusans', '', 14, '', true);
        
        $pdf->setPageOrientation('L');
        
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        
        $pdf->SetFont('helvetica', '', 7);
        
        $nro = 1;
        
$texto='<table cellspacing="0" cellpadding="1" border="1">
	<tr>
        <th align="center" width="30"><strong>Nro.</strong></th>
        <th align="center" width="90">Codigo SISIN</th>
		<th align="center" width="90">Apertura Prog.</th>
        <th align="center" width="250">Descripcion Proyecto</th>
        <th align="center" width="110">Fecha Envio</th>
		<th align="center" width="90">Monto Adjudicado o Solicitado</th>
        <th align="center" width="90">Monto Pagado</th>
		<th align="center" width="50">Fuente</th> 
        <th align="center" width="80">Observacion</th> 
        <th align="center" width="50">Fecha Pago</th>
	</tr>';
        foreach ($pagos as $pago){
            $texto=$texto.'<tr>
	        <td>'.$nro++.'</td>
            <td>'.$pago->codigo_sisin.$pago->codigo_sisin1.'</td>
            <td>'.$pago->apertura_programatica.$pago->apertura_programatica1.'</td>
            <td>'.$pago->descripcion_proyecto.$pago->descripcion_proyecto1.'</td>
            <td>'.$pago->fecha_envio.'</td>
            <td>'.$pago->monto.'</td>
            <td>'.$pago->monto_cancelado.'</td>
            <td>'.$pago->sigla.'</td>
            <td>'.$pago->pago_observacion.'</td>
                <td>'.$pago->fecha_pago.'</td>
		</tr>';
        }
        $texto=$texto.'</table>';
    
        
        $html = <<<EOD
<h1>Lista de Proyectos Pagados</h1>
$texto
EOD;
        
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        // ---------------------------------------------------------
        
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        ob_end_clean();
        $pdf->Output('pdfexample.pdf', 'I');
    }
    
    function proyectos_por_pagar()
    {
        $pagos = $this->pago_model->get_datos_por_pagar();
    
    
        $this->load->library('Pdf');
        $pdf = new Pdf('I', 'mm', 'usletter', true, 'UTF-8', false); // 'I'' es para ;a pagina horizontal 'P' vertical
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('UTO');
        $pdf->SetTitle('Universidad Técnica de Oruro');
        $pdf->SetSubject('SisCat.UTO');
        $pdf->SetKeywords('uto');
    
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Universidad Técnica de Oruro', 'SisCat.UTO', array(
            0,
            0,
            0
        ), array(
            0,
            64,
            128
        ));
        $pdf->setFooterData(array(
            0,
            64,
            0
        ), array(
            0,
            64,
            128
        ));
    
        // set header and footer fonts
        $pdf->setHeaderFont(Array(
            PDF_FONT_NAME_MAIN,
            '',
            PDF_FONT_SIZE_MAIN
        ));
        $pdf->setFooterFont(Array(
            PDF_FONT_NAME_DATA,
            '',
            PDF_FONT_SIZE_DATA
        ));
    
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once (dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
    
        // ---------------------------------------------------------
    
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
    
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        // $pdf->SetFont('dejavusans', '', 14, '', true);
    
        //$pdf->setPageOrientation('L');
    
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
    
        $pdf->SetFont('helvetica', '', 7);
    
        $nro = 1;
    
        $texto='<table cellspacing="0" cellpadding="1" border="1">
	<tr>
        <th align="center" width="30"><strong>Nro.</strong></th>
        <th align="center" width="90">Codigo SISIN</th>
		<th align="center" width="80">Apertura Prog.</th>
        <th align="center" width="250">Descripcion Proyecto</th>
        <th align="center" width="70">Fecha Envio</th>
		<th align="center" width="90">Monto Adjudicado o Solicitado</th>
        
	</tr>';
        foreach ($pagos as $pago){
            $texto=$texto.'<tr>
	        <td>'.$nro++.'</td>
            <td>'.$pago->codigo_sisin.$pago->codigo_sisin1.'</td>
            <td>'.$pago->apertura_programatica.$pago->apertura_programatica1.'</td>
            <td>'.$pago->descripcion_proyecto.$pago->descripcion_proyecto1.'</td>
            <td>'.$pago->fecha_envio.'</td>
            <td>'.$pago->monto.'</td>            
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
        $html = <<<EOD
<h1>Lista de Proyectos por Pagar</h1>
$texto
EOD;
    
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    
        // ---------------------------------------------------------
    
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        ob_end_clean();
        $pdf->Output('pdfexample.pdf', 'I');
    }
}