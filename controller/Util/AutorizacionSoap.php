<?php
/**
 * Created by PhpStorm.
 * User: svycar
 * Date: 3/4/18
 * Time: 13:11
 */

namespace Shara\Util;

use DateTime;
use Exception;
use SoapClient;


class AutorizacionSoap
{

    public static function autorizar($claveAcceso, $url)
    {

        $respuesta = null;


        try {


            $soap = '<?xml version="1.0" encoding="utf-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ec="http://ec.gob.sri.ws.autorizacion">
   <soapenv:Header/>
   <soapenv:Body>
      <ec:autorizacionComprobante>
         <claveAccesoComprobante>' . $claveAcceso . '</claveAccesoComprobante>
      </ec:autorizacionComprobante>
   </soapenv:Body>
</soapenv:Envelope>';


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            //curl_setopt($ch, CURLOPT_FRESH_CONNECT, false);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

            $headers = array();
            array_push($headers, "Content-Type: text/xml; charset=utf-8");
            array_push($headers, "Accept: text/xml");
            array_push($headers, "cache-Control: no-cache");
            array_push($headers, "Pragma: no-cache");
            array_push($headers, 'SOAPAction: "" ');

            if ($soap != null) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $soap);
                array_push($headers, "Content-Length: " . strlen($soap));
            }
            //curl_setopt($ch, CURLOPT_USERPWD, "user_name:password"); /* If required */
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


            for ($i = 0; $i < 5; $i++) {
                try {
                    //Log::info('consultando autorizacion clave: '.$claveAcceso.', intento : ' . $i);
                    $response = curl_exec($ch);

                    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    if ($code === 200)
                        break;
                } catch (Exception $ex) {
                    //Log::info('consultando autorizacion intento : ' . $i);
                    sleep(2);
                }
            }

            //$info = curl_getinfo($ch);

            curl_close($ch);

            if ($code != 200)
                return array('error' => true, 'mensaje' => 'ERROR al enviar al servicio de autorizaciones del SRI codigo de error soap: ' . $code);

            $respuesta = AutorizacionSoap::respuestaAutorizacion($response);
            //$respuesta['curlinfo']=$info;


        } catch (Exception $ex) {
            $respuesta = array('error' => true, 'mensaje' => $ex->getMessage());
        }


        return $respuesta;
    }

    public static function autorizarSoap($claveAcceso, $url, $espera)
    {

        $respuesta = null;


        try {

            ini_set("soap.wsdl_cache_enabled", "0");

            $wsdl = 'https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl';

            $client = new SoapClient($wsdl, array("trace"=>1,"soap_version" => SOAP_1_1,"cache_wsdl" => WSDL_CACHE_MEMORY));


            $param = array('claveAccesoComprobante' => $claveAcceso);

            //$client->soap_defencoding = 'UTF-8';
            //$client->xml_encoding = 'UTF-8';
            //$client->decode_utf8 = FALSE;

            $response = $client->autorizacionComprobante($param);
            //$response = $client->send($req,'autorizacionComprobante');

            $xml = $response->RespuestaAutorizacionComprobante;

//print_r($resultado);
            $result = $xml->autorizaciones;

            if ($result != null && $result->autorizacion != null) {
                $response = $result->autorizacion;
                if ($response != null) {
                    $estado = $response->estado;
                    if ($estado === 'AUTORIZADO') {

                        $respuesta['error'] = false;
                        $respuesta['estado'] = $estado;
                        $respuesta['autorizado'] = true;
                        $comprobante = $response->comprobante;
                        $respuesta['comprobante'] = $comprobante;
                        $respuesta['numauto'] = "12344";
                        $respuesta['ambiente'] = 2;
                        $respuesta['mensaje'] = "hola mundo";

                        $respuesta['fecauto'] = '10/02/2018';

                    }

                } else {
                    $mensaje = $response->mensajes;
                    if ($mensaje != null) {
                        $msg = $mensaje->mensaje;
                        if ($msg != null) {
                            $respuesta =  $msg->identificador . "   " . $msg->mensaje;
                        }
                    }

                }
            }

        } catch (Exception $ex) {
            $respuesta = array('error' => true, 'mensaje' => $ex->getMessage());
        }


        return $respuesta;
    }

    private static function respuestaAutorizacion($response)
    {

        $respuesta = null;
        try {
            $content = FormGenerales::value_in("RespuestaAutorizacionComprobante", $response);

            if ($content != false) {
                $estado = FormGenerales::value_in("estado", $content);

                if ($estado === false)
                    $respuesta = array('error' => true, 'mensaje' => 'no se puede identificar el estado para la respuesta de la autorizacion');
                else {
                    if ($estado === 'AUTORIZADO') {
                        $respuesta['autorizado'] = true;
                        $respuesta['numauto'] = FormGenerales::value_in("numeroAutorizacion", $response);
                    } else{
                        $respuesta['autorizado'] = false;
                        $mensaje = FormGenerales::value_in("mensajes", $content);
                        $respuesta['mensaje'] = '<mensaje>' . $mensaje . '</mensaje>';
                    }

                    $respuesta['error'] = false;
                    $respuesta['estado'] = $estado;
                    $comprobante = FormGenerales::value_in("comprobante", $response);
                    $respuesta['comprobante'] = $comprobante;
                    $respuesta['clave'] = FormGenerales::value_in("claveAccesoConsultada", $response);
                    $respuesta['ambiente'] = FormGenerales::value_in("ambiente", $response);

                    $fecauto = FormGenerales::value_in("fechaAutorizacion", $response);
                    $d = new DateTime($fecauto);

                    $respuesta['fecauto'] = $d->format('d/m/Y H:i:s');

                }
            } else
                $respuesta = array('error' => true, 'mensaje' => 'no se puede identificar la respuesta de recepcion del comprobante');

        } catch (Exception $ex) {
            $respuesta = array('error' => true, 'mensaje' => $ex->getMessage());
        }

        return $respuesta;

    }


}