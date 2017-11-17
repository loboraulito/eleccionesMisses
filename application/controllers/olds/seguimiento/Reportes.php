<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes extends CI_Controller
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
    
    function proyectos_registrados()
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
		<th align="center" width="360">Descripcion</th>
        <th align="center" width="90">Monto Total</th>		
        <th align="center" width="200">Responsable Proyecto</th>
        <th align="center" width="90">Unidad Funcional</th>
		<th align="center" width="70">Fecha Registro</th>
	</tr>';
        foreach ($proyectos as $proyecto){
            $texto=$texto.'<tr>
	        <td align="center">'.$nro++.'</td>
            <td align="center">'.$proyecto->codigo_sisin.'</td>
            <td align="left">'.$proyecto->descripcion.'</td>
            <td align="center">'.number_format($proyecto->monto_total, 2, ',', '.').'</td>
            <td align="center">'.$proyecto->empleado_encargado.'</td>
            <td align="left">'.$proyecto->usigla.'</td>
            <td align="center">'.$proyecto->fecha_registro.'</td>
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Proyectos Registrados</h1>
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
    
    function proyectos_observados()
    {
        $proyectos = $this->proyecto_model->get_todos_reporteobservados();
    
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
    
        $pdf->setPageOrientation('L');
    
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
    
        $pdf->SetFont('helvetica', '', 8);
    
        $nro = 1;
    
        $texto='<table cellspacing="0" cellpadding="1">';
        foreach ($proyectos as $proyecto){
            $texto=$texto.'<tr>
    	        <td width="70"><strong>Codigo SISIN:</strong></td>
                <td width="150">'.$proyecto->codigo_sisin.'</td>
                <td width="70"><strong>Descripción:</strong></td>
                <td width="600">'.$proyecto->descripcion.'</td>
    		</tr><br>';
            
            $observaciones = $this->observacion_model->get_todos_limiteProy($proyecto->codigo_sisin);
            if($observaciones){
                $texto=$texto.'<table cellspacing="0" cellpadding="1" border="1">
            	<tr>
                    <th align="center" width="300"><strong>Observación</strong></th>
                    <th align="center" width="110"><strong>Fecha Registro</strong></th>
            		<th align="center" width="200"><strong>Empleado que Observa</strong></th>
                    <th align="center" width="110"><strong>Fecha Modificación</strong></th>		
                    <th align="center" width="200"><strong>Empleado que Modifica</strong></th>                
            	</tr>';
                    foreach ($observaciones as $observacion){
                            $texto=$texto.'<tr>
                            <td>'.$observacion->observacion.'</td>
                            <td>'.$observacion->fecha.'</td>
                            <td>'.$observacion->nombre_completo.'</td>
                            <td>'.$observacion->fecha_ult.'</td>
                            <td>'.$observacion->nombre_completo_ult.'</td>
                		</tr>';
                    }
                $texto=$texto.'</table><br><br><br>';
            }else{
                $texto=$texto.'<strong>Sin Observación</strong><br><br><br>';
            }
            $texto=$texto.'<hr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Observaciones por Proyecto</h1>
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
    
    function proyectos_aprobados()
    {
        $proyectos = $this->proyecto_model->get_todos_aprobados1();
    
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
		<th align="center" width="390">Descripcion</th>
        <th align="center" width="90">Monto Total</th>        		
        <th align="center" width="120">Fecha Ultima Aprobación</th>
        <th align="center" width="160">Resp. Aprobacion</th>
	</tr>';
        foreach ($proyectos as $proyecto){
            $texto=$texto.'<tr cellpadding="1">
	        <td align="center">'.$nro++.'</td>
            <td>'.$proyecto->codigo_sisin.'</td>
            <td>'.$proyecto->descripcion.'</td>
            <td align="center">'.number_format($proyecto->monto_total, 2, ',', '.').'</td>              
            <td align="center">'.$proyecto->fecha_aprobado.'</td>
              <td >'.$proyecto->tecnico_asignado.'</td>
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Proyectos Aprobados</h1>
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
    
    
    function proyectos_condetalles()
    {
        $proyectos = $this->proyecto_model->get_todos_where(array('estado'=>'P'));
    
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
        
        foreach ($proyectos as $proyecto){
       
            $texto='<table cellspacing="0" cellpadding="1">
                <tr>
                    <th align="center" width="30"><strong>Nro.</strong></th>
                    <th align="center" width="90">Codigo SISIN</th>
            		<th align="center" width="350">Descripcion</th>
                    <th align="center" width="150">Monto Total</th>
            		<th align="center" width="120">Fecha Registro</th>
                    <th align="center" width="120">Fecha Ultima Aprobación</th>
            	</tr>
                <tr>
                    <td>'.$nro++.'</td>
                    <td>'.$proyecto->codigo_sisin.'</td>                
                    <td>'.$proyecto->descripcion.'</td>
                    <td>'.$proyecto->monto_total.'</td>
                    <td>'.$proyecto->fecha_registro.'</td>
                    <td>'.$proyecto->fecha_aprobado.'</td>
                </tr><br>';
            foreach ($proyectos as $proyecto){
                
                $detalles = $this->detalle_proyecto_model->get_todos_por_proyecto($proyecto->codigo_sisin);
                if($detalles){
                    $texto=$texto.'<table cellspacing="0" cellpadding="1" border="1">
                	<tr>
                        <th align="center" width="300"><strong>Item</strong></th>
                        <th align="center" width="110"><strong>Descripcion</strong></th>
                		<th align="center" width="200"><strong>Unidad</strong></th>
                        <th align="center" width="110"><strong>Cantidad</strong></th>
                        <th align="center" width="100"><strong>Precio Unitario</strong></th>
                        <th align="center" width="100"><strong>Total</strong></th>
                	</tr>';
                    foreach ($detalles as $detalle){
                        $total = $detalle->cantidad * $detalle->precio_unidad;
                        $texto=$texto.'<tr>
                                <td>'.$detalle->item.'</td>
                                <td>'.$detalle->descripcion.'</td>
                                <td>'.$detalle->unidad.'</td>
                                <td>'.$detalle->cantidad.'</td>
                                <td>'.$detalle->precio_unidad.'</td>
                                <td>'.$total.'</td>
                    		</tr>';
                    }
                    $texto=$texto.'</table><br><br><br>';
                }else{
                    $texto=$texto.'<strong>Sin Observación</strong><br><br><br>';
                }
                $texto=$texto.'<hr>';
            }
            $texto=$texto.'</table>';
        }
    
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
    
    function reporte_aprobados()
    {
        $proyectos = $this->proyecto_model->get_todos_aprobadosreport();
    
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
		<th align="center" width="300">Descripcion</th>
        <th align="center" width="90">Fecha Ultima Aprobación</th>
        <th align="center" width="150">Codigo Contrataciones</th>
        <th align="center" width="220">Responsable Proyecto</th>
        <th align="center" width="90">Fecha Asignacion</th>        
	</tr>';
        foreach ($proyectos as $proyecto){
            $texto=$texto.'<tr cellpadding="1">
	        <td>'.$nro++.'</td>
            <td>'.$proyecto->codigo_sisin.'</td>
            <td>'.$proyecto->descripcion.'</td>
            <td>'.$proyecto->fecha_aprobado.'</td>
            <td>'.$proyecto->codigo_contrataciones.'</td>
            <td>'.$proyecto->tecnico_asignado.'</td>
            <td>'.$proyecto->fecha_registro_contrataciones.'</td>
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Proyectos Aprobados</h1>
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
    
    function reporte_empresas()
    {
        $empresas = $this->empresa_model->get_todos();
    
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
        <th align="center" width="260">Nombre</th>
		<th align="center" width="70">Telefono</th>
        <th align="center" width="150">Direccion</th>
        <th align="center" width="150">Email</th>
        <th align="center" width="90">NIT</th>
		<th align="center" width="150">Responsable Juridico</th>
	</tr>';
        foreach ($empresas as $empresa){
            $texto=$texto.'<tr>
	        <td>'.$nro++.'</td>
            <td>'.$empresa->nombre.'</td>
            <td>'.$empresa->telefono.'</td>
            <td>'.$empresa->direccion.'</td>
            <td>'.$empresa->email.'</td>
            <td>'.$empresa->nit.'</td>
            <td>'.$empresa->responsable_juridico.'</td>
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Empresas registradas</h1>
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
    
    function reporte_detalle()
    {
        $proyectos = $this->proyecto_model->get_todos_aprobados2();
    
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
        <th align="center" width="100">Codigo Contrataciones</th>
        <th align="center" width="90">Codigo SISIN</th>
		<th align="center" width="350">Descripcion del Proyecto</th>
        <th align="center" width="90">Monto</th>        
        <th align="center" width="150">Responsable de Contratacion</th>
        <th align="center" width="120">Fecha Asignacion</th>
	</tr>';
        foreach ($proyectos as $proyecto){
            $texto=$texto.'<tr cellpadding="1">
	        <td>'.$nro++.'</td>
            <td align="center">'.$proyecto->codigo_contrataciones.'</td>
            <td>'.$proyecto->codigo_sisin.'</td>
            <td>'.$proyecto->descripcion.'</td>
            <td  align="center">'.number_format($proyecto->monto_total, 2, ',', '.').'</td>            
            <td align="center">'.$proyecto->tecnico_asignado.'</td>
            <td align="center">'.$proyecto->fecha_registro_contrataciones.'</td>
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Proyectos Asignados</h1>
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