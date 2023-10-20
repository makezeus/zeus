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

   
$html = '
                          <h4 style="text-align: center"><strong>RELATÓRIO DE ORDEM DE SERVIÇOS</strong></h4>
                


                  <table border="1" cellpadding="5" >
                   
 <tr>
        <th style="width:35% font-size: 1.2em; padding: 5px;  font-weight: bold;">Cliente</th>
        <th style="width:10% font-size: 1.2em; padding: 5px;  font-weight: bold;">Status</th>
        <th style="width:10% font-size: 1.2em; padding: 5px;  font-weight: bold;">Data</th>
        <th style="width:35% font-size: 1.2em; padding: 5px;  font-weight: bold;">Descrição</th>
        <th style="width:10% font-size: 1.2em; padding: 5px;  font-weight: bold;">Valor</th>
    </tr>
                   ';

$encoding = 'UTF-8'; // ou ISO-8859-1...


foreach ($os as $row) 
{


         $html .= '<tr>
                <td style="width:35%">' . mb_convert_case($row->nomeCliente, MB_CASE_UPPER, $encoding). '</td>
                <td style="width:10%">' . mb_convert_case($row->status, MB_CASE_UPPER, $encoding). '</td>
                <td style="width:10%">' . date('d/m/Y',  strtotime($row->dataInicial)) . '</td>
                <td style="width:35%">' . mb_convert_case($row->descricaoProduto, MB_CASE_UPPER, $encoding). '</td>
                <td style="width:10%">' . number_format($row->valorTotal , 2, ',', '.'). '</td>
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