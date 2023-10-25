<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


function p($a)
{
    echo '<pre>';
    print_r($a);
    echo '</pre>';
}
function v($a)
{
    echo '<pre>';
    var_dump($a);
    echo '</pre>';
}

function getMobileRequest()
{
    return isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile|android|iphone|ipad|phone|iemobile/i', $_SERVER['HTTP_USER_AGENT']);
}


function clean_header($array)
{
    $CI = get_instance();
    $CI->load->helper('inflector');
    foreach ($array as $a) {
        $arr[] = humanize($a);
    }
    return $arr;
}

function validate_money($valor)
{

    if (preg_match("/^([0-9]*)\.(\d{2})$/", $valor)) {
        return true;
    }
    return false;
}

function formatarDocumento($documento)
{

    $documento = preg_replace("/[^0-9]/", "", $documento);

    if (strlen($documento) === 11) {

        $documentoFormatado = substr($documento, 0, 3) . '.' . substr($documento, 3, 3) . '.' . substr($documento, 6, 3) . '-' . substr($documento, 9, 2);
    } elseif (strlen($documento) === 14) {

        $documentoFormatado = substr($documento, 0, 2) . '.' . substr($documento, 2, 3) . '.' . substr($documento, 5, 3) . '/' . substr($documento, 8, 4) . '-' . substr($documento, 12, 2);
    } else {

        $documentoFormatado = "Documento inválido";
    }

    return $documentoFormatado;
}


function formatPhone($telefone)
{

    $telefone = preg_replace("/[^0-9]/", "", $telefone);

    if (strlen($telefone) == 10) {

        $telefoneFormatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4);
    } elseif (strlen($telefone) == 11) {

        $telefoneFormatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 1) . ' ' . substr($telefone, 3, 4) . '-' . substr($telefone, 7, 4);
    } else {

        $telefoneFormatado = "Telefone inválido";
    }

    return $telefoneFormatado;
}

function removeMask($value)
{
    return preg_replace("/[^0-9]/", "", $value);
}

function statusMapperBudget($status, $mobileIgnore = false)
{
    switch ($status) {
        case 'Aberto':
            $cor = '#C6F4D5';
            break;
        case 'Em Andamento':
            $cor = '#CDE3FE';
            break;
        case 'Orçamento':
            $cor = '#FFEEAB';
            break;
        case 'Cancelado':
            $cor = '#FFB9C3';
            break;
        case 'Finalizado':
            $cor = '#E5E7EB';
            break;
        case 'Faturado':
            $cor = '#FFC3E2';
            break;
        default:
            $cor = '#DCDCF8';
            break;
    }
    if (getMobileRequest() && !$mobileIgnore) {
        return "<div class='mobile-badge' style='background-color:" . $cor . ";'></div>";
    }

    return "<span class='badge' style='background-color:" . $cor . "; border-color: " . $cor . "'>" . $status . "</span>";
}

function getProfileImage($name, $image, $size)
{
    $nameSliced = explode(" ", $name);
    $firstLetterName = substr($nameSliced[0], 0, 1);
    $firstLetterLastName = substr($nameSliced[count($nameSliced) - 1], 0, 1);

    $initials = $firstLetterName . $firstLetterLastName;

    $picture = '<picture id="profileImage" style="width:';
    $picture .= $size;
    $picture .= 'px; margin-left: 12px; margin-right: 12px; height: ' . $size . 'px; display: flex; background: #fff; border-radius: 100%; box-shadow: 0px 0px 15px #00000017;
    background-size: cover; background-position: center; justify-content: center; align-content: center; align-items: center; font-size: 1.25rem; font-weight: 500; color: #000;';
    if ($image) {
        $picture .= 'background-image: url(' . $image . ')';
    }
    $picture .= '">';
    if (!$image) {
        $picture .= $initials;
    }
    $picture .= '</picture>';

    return $picture;
}


function formatMoney($number)
{
    return 'R$ ' . number_format($number, 2, ',', '.');
}

function formatDate($date)
{
    if (!empty($date)) {
        $formattedDate = date('d/m/Y', strtotime($date));
        return $formattedDate;
    }
    return '';
}

function formatMoneyDB($value)
{
    $precoCompra = trim($value);
    $precoCompra = str_replace("R$", "", $precoCompra);
    $precoCompra = str_replace(",", ".", $precoCompra);
    $precoCompra = preg_replace('/[^\d.]/', '', $precoCompra);
    $precoCompra = (float) $precoCompra;

    return $precoCompra;
}