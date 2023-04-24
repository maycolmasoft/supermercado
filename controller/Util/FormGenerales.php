<?php
/**
 * Created by PhpStorm.
 * User: svycar
 * Date: 3/4/18
 * Time: 14:59
 */

namespace Shara\Util;


use DOMDocument;
use Exception;

class FormGenerales
{
    public static function value_in($element_name, $xml, $content_only = true)
    {
        if ($xml == false) {
            return false;
        }
        $found = preg_match('#<' . $element_name . '(?:\s+[^>]+)?>(.*?)' .
            '</' . $element_name . '>#s', $xml, $matches);
        if ($found != false) {
            if ($content_only) {
                return $matches[1];
            } else {
                return $matches[0];
            }
        }
        // no coinciden: return false.
        return false;
    }

    public  static function obtenerDetalleFormaPago($codigo)
    {

        $forma = "";
        try {
            switch ($codigo) {
                case "01":
                    $forma = "SIN UTILIZACION DEL SISTEMA FINANCIERO";
                    break;
                case "02":
                    $forma = "CHEQUE PROPIO";
                    break;
                case "03":
                    $forma = "CHEQUE CERTIFICADO";
                    break;
                case "04":
                    $forma = "CHEQUE DE GERENCIA";
                    break;
                case "05":
                    $forma = "CHEQUE DEL EXTERIOR";
                    break;
                case "06":
                    $forma = "DÉBITO DE CUENTA";
                    break;
                case "07":
                    $forma = "TRANSFERENCIA PROPIO BANCO";
                    break;
                case "08":
                    $forma = "TRANSFERENCIA OTRO BANCO NACIONAL";
                    break;
                case "09":

                    $forma = "TRANSFERENCIA BANCO EXTERIOR";
                    break;
                case "10":
                    $forma = "TARJETA DE CRÉDITO NACIONAL";
                    break;
                case "11":
                    $forma = "TARJETA DE CRÉDITO INTERNACIONAL";
                    break;
                case "12":
                    $forma = "GIRO";
                    break;
                case "13":
                    $forma = "DEPOSITO EN CUENTA (CORRIENTE/AHORROS)";
                    break;
                case "14":
                    $forma = "ENDOSO DE INVERSIÒN";
                    break;
                case "15":
                    $forma = "COMPENSACIÓN DE DEUDAS";
                    break;
                case "16":
                    $forma = "TARJETA DE DÉBITO";
                    break;
                case "17":
                    $forma = "DINERO ELECTRÓNICO";
                    break;
                case "18":
                    $forma = "TARJETA PREPAGO";
                    break;
                case "19":
                    $forma = "TARJETA DE CRÉDITO";
                    break;
                case "20":
                    $forma = "OTROS CON UTILIZACION DEL SISTEMA FINANCIERO";
                    break;
                case "21":
                    $forma = "ENDOSO DE TÍTULOS";
                    break;
                default:
                    $forma = "";
                    break;
            }
            return $forma;
        } catch (Exception $ex) {

            return "";
        }

    }

    public  static  function getInfoTributaria($comprobante)
    {
        $resp = null;
        try {
            $documento = new DOMDocument();
            $documento->loadXML($comprobante);

            $infoTri = $documento->getElementsByTagName('infoTributaria')->item(0);

            if ($infoTri != null) {
                $resp['error'] = false;
                $resp['coddoc'] = $infoTri->getElementsByTagName("codDoc")->item(0)->nodeValue;
                $resp['ruc'] = $infoTri->getElementsByTagName("ruc")->item(0)->nodeValue;
                $resp['razonsocial'] = $infoTri->getElementsByTagName("razonSocial")->item(0)->nodeValue;
            } else
                $resp = array('error' => true, 'mensaje' => 'no se pudo localizar infotributaria');
        } catch (Exception $ex) {
            $resp = array('error' => true, 'mensaje' => $ex->getMessage());
        }
        return $resp;
    }

}