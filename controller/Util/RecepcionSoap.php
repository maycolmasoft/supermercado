<?php
/**
 * Created by PhpStorm.
 * User: svycar
 * Date: 3/4/18
 * Time: 13:11
 */

namespace Shara\Util;

use Exception;

class RecepcionSoap
{

    public static function enviar($xml64, $url, $clave)
    {

        $respuesta = null;
        try {
            $soap = '<?xml version="1.0" encoding="utf-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ec="http://ec.gob.sri.ws.recepcion">
   <soapenv:Header/>
   <soapenv:Body>
      <ec:validarComprobante>
        <xml>' . $xml64 . '</xml>
      </ec:validarComprobante>
   </soapenv:Body>
</soapenv:Envelope>';


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            //curl_setopt($ch, CURLOPT_CAINFO, getcwd() . '../public/celcersrigobec.crt');
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
                    //Log::info('enviando clave: ' . $clave . ', intento : ' . $i);
                    $response = curl_exec($ch);

                    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    if ($code === 200)
                        break;
                } catch (Exception $ex) {
                    //Log::info('enviando intento : ' . $i);
                    sleep(2);
                }
            }

            curl_close($ch);

            if ($code != 200)
                return array('error' => true, 'mensaje' => 'ERROR al enviar al servicio del SRI codigo de error soap: ' . $code);

            $respuesta = RecepcionSoap::respuestaEnvio($response);


        } catch (Exception $ex) {
            $respuesta = array('error' => true, 'mensaje' => $ex->getMessage());
        }

        return $respuesta;
    }

    private static function respuestaEnvio($response)
    {

        $respuesta = null;
        try {
            $content = FormGenerales::value_in("RespuestaRecepcionComprobante", $response);

            if ($content != false) {
                $estado = FormGenerales::value_in("estado", $content);

                if ($estado === false)
                    $respuesta = array('error' => true, 'mensaje' => 'no se puede identificar el estado para la respuesta del envio');
                else {
                    if ($estado === 'DEVUELTA') {
                        $respuesta = array('error' => true, 'estado' => $estado, 'mensaje' => '<ns2:respuestaSolicitud xmlns:ns2="http://ec.gob.sri.ws.recepcion">' . $content . '</ns2:respuestaSolicitud>');

                    } else
                        $respuesta = array('error' => false, 'estado' => $estado, 'mensaje' => $estado);
                }
            } else
                $respuesta = array('error' => true, 'mensaje' => 'no se puede identificar la respuesta de recepcion del comprobante');

        } catch (Exception $ex) {
            $respuesta = array('error' => true, 'mensaje' => $ex->getMessage());
        }

        return $respuesta;

    }

}