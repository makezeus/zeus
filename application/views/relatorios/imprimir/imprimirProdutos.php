<?php
//============================================================+
// File name   : imprimirOs.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).



require_once($_SERVER['DOCUMENT_ROOT'].'/system/libraries/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Victor Azevedo');
$pdf->SetTitle('Azevedo Segurança e Tecnologia 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData('tcpdf_logo.jpg', '40px', 'Azevedo Segurança e Tecnologia', 'www.azevedoseg.com');



// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);


// add a page
$pdf->AddPage();



$precoInicial = $this->input->get('precoInicial');
$precoFinal =  $this->input->get('precoFinal');


if($precoFinal > '0,00'){

 $acao = 'DE R$ '.$precoInicial.' Á R$ '.$precoFinal;

}else{
$acao = "";
}

   
$html = '
                          <h4 style="text-align: center"><strong>RELATÓRIO DE PRODUTOS '.$acao.'</strong></h4>
                


                  <table border="1" cellpadding="5" >
                   
                          <tr>
                              <th style="width: 35%; font-size: 1.2em; padding: 5px;"><strong>Nome</strong></th>
                              <th style="width: 15%; font-size: 1.2em; padding: 5px;"><strong>UN</strong></th>
                              <th style="width: 15%; font-size: 1.2em; padding: 5px;"><strong>Preço Compra</strong></th>
                              <th style="width: 25%; font-size: 1.2em; padding: 5px;"><strong>Preço Venda</strong></th>
                              <th style="width: 10%; font-size: 1.2em; padding: 5px;"><strong>Lucro</strong></th>
                          </tr>
                   ';


 foreach ($produtos as $p) {
                           $html .=  '<tr style="    text-transform: uppercase;">
                            <td>' . strtoupper($p->descricao). '</td>
                             <td>' . $p->unidade . '</td>                            
                             <td> R$ ' .  $p->precoCompra. '</td>
                             <td> R$ ' .  $p->precoVenda  . '</td>
                              <td> R$ ' . $p->lucro. '</td>
                              </tr>';
                          }



$html .='
</table>


 <h5 style="text-align: right">Data do Relatório: '.date('d/m/Y').'</h5>

';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Produtos'.date('d/m/Y').'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+



