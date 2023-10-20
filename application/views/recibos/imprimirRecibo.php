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


';

class Monetary {

  private static $unidades = array("um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove", "dez", "onze", "doze",
    "treze", "quatorze", "quinze", "dezesseis", "dezessete", "dezoito", "dezenove");
  private static $dezenas = array("dez", "vinte", "trinta", "quarenta", "cinqüenta", "sessenta", "setenta", "oitenta", "noventa");
  private static $centenas = array("cem", "duzentos", "trezentos", "quatrocentos", "quinhentos",
    "seiscentos", "setecentos", "oitocentos", "novecentos");
  private static $milhares = array(
    array("text" => "mil", "start" => 1000, "end" => 999999, "div" => 1000),
    array("text" => "milhão", "start" => 1000000, "end" => 1999999, "div" => 1000000),
    array("text" => "milhões", "start" => 2000000, "end" => 999999999, "div" => 1000000),
    array("text" => "bilhão", "start" => 1000000000, "end" => 1999999999, "div" => 1000000000),
    array("text" => "bilhões", "start" => 2000000000, "end" => 2147483647, "div" => 1000000000)
  );

  const MIN = 0.01;
  const MAX = 2147483647.99;
  const MOEDA = " real ";
  const MOEDAS = " reais ";
  const CENTAVO = " centavo ";
  const CENTAVOS = " centavos ";

  static
  function numberToExt($number, $moeda = true) {
    if ($number >= self::MIN && $number <= self::MAX) {
      $value = self::conversionR((int) $number);
      if ($moeda) {
        if (floor($number) == 1) {
          $value .= self::MOEDA;
        } else if (floor($number) > 1)
          $value .= self::MOEDAS;
      }

      $decimals = self::extractDecimals($number);
      if ($decimals > 0.00) {
        $decimals = round($decimals * 100);
        $value .= " e ".self::conversionR($decimals);
        if ($moeda) {
          if ($decimals == 1) {
            $value .= self::CENTAVO;
          } else if ($decimals > 1)
            $value .= self::CENTAVOS;
        }
      }
    }
    return trim($value);
  }

  private static
  function extractDecimals($number) {
    return $number - floor($number);
  }

  static
  function conversionR($number) {
    if (in_array($number, range(1, 19))) {
      $value = self::$unidades[$number - 1];
    } else if (in_array($number, range(20, 90, 10))) {
      $value = self::$dezenas[floor($number / 10) - 1].
      " ";
    } else if (in_array($number, range(21, 99))) {
      $value = self::$dezenas[floor($number / 10) - 1].
      " e ".self::conversionR($number % 10);
    } else if (in_array($number, range(100, 900, 100))) {
      $value = self::$centenas[floor($number / 100) - 1].
      " ";
    } else if (in_array($number, range(101, 199))) {
      $value = ' cento e '.self::conversionR($number % 100);
    } else if (in_array($number, range(201, 999))) {
      $value = self::$centenas[floor($number / 100) - 1].
      " e ".self::conversionR($number % 100);
    } else {
      foreach(self::$milhares as $item) {
        if ($number >= $item['start'] && $number <= $item['end']) {
          $value = self::conversionR(floor($number / $item['div'])).
          " ".$item['text'].
          " ".self::conversionR($number % $item['div']);
          break;
        }
      }
    }
    return $value;
  }

}


$date = $result->dataRecibo;
$dataext = strftime("%A, %d de %B de %Y", strtotime($date));


$valorRecibo = $result->valorRecibo;
$valor = Monetary::numberToExt($valorRecibo);


if($emitente == null) {

$html .='

 

                                <div>Você precisa configurar os dados do emitente.>>><a href="/zeus/emitente">Configurar</a><<<</div>


';
} else {

$nome = $emitente[0]->nome;
$logo = $emitente[0]->url_logo;
$cnpj = $emitente[0]->cnpj;
$inscricao = $emitente[0]->ie;
$rua = $emitente[0]->rua;
$nmr = $emitente[0]->numero;
$cidade = $emitente[0]->cidade;
$uf = $emitente[0]->uf;
$fone = $emitente[0]->telefone;
$email= $emitente[0]->email;
}
                    
$html .=' 

<br>
<table width="100%">

  <tr>
    <td style="padding: 15px"><img src="'.$logo.'" width="120px" alt=""></td>
    <td colspan="2" style="text-align: right;"><h1>RECIBO  '.$result->idRecibo.'</h1><h1>VALOR R$ '.number_format($result->valorRecibo, 2, ',', '.').'</h1></td>
  </tr>

<tr><td></td></tr>
<tr><td></td></tr>


  <tr>
    <td colspan="3" style="text-align: justify;"><p>Recebemos de <b>'.$result->nomeCliente.'</b>, CPF/CNPJ nº <b>'.$result->documento.'</b>, a importância de '.$valor.' a(o) Pagamento de '.$result->referente.'.</p>

      <p>E, para maior clareza firmo o presente recibo para que produza aos seus efeitos, dando plena, rasa e irrevogável quitação pelo valor recebido.</p>

     </td>
  </tr>
  <tr><td></td></tr>
  <tr>
    <td></td>
    <td></td>


    <td style="text-align: right;"><p>'.$cidade.', '.$result->dataext.'</p></td>

  </tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>




  <tr><td></td>
    <td></td>
    <td>
<img src="'.base_url().'assets/img/assinatura.png" width="auto" style="margin-bottom: -5px;" alt="">
    <hr>

<span style="text-align: center;">Azevedo Segurança e Tecnologia</span>
    </td>
  </tr>
<tr><td></td></tr>
<tr><td></td></tr>

  <tr>

    <td style="text-align: center; width: 100%">Azevedo Segurança e Tencnologia - CPF/CNPJ: 29.498.234/0001-92 Isento <br> Rua Edmundo Victorino Nº 06 - Itajai - SC<br>  Fone 47988194473 <br> azevedoseg@hotmail.com <br> www.azevedoseg.com</td>

    </tr>

  <tr>
    <td>1ª Via Cliente</td>
    <td></td>
    <td></td>
  </tr>

<tr><td></td></tr>
<tr><td></td></tr>

  <tr>
    <td style="width: 100%" colspan="3"><hr style="
    border-style: dashed;
"></td>
  </tr>
</table>


'; 


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Os'.$result->nomeCliente.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+