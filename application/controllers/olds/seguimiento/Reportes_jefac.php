<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes_jefac extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index(){
        if(($this->session->userdata('rol')==3))
        {            
            $data['contenido_principal'] = 'seguimiento/reportes_jefac';
            $datosCapsula['data']=$data;
        
            $this->load->view('template/template_menu',$datosCapsula);
        
        }
        else{
            redirect('home/index','refresh');
        }
    }
    
    function reporte_empleados()
    {
        $empleados = $this->empleado_model->get_todos();
        
        
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
        
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        
        $pdf->SetFont('helvetica', '', 7);
        
        $nro = 1;
        
$texto='<table cellspacing="0" cellpadding="1" border="1">
	<tr>
<th align="center" width="30"><strong>Nro.</strong></th>
<th align="center" width="100"><strong>Apellidos</strong></th>
<th align="center" width="100"><strong>Nombres</strong></th>
<th align="center" width="50"><strong>CI</strong></th>
<th align="center" width="50"><strong>Telefono</strong></th>		
<th align="center" width="130"><strong>Email</strong></th>
<th align="center" width="110"><strong>Cargo</strong></th>
<th align="center" width="60"><strong>Unidad</strong></th>
	</tr>';
foreach ($empleados as $empleado){
	   $texto=$texto.'<tr>			
<td>'.$nro++.'</td>
<td>'.$empleado->apellidos.'</td>           
<td>'.$empleado->nombres.'</td>
<td>'.$empleado->ci.'</td>
<td>'.$empleado->telefonos.'</td>
<td>'.$empleado->email.'</td>
<td>'.$empleado->cargo.'</td>
<td>'.$empleado->usigla.'</td>
		</tr>';
	}
	$texto=$texto.'</table>';
        

        
        $html = <<<EOD
<h1>Lista de Empleados registrados</h1>
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
    
    function reporte_areas()
    {
        $areas = $this->area_funcional_model->get_todos(); 
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'usletter', true, 'UTF-8', false);
     
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('UTO');
        $pdf->SetTitle('Universidad Técnica de Oruro');
        $pdf->SetSubject('SisCat.UTO');
        $pdf->SetKeywords('uto');
    
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
		<th align="center" width="100"><strong>Código de Área</strong></th>
		<th align="center" width="150"><strong>Sigla</strong></th>
		<th align="center" width="350"><strong>Descripción</strong></th>
	</tr>';
        foreach ($areas as $area){
            $texto=$texto.'<tr>
	        <td>'.$nro++.'</td>
            <td>'.$area->codigo_area.'</td>
            <td>'.$area->sigla.'</td>
            <td>'.$area->descripcion.'</td>            
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Áreas Funcionales</h1>
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
    
    function reporte_unidades()
    {
        $unidades = $this->unidad_funcional_model->get_todos();
    
    
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'usletter', true, 'UTF-8', false);
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
<th align="center" width="70">Código de Área</th>
<th align="center" width="70">Área</th>		
<th align="center" width="70">Código de Unidad</th>
<th align="center" width="70">Sigla</th>
<th align="center" width="320">Descripción</th>
	</tr>';
        foreach ($unidades as $unidad){
            $texto=$texto.'<tr>
<td>'.$nro++.'</td>
<td>'.$unidad->codigo_area.'</td>
<td>'.$unidad->asigla.'</td>
<td>'.$unidad->codigo_unidad.'</td>
<td>'.$unidad->sigla.'</td>
<td>'.$unidad->descripcion.'</td>
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Unidades Funcionales</h1>
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
    
    function reporte_fuentes()
    {
        $fuentes = $this->fuente_organismo_model->get_todos();
    
    
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'usletter', true, 'UTF-8', false);
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
        <th align="center" width="70">Fuente</th>	
		<th align="center" width="230">Descripción Fuente</th>			
		<th align="center" width="70">Organismo</th>
		<th align="center" width="230">Descripción Organismo</th>	
	</tr>';
        foreach ($fuentes as $fuente){
            $texto=$texto.'<tr>
	        <td>'.$nro++.'</td>
            <td>'.$fuente->codigo_fuente.'</td>
            <td>'.$fuente->descripcion_fuente.'</td>
            <td>'.$fuente->codigo_organismo.'</td>
            <td>'.$fuente->descripcion_organismo.'</td>            
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Fuentes y Organismos registrados</h1>
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
    
    function reporte_proyectos()
    {
        $proyectos = $this->proyecto_model->get_todos_reporte();    
    
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
    
        $pdf->setPageOrientation('L');
        
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
    
        $pdf->SetFont('helvetica', '', 8);
    
        $nro = 1;
    
        $texto='<table cellspacing="0" cellpadding="1" border="1">
	<tr>
        <th align="center" width="30"><strong>Nro.</strong></th>
        <th align="center" width="90">Codigo SISIN</th>
		<th align="center" width="250">Descripcion</th>
        <th align="center" width="90">Codigo POA</th>
        <th align="center" width="110">Tipo de Proyecto</th>
		<th align="center" width="90">Unidad Funcional</th>
        <th align="center" width="150">Responsable Proyecto</th>
		<th align="center" width="70">Fecha Registro</th> 
        <th align="center" width="50">Estado</th>
	</tr>';
        foreach ($proyectos as $proyecto){
            $texto=$texto.'<tr>
	        <td>'.$nro++.'</td>
            <td>'.$proyecto->codigo_sisin.'</td>
            <td>'.$proyecto->descripcion.'</td>
            <td>'.$proyecto->codigo_poa.'</td>
            <td>'.$proyecto->tipo_proyecto.'</td>
            <td>'.$proyecto->usigla.'</td>
            <td>'.$proyecto->empleado_encargado.'</td>
            <td>'.$proyecto->fecha_registro.'</td>
            <td>'.$proyecto->estado.'</td>
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
}