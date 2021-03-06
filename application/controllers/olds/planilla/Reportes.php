<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index(){
        if(($this->session->userdata('rol')==5))
        {            
            $data['contenido_principal'] = 'planilla/reportes';
            $datosCapsula['data']=$data;
        
            $this->load->view('template/template_menu',$datosCapsula);
        
        }
        else{
            redirect('home/index','refresh');
        }
    }
    
    function proyectos()
    {
        $proyectos = $this->proyecto_model->get_todos_limite_aprobar_dpdi2();
    
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'usletter', true, 'UTF-8', false);
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
    
            
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
    
        $pdf->SetFont('helvetica', '', 8);
    
        $nro = 1;
    
        $texto='<table cellspacing="0" cellpadding="1" border="1">
	<tr>
        <th align="center" width="30"><strong>Nro.</strong></th>
        <th align="center" width="150">Codigo SISIN</th>
		<th align="center" width="250">Descripcion</th>
        <th align="center" width="90">Unidad Funcional</th>
        <th align="center" width="110">Fecha de Registro</th>		
	</tr>';
        foreach ($proyectos as $proyecto){
            $texto=$texto.'<tr>
	        <td>'.$nro++.'</td>
            <td>'.$proyecto->codigo_sisin.'</td>
            <td>'.$proyecto->descripcion.'</td>
            <td>'.$proyecto->usigla.'</td>
            <td>'.$proyecto->fecha_registro.'</td>
            
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Proyectos registrados</h1>
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
    
    function pagos_solicitados()
    {
        $id_empleado_encargado = $this->session->userdata('id_empleado');
        $proyectos = $this->planilla_model->get_todos_para_pago_dpdi($id_empleado_encargado);
    
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'usletter', true, 'UTF-8', false);
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
    
    
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
    
        $pdf->SetFont('helvetica', '', 8);
    
        $nro = 1;
    
    $texto = '';
    
        foreach ($proyectos as $proyecto){
            $texto=$texto.'<hr><br/><br/><table cellspacing="0" cellpadding="1" border="1">
            	<tr style="background-color:yellow;">
                    <th align="center" width="30"><strong>Nro.</strong></th>
                    <th align="center" width="90">Codigo SISIN</th>
                        
            		<th align="center" width="300">Descripcion</th>
    
                    <th align="center" width="200">Monto Total</th>
    
            	</tr>';
            $texto=$texto.'<tr>
        	        <td>'.$nro++.'</td>
                    <td>'.$proyecto->codigo_sisin.'</td>
                    
                    <td>'.$proyecto->descripcion.'</td>
    
                    <td>'.$proyecto->monto_total.'</td>
        		</tr>';
            $texto=$texto.'</table><br/>';
    
            $items = $this->planilla_model->get_todos_para_pago_dpdi_detalle($proyecto->codigo_sisin);
            $texto=$texto.'<table cellspacing="0" cellpadding="1" border="1">
            	<tr>
                    <th align="center" width="300"><strong>Observacion</strong></th>
                    <th align="center" width="90">Monto</th>
                        
            		<th align="center" width="150">Fecha Envio</th>                      
            	</tr>';
            foreach ($items as $item){
    
                $texto=$texto.'<tr>
        	        <td>'.$item->observacion_envio.'</td>
                    <td>'.$item->monto.'</td>                    
                    <td>'.$item->fecha_envio.'</td> 
        		</tr>';
    
            }
            $texto=$texto.'</table><br>';
    
    
            $texto.'<br>';
        }
    
    
    
        $html = <<<EOD
<h1>Lista de Pagos solicitados</h1>
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