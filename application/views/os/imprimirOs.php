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
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Victor Azevedo');
$pdf->SetTitle('Azevedo Segurança e Tecnologia 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

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
$pdf->SetFont('helvetica', '', 10);

// array of font names
$core_fonts = array('courier', 'courierB', 'courierI', 'courierBI', 'helvetica', 'helveticaB', 'helveticaI', 'helveticaBI', 'times', 'timesB', 'timesI', 'timesBI', 'symbol', 'zapfdingbats');


// add a page
$pdf->AddPage();

$totalServico = 0; $totalProdutos = 0;

$html ='

<body style="font-size:12px;">
<table border="0" cellpadding="8">

';

if($emitente == null) {

$html .='

 
<tr>
                                <td>Você precisa configurar os dados do emitente.>>><a href="/zeus/emitente">Configurar</a><<<</td>
</tr> 

';
} else {
                    
$html .='
                            
<tr>

<td style="width: 50%"><strong>Azevedo Segurança e Tecnologia</strong><br>
'.$result->nome.'<br>
'.$emitente[0]->cnpj.'<br>
'.$emitente[0]->rua.',
'.$emitente[0]->numero.',
'.$emitente[0]->bairro.',
'.$emitente[0]->cidade .'-
'.$emitente[0]->uf.'<br>
'.$emitente[0]->telefone.'<br>
'.$emitente[0]->email.'
                                  </td>
                                  <td style="width: 30%; text-align:center;">
                                <strong>Nº</strong> '.$result->idOs.'<br>
                                <strong>Data Entrada:</strong>  '.$result->dataInicial.'<br>
                                <strong>Data Entrega:</strong> '.$result->dataFinal.'<br>
                                <strong>Situação:</strong>'.$result->status.'<br>
                                <strong>Emissão: </strong>'.date('d/m/Y').'</td>
                                
                             </tr>
                                </table><br>
 <hr>                            
                             
<div><h2 style="Text-align:center; text-transform: uppercase">'.$result->status.'</h2></div>
'; 
}


$html .='
<div><strong>INFORMAÇÕES DO CLIENTE </strong></div>
<br>
<table  border="0" cellspacing="0" cellpadding="8" rules="none">
    <tr>
    <td style="width:15%;
    padding-right:0px;">
<strong>Nome/Razão:</strong><br>
<strong>Endereço:</strong><br>
<strong>Cidade:</strong><br>
<strong>Email:</strong>
    </td>

    <td style="
    width:35%;
    padding-left:0px;
    ">

'.$result->nomeCliente.'<br>
'.$result->rua.', '.$result->numero.'<br>
'.$result->cidade.'<br>
'.$result->emailCliente.'

    </td>
    <td style="width:15%;
       padding-right:0px;">
<strong>CNPJ/CPF:</strong><br>
<strong>Bairro:</strong><br>
<strong>Estado:</strong><br>
<strong>Telefone:</strong>


    </td>
       <td style=" 
       width:35%;
    padding-left:0px;
    ">
'.$result->documento.'<br>
'.$result->bairro.'<br>
'.$result->estado.'<br>
'.$result->telefoneCliente.'

       </td>
   </tr>


</table></body>

<div><strong>DETALHES DA OS</strong></div>
<BR>
<table border="0" cellspacing="0" cellpadding="5" rules="none">
';

if($result->descricaoProduto != null){

$html .='
<tr>
<td>
<strong>Descrição:</strong><br>
'.$result->descricaoProduto.'
</td>
</tr>';

}

if($result->defeito != null){

$html .='
<tr>
<td>
<strong>Defeito:</strong><br>
'.$result->defeito.'
</td>
</tr>';

}

if($result->laudoTecnico != null){

$html .='    
<tr>
<td>
<strong>Laudo Técnico:</strong><br>
'.$result->laudoTecnico.'
</td>
</tr>';

}

if($result->observacoes != null){

$html .='    
<tr>
<td>
<strong>Observações:</strong><br>
'.$result->observacoes.'
</td>
</tr>';

}

if($result->garantia != null){

$html .='    
<tr>
<td>
<strong>Garantia:</strong><br>
'.$result->garantia.'
</td>
</tr>';

}

$html .='

</table></body>

<div style="text-align:center;"><strong>DADOS DO SERVIÇO</strong></div>
<br>

';

if($servicos != null){

$html .='                        <table border="1" cellpadding="3">
                                        <thead>
                                            <tr style="font-weight: bold;">
                                                <th style="width:7%">ITEM</th>
                                                <th style="width:50%">SERVIÇO</th>
                                                <th style="width:10%" >QUANT</th>
                                                <th style="width:13%" >V.UNITÁRIO</th>
                                                <th style="width:20%">SUB-TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                  setlocale(LC_MONETARY, 'en_US');
                                        foreach ($servicos as $s) {
                                            $preco = $s->preco; 
                                            $subtotalServico = $s->quantidadeSer * $preco; 
                                             $totalServico += $subtotalServico;
                                   $html .= '    
                                                                                       
                                            <tr>
                                            <td style="width:7%; text-align:center;">'.$s->idServicos.'</td>
                                            <td style="width:50%">'.$s->nome.'</td>
                                            <td style="width:10%; text-align:center;">'.$s->quantidadeSer.'</td>
                                            <td style="width:13%; text-align: right">R$ '.number_format($s->preco, 2, ',', '.').'</td>
                                            <td style="width:20%; text-align: right">R$ '.number_format($subtotalServico, 2, ',', '.').'</td>

                                            </tr>
                                        

                                        ';
                                            }



                            $html .= '  
                                      <tr>
                                            <td colspan="2" style="text-align: right; width:80%"><strong>TOTAL DOS SERVIÇOS:</strong></td>
                                            <td style="width:20%; text-align: right"><strong>R$ '.number_format($totalServico, 2, ',', '.').'</strong></td>
                                        </tr>                  
                                        </tbody>
                                    </table>';
                        }


 if($produtos != null){
                        
       $html .='  
<br>
<div style="text-align:center;"><strong>DADOS DOS PRODUTOS</strong></div>
                      <br>
                        <table border="1" cellpadding="3" id="tblProdutos">
                                    <thead>
                                        <tr style="font-weight: bold; text-align:center;">
                                        <th style="width:7%;" >ITEM</th>
                                        <th style="width:50%" >PRODUTO</th>
                                        <th style="width:10%" >QUANT</th>
                                        <th style="width:13%" >V.UNITÁRIO</th>
                                        <th style="width:20%" >SUB-TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>';


                                      
                                        
                                        foreach ($produtos as $p) {

                                            $totalProdutos = $totalProdutos + $p->subTotal;
                                     $html .='       
                                            <tr>
                                            <td style="width:7%; text-align:center;">'.$p->idProdutos.'</td>
                                            <td style="width:50%">'.$p->descricao.'</td>
                                            <td style="width:10%; text-align:center;">'.$p->quantidade.'</td>
                                            <td style="width:13%; text-align: right;">R$ '.number_format($p->precoVenda,2,',','.').'</td>
                                            <td style="width:20%; text-align: right;">R$ '.number_format($p->subTotal,2,',','.').'</td>
                                            </tr>';
                                        }

$html .='
                                        <tr>
                                            <td colspan="2" style="text-align: right; width:80% "><strong>TOTAL PRODUTOS:</strong></td>
                                            <td style="width:20%; text-align: right" ><strong>R$ '.number_format($totalProdutos,2,',','.').'</strong></td>
                                        </tr>
                                    </tbody>
                                </table>';
                               }

$html .= '
<br>
<div style="text-align:center;"><strong>TOTAIS</strong></div>
                      <br>
<table border="1" cellpadding="3">
<thead>

<tr style="font-weight:bold; text-align:center;">
<th style="width: 80%">DESCRIÇÃO</th>
<th style="width: 20%">VALOR</th>
</tr>

</thead>
<tbody>

<tr style="text-align:right">
<td style="width: 80%">TOTAL DE PRODUTOS</td>
<td style="width: 20%">R$ '.number_format($totalProdutos,2,',','.').'</td>
</tr>

<tr style="text-align:right">
<td style="width: 80%">TOTAL DE SERVIÇOS</td>
<td style="width: 20%">R$ '.number_format($totalServico, 2, ',', '.').'</td>
</tr>

<tr style="text-align:right">
<td style="width: 80%">TOTAL</td>
<td style="width: 20%">R$ '.number_format($totalProdutos + $totalServico,2,',','.').'</td>
</tr>

</tbody>
</table>

<br>
<br>';
$status = $result->status;

if($status == 'Ordem de Serviço') {

$html .='

.

';
}

elseif($status == 'Finalizado') {

$html .='

.

';
}

else {

$html.='

<span style="color:red; font-weight:bold;">*Este(a) '.$result->status.' Tem Validade de 15 dias a partir da emissão, e esta sujeito a alteração de valores.</span>
';
};
$html .='
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<hr>
<span style="text-align:center;">Assinatura Do Cliente<span>



';



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Os'.date('d/m/Y').'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+