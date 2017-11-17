<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
	    $data['contenido_principal'] = 'home';    
	    $data['error'] = 0;
	    $this->load->view('template/template',$data);
	}
	public function jurado()
	{
		$data['resultados']=$this->jurado_model->get_todos();    		
    	$data['contenido_principal'] = 'admin/jurado';    
	    $data['error'] = 0;
	    $this->load->view('template/template',$data); 
	}

	public function participante()
	{
		$data['resultados']=$this->participante_model->get_todos();    		
    	$data['contenido_principal'] = 'admin/participante';    
	    $data['error'] = 0;
	    $this->load->view('template/template',$data); 
	}

	public function pasarela()
	{
		$data['resultados']=$this->pasarela_model->get_todos();    		
    	$data['contenido_principal'] = 'admin/pasarela';    
	    $data['error'] = 0;
	    $this->load->view('template/template',$data); 
	}
	
	public function reporte_sin_suma(){		
   
        $datos = $this->calificacion_model->get_calificaciones_sin_suma();
    
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'usletter', true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('UTO');
        $pdf->SetTitle('Elección Miss Oruro 2017');
        $pdf->SetSubject('Sistema Catec');
        $pdf->SetKeywords('catec');
    
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Elección Miss Oruro 2017', 'Sis. catec 2017', array(
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
    	$texto=$texto.'<hr><br/><br/><table cellspacing="0" cellpadding="1" border="1">
            	<tr style="background-color:yellow;">
                    <th align="center" width="30"><strong>Nro.</strong></th>
                    <th align="center" width="90">Jurado</th>
                        
            		<th align="center" width="200">Participante</th>
    
                    <th align="center" width="200">Pasarela</th>
    				<th align="center" width="100">Calificación</th>
            	</tr>';
        foreach ($datos as $dato){
            
            $texto=$texto.'<tr>
        	        <td>'.$nro++.'</td>
                    <td>'.$dato->jnombre.'</td>
                    
                    <td>'.$dato->nombres.' '.$dato->apellidos.'</td>
    
                    <td>'.$dato->pnombre.'</td>
                    <td>'.$dato->calificacion.'</td>
        		</tr>';
        }
    	$texto=$texto.'</table><br>';
        $texto.'<br>';
    
    
        $html = <<<EOD
<h1>Lista de Puntos Asignados</h1>
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

	public function reporte_con_suma(){		
   
        $datos = $this->calificacion_model->get_calificaciones_con_suma();
    
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'usletter', true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('UTO');
        $pdf->SetTitle('Elección Miss Oruro 2017');
        $pdf->SetSubject('Sistema Catec');
        $pdf->SetKeywords('catec');
    
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Elección Miss Oruro 2017', 'Sis. catec 2017', array(
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
    	$texto=$texto.'<hr><br/><br/><table cellspacing="0" cellpadding="1" border="1">
            	<tr style="background-color:yellow;">
                    <th align="center" width="30"><strong>Nro.</strong></th>
            		<th align="center" width="250">Participante</th>
                    <th align="center" width="200">Pasarela</th>
    				<th align="center" width="100">Calificación</th>
            	</tr>';
        foreach ($datos as $dato){
            
            $texto=$texto.'<tr>
        	        <td>'.$nro++.'</td>
                    <td>'.$dato->nombres.' '.$dato->apellidos.'</td>
                    <td>'.$dato->pnombre.'</td>
                    <td>'.$dato->suma.'</td>
        		</tr>';
        }
    	$texto=$texto.'</table><br>';
        $texto.'<br>';
    
    
        $html = <<<EOD
<h1>Lista de Puntos Asignados por Participante y Pasarela</h1>
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

	public function reporte_final(){		
   
        $datos = $this->calificacion_model->get_calificaciones_finales();
    
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'usletter', true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('UTO');
        $pdf->SetTitle('Elección Miss Oruro 2017');
        $pdf->SetSubject('Sistema Catec');
        $pdf->SetKeywords('catec');
    
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Elección Miss Oruro 2017', 'Sis. catec 2017', array(
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
    	$texto=$texto.'<hr><br/><br/><table cellspacing="0" cellpadding="1" border="1">
            	<tr style="background-color:yellow;">
                    <th align="center" width="30"><strong>Nro.</strong></th>
            		<th align="center" width="200">Participante</th>
    				<th align="center" width="100">Calificación</th>
            	</tr>';
        foreach ($datos as $dato){
            
            $texto=$texto.'<tr>
        	        <td>'.$nro++.'</td>
                    <td>'.$dato->nombres.' '.$dato->apellidos.'</td>
                    <td>'.$dato->suma.'</td>
        		</tr>';
        }
    	$texto=$texto.'</table><br>';
        $texto.'<br>';
    
    
        $html = <<<EOD
<h1>Lista Final de Puntos Asignados ordenados por Puntos Acumulados</h1>
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
