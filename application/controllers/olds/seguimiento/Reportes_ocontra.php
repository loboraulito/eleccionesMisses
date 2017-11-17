<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes_ocontra extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index(){
        if(($this->session->userdata('rol')==4))
        {            
            $data['contenido_principal'] = 'seguimiento/reportes_ocontra';
            $datosCapsula['data']=$data;
        
            $this->load->view('template/template_menu',$datosCapsula);
        
        }
        else{
            redirect('home/index','refresh');
        }
    }
    
    function proyectos_para_publicar()
    {
        $id_empleado_encargado = $this->session->userdata('id_empleado');
                       
        $proyectos = $this->proyecto_model->get_todos_para_publicar($id_empleado_encargado);
    
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
            <th align="center" width="90">Codigo Contrataciones</th>
		<th align="center" width="300">Descripcion</th>
        <th align="center" width="70">Fecha Asignacion</th>		
        <th align="center" width="200">Estado</th>
        
	</tr>';
        foreach ($proyectos as $proyecto){
            $texto=$texto.'<tr>
	        <td>'.$nro++.'</td>
            <td>'.$proyecto->codigo_sisin.'</td>
            <td>'.$proyecto->codigo_contrataciones.'</td>
            <td>'.$proyecto->descripcion.'</td>
            <td>'.$proyecto->fecha_registro_contrataciones.'</td>
            <td>'.($proyecto->estado=='P'?"Aprobado":"Sin Aprobar").'</td>
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Proyectos recibidos para publicar</h1>
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
    
    function items_sin_publicar()
    {
        $id_empleado_encargado = $this->session->userdata('id_empleado');
         
        $proyectos = $this->proyecto_model->get_todos_proyectos_sin_publicar($id_empleado_encargado);
    
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
    
        $texto = '';
        
        foreach ($proyectos as $proyecto){
            $texto=$texto.'<hr><br/><br/><table cellspacing="0" cellpadding="1" border="1">
            	<tr style="background-color:yellow;">
                    <th align="center" width="30"><strong>Nro.</strong></th>
                    <th align="center" width="90">Codigo SISIN</th>
                        <th align="center" width="90">Codigo Contrataciones</th>
            		<th align="center" width="300">Descripcion</th>
                    
                    <th align="center" width="200">Monto Total</th>
                        
            	</tr>';
                $texto=$texto.'<tr>
        	        <td>'.$nro++.'</td>
                    <td>'.$proyecto->codigo_sisin.'</td>
                    <td>'.$proyecto->codigo_contrataciones.'</td>
                    <td>'.$proyecto->descripcion.'</td>
                    
                    <td>'.$proyecto->monto_total.'</td>
        		</tr>';
            $texto=$texto.'</table><br/>';
            
            $items = $this->proyecto_model->get_todos_items_sin_publicar($proyecto->codigo_sisin);
            $texto=$texto.'<table cellspacing="0" cellpadding="1" border="1">
            	<tr>
                    <th align="center" width="30"><strong>Items</strong></th>
                    <th align="center" width="90">descripcion</th>
                        <th align="center" width="90">Cantidad</th>
            		<th align="center" width="100">Unidad</th>
                    <th align="center" width="300">Precio Unitario</th>
                    <th align="center" width="200">Monto Total</th>
            
            	</tr>';
            foreach ($items as $item){
                
                $texto=$texto.'<tr>
        	        <td>'.$item->item.'</td>
                    <td>'.$item->descripcion.'</td>
                    <td>'.$item->cantidad.'</td>
                    <td>'.$item->unidad.'</td>
                    <td>'.$item->precio_unidad.'</td>
                    <td>'.($item->precio_unidad*$item->cantidad).'</td>
        		</tr>';
                
            }
            $texto=$texto.'</table><br>';
            
                
            $texto.'<br>';
        }
        
    
    
    
        $html = <<<EOD
<h1>Lista de Proyectos recibidos para publicar</h1>
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
    
    function items_publicados()
    {
        $id_empleado_encargado = $this->session->userdata('id_empleado');
         
        $proyectos = $this->proyecto_model->get_todos_proyectos_publicados($id_empleado_encargado);
    
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
    
        $texto = '';
    
        foreach ($proyectos as $proyecto){
            $texto=$texto.'<hr><br/><br/><table cellspacing="0" cellpadding="1" border="1">
            	<tr style="background-color:yellow;">
                    <th align="center" width="30"><strong>Nro.</strong></th>
                    <th align="center" width="90">Codigo SISIN</th>
                        <th align="center" width="90">Codigo Contrataciones</th>
            		<th align="center" width="300">Descripcion</th>
    
                    <th align="center" width="200">Monto Total</th>
    
            	</tr>';
            $texto=$texto.'<tr>
        	        <td>'.$nro++.'</td>
                    <td>'.$proyecto->codigo_sisin.'</td>
                    <td>'.$proyecto->codigo_contrataciones.'</td>
                    <td>'.$proyecto->descripcion.'</td>
    
                    <td>'.$proyecto->monto_total.'</td>
        		</tr>';
            $texto=$texto.'</table><br/>';
    
            $items = $this->proyecto_model->get_todos_items_publicados($proyecto->codigo_sisin);
            $texto=$texto.'<table cellspacing="0" cellpadding="1" border="1">
            	<tr>
                    <th align="center" width="30"><strong>Items</strong></th>
                    <th align="center" width="90">descripcion</th>                    
                    <th align="center" width="100">Monto Total</th>
                    <th align="center" width="100">Fecha Publicacion</th>
                    <th align="center" width="100">Fecha de Apertura de Sobres</th>
                    <th align="center" width="100">Fecha Posible de Firma de Contrato</th>
                    <th align="center" width="100">Fecha de Entrega</th>
            	</tr>';
            foreach ($items as $item){
    
                $texto=$texto.'<tr>
        	        <td>'.$item->item.'</td>
                    <td>'.$item->descripcion.'</td>                    
                    <td>'.($item->precio_unidad*$item->cantidad).'</td>
                    <td>'.$item->fecha_publicacion.'</td>
                    <td>'.$item->fecha_apertura.'</td>                    
                    <td>'.$item->fecha_contrato.'</td>
                    <td>'.$item->fecha_entrega.'</td>
                    
        		</tr>';
    
            }
            $texto=$texto.'</table><br>';
    
    
            $texto.'<br>';
        }
    
    
    
    
        $html = <<<EOD
<h1>Lista de Proyectos recibidos para publicar</h1>
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
    
    function contratos()
    {
        $id_empleado_encargado = $this->session->userdata('id_empleado');
         
        $contratos = $this->contrato_model->get_todos_contratos_proyecto_detalle($id_empleado_encargado);
    
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
        <th align="center" width="120">Codigo SISIN</th>
            <th align="center" width="90">Codigo Contrataciones</th>
		<th align="center" width="200">Descripcion</th>
        <th align="center" width="70">Item</th>
        <th align="center" width="150">Descripcion item</th>
        <th align="center" width="70">Monto Adjudicado</th>
		<th align="center" width="100">Empresa</th>
        <th align="center" width="70">Fecha Entrega</th>
        <th align="center" width="70">Nro Contrato</th>
    
	</tr>';
        foreach ($contratos as $contrato){
            $texto=$texto.'<tr>
	        <td>'.$nro++.'</td>
            <td>'.$contrato->codigo_sisin.'</td>
            <td>'.$contrato->codigo_contrataciones.'</td>
            <td>'.$contrato->descripcion.'</td>
            <td>'.$contrato->item.'</td>
            <td>'.$contrato->descripcion_detalle.'</td>            
            <td>'.$contrato->monto_adjudicado.'</td>
            <td>'.$contrato->nombre_empresa.'</td>
            <td>'.$contrato->fecha_entrega_item.'</td>
            <td>'.$contrato->numero_contrato.'</td>
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Proyectos con Contrato</h1>
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
    
    function recepcionados()
    {
        $id_empleado_encargado = $this->session->userdata('id_empleado');
         
        $contratos = $this->recepcion_model->get_todos_recepcines($id_empleado_encargado);
    
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
        <th align="center" width="120">Codigo SISIN</th>
            <th align="center" width="90">Codigo Contrataciones</th>
		<th align="center" width="200">Descripcion</th>
        <th align="center" width="70">Item</th>
        <th align="center" width="150">Descripcion item</th>
        <th align="center" width="70">Monto Adjudicado</th>
		<th align="center" width="100">Fecha Recepcion</th>
        <th align="center" width="70">Observaciones</th>        
    
	</tr>';
        foreach ($contratos as $contrato){
            $texto=$texto.'<tr>
	        <td>'.$nro++.'</td>
            <td>'.$contrato->codigo_sisin.'</td>
            <td>'.$contrato->codigo_contrataciones.'</td>
            <td>'.$contrato->descripcion.'</td>
            <td>'.$contrato->item.'</td>
            <td>'.$contrato->descripcion_detalle.'</td>
            <td>'.$contrato->monto_adjudicado.'</td>
            <td>'.$contrato->fecha_recepcion.'</td>
            <td>'.$contrato->recepcion_observacion.'</td>
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Proyectos con Recepciones</h1>
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
    
    function enviados_a_pago()
    {
        $id_empleado_encargado = $this->session->userdata('id_empleado');
         
        $contratos = $this->planilla_model->get_todos_recepcines_pago($id_empleado_encargado);
    
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
        <th align="center" width="120">Codigo SISIN</th>
            <th align="center" width="90">Codigo Contrataciones</th>
		<th align="center" width="150">Descripcion</th>
        <th align="center" width="70">Item</th>
        <th align="center" width="150">Descripcion item</th>
        <th align="center" width="70">Monto Adjudicado</th>
		<th align="center" width="100">Fecha Envio para Pago</th>
        <th align="center" width="70">Observaciones</th>
        <th align="center" width="90">Empresa</th>    
    
	</tr>';
        foreach ($contratos as $contrato){
            $texto=$texto.'<tr>
	        <td>'.$nro++.'</td>
            <td>'.$contrato->codigo_sisin.'</td>
            <td>'.$contrato->codigo_contrataciones.'</td>
            <td>'.$contrato->descripcion.'</td>
            <td>'.$contrato->item.'</td>
            <td>'.$contrato->descripcion_detalle.'</td>
            <td>'.$contrato->monto_adjudicado.'</td>
            <td>'.$contrato->fecha_envio.'</td>
            <td>'.$contrato->observacion_envio.'</td>
                <td>'.$contrato->nombre_empresa.'</td>
		</tr>';
        }
        $texto=$texto.'</table>';
    
    
    
        $html = <<<EOD
<h1>Lista de Proyectos con Recepciones</h1>
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