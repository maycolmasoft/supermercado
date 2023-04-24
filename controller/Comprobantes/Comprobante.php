<?php
/**
 * Created by PhpStorm.
 * User: svycar
 * Date: 26/3/18
 * Time: 21:24
 */

namespace Shara\Comprobantes;


use DOMDocument;
use Exception;
use Shara\Util\AutorizacionSoap;
use Shara\Util\RecepcionSoap;
use XMLWriter;

class Comprobante
{
    private $proxy;
    private $ambiente;
    private $docFirmados = null;
    private $docAutorizados = null;
    private $docRechazados = null;
    private $docGenerados = null;
    private $docPdf = null;
    private $pathLogo = null;
    private $claveAcesso = null;
    private $path_xsd;

    /**
     * Comprobante constructor.
     */
    public function __construct(array $config)
    {
        $this->proxy = [
            'pruebas' => $config['url_pruebas'],
            'produccion' => $config['url_produccion'],
        ];

        $this->docFirmados = $config['firmados'];
        $this->docAutorizados = $config['autorizados'];
        $this->docRechazados = $config['noautorizados'];
        $this->docGenerados = $config['generados'];
        $this->docPdf = $config['pdf'];
        $this->path_xsd = $config['xsd'];

    }

    /**
     * @param string $claveAcesso
     */
    public function setClaveAcesso($claveAcesso)
    {
        $this->claveAcesso = $claveAcesso;
        $this->ambiente = substr($claveAcesso, 23, 1);
    }

    /**
     * @return null
     */
    public function getClaveAcesso()
    {
        return $this->claveAcesso;
    }

    /**
     * @param null $pathLogo
     */
    public function setPathLogo($pathLogo)
    {
        $this->pathLogo = $pathLogo;
    }


    private function getUrlEnvio()
    {
        $url = null;
        if ($this->ambiente === '1') {
            $url = $this->proxy['pruebas'] . "/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl";
        } else if ($this->ambiente === '2')
            $url = $this->proxy['produccion'] . "/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl";

        return $url;
    }


    private function getUrlAutorizacion()
    {
        $url = null;
        if ($this->ambiente === '1') {
            $url = $this->proxy['pruebas'] . "/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl";
        } else if ($this->ambiente === '2')
            $url = $this->proxy['produccion'] . "/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl";

        return $url;
    }

    public static function firmarComprobante(array $firma, $clave)
    {
        $docGenerados = $firma['generados'];
        $docFirmados = $firma['firmados'];

        if (file_exists($docGenerados . DIRECTORY_SEPARATOR . $clave . '.xml') === false)
            return array('error' => true, 'mensaje' => 'documento generado no existe');

        $config = array(
            'file' => $firma['file'],
            'pass' => $firma['pass']
        );
        
        $firma = new Firma($config, $clave);

        $resp = $firma->verificarCertPKey();

        if ($resp["error"] === true)
            return $resp;

        $xml = file_get_contents($docGenerados. DIRECTORY_SEPARATOR . $clave . '.xml', FILE_USE_INCLUDE_PATH);

        $resp = $firma->firmar($xml, $docFirmados);

        if ($resp != null)
            return $resp;

        return array('error' => false, 'mensaje' => 'firma OK');
    }

    public static function validarXml($xmlString, $pathXsdName)
    {
        $resp = null;
        try {
            libxml_use_internal_errors(true);

            //$aux =getcwd();
            $documento = new DOMDocument();
            $documento->loadXML($xmlString);

            if (!$documento->schemaValidate($pathXsdName)) {
                $aux = '<b>DOMDocument::schemaValidate() Genero Errores!</b>' . "\n";
                $aux .= Comprobante::libxml_display_errors();
                $resp = array('error' => true, 'mensaje' => $aux);
                return $resp;
            }
        } catch (Exception $ex) {
            $resp = array('error' => true, 'mensaje' => $ex->getMessage());
        }

        return $resp;
    }

    private static function libxml_display_error($error)
    {
        $return = "<br/>\n";
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $return .= "<b>Warning $error->code</b>: ";
                break;
            case LIBXML_ERR_ERROR:
                $return .= "<b>Error $error->code</b>: ";
                break;
            case LIBXML_ERR_FATAL:
                $return .= "<b>Fatal Error $error->code</b>: ";
                break;
        }
        $return .= trim($error->message);
        if ($error->file) {
            $return .= " in <b>$error->file</b>";
        }
        $return .= " on line <b>$error->line</b>\n";

        return $return;
    }

    public static function libxml_display_errors()
    {

        $error_xsd = "";
        $errors = libxml_get_errors();
        foreach ($errors as $error) {
            $error_xsd .= Comprobante::libxml_display_error($error);
        }
        libxml_clear_errors();

        return $error_xsd;
    }

    public function envioIndividualSri($tipoDoc)
    {
        $resp = null;
        try {

            /*ini_set('soap.wsdl_cache_enabled', 0);
            ini_set('soap.wsdl_cache_ttl', 900);
            ini_set('default_socket_timeout', 15);

            $wsdl = 'https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl';

            $options = array(
                //'uri'=>'http://schemas.xmlsoap.org/wsdl/soap/',
                'soap_version' => SOAP_1_1,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'connection_timeout' => 15,
                'trace' => true,
                'encoding' => 'UTF-8',
                'exceptions' => true
            );

            $client = new SoapClient($wsdl, $options);
            */

            $url = $this->getUrlEnvio();

            if ($url === null)
                return array('error' => true, 'mensaje' => 'no se pudo identificar el tipo de ambiente para el envio del comprobante');

            if (file_exists($this->docFirmados . DIRECTORY_SEPARATOR . $this->claveAcesso . '.xml') === false)
                return array('error' => true, 'mensaje' => 'documento firmado no existe');

            $docFirmado = file_get_contents($this->docFirmados . DIRECTORY_SEPARATOR . $this->claveAcesso . '.xml', FILE_USE_INCLUDE_PATH);

            if ($docFirmado === null)
                return array('error' => true, 'mensaje' => 'error al leer el documento firmado');

            $xml64 = base64_encode($docFirmado);

            $respuesta = RecepcionSoap::enviar($xml64, $url, $this->claveAcesso);

            if ($respuesta['error'] === true) {
                $resp['estado']=$respuesta['estado'];

                if (array_key_exists('estado', $respuesta) && $respuesta['estado'] === 'DEVUELTA') {

                    $resp['recibido']=false;

                    $error_response = $respuesta['mensaje'];
                    if ($tipoDoc === '01') {
                        $docFirmado = str_replace('</factura>', $error_response . '</factura>', $docFirmado);
                    } elseif ($tipoDoc === '07') {
                        $docFirmado = str_replace('</comprobanteRetencion>', $error_response . '</comprobanteRetencion>', $docFirmado);
                    } elseif ($tipoDoc === '04') {
                        $docFirmado = str_replace('</notaCredito>', $error_response . '</notaCredito>', $docFirmado);
                    } elseif ($tipoDoc === '06') {
                        $docFirmado = str_replace('</guiaRemision>', $error_response . '</guiaRemision>', $docFirmado);
                    }

                    $mensaje = $respuesta['mensaje'];

                    if (strpos($mensaje, 'TRANSMITIDO SIN RESPUESTA') !== false) {
                        if (!is_dir($this->docFirmados . DIRECTORY_SEPARATOR . 'transmitidosSinRespuesta'))
                            if (!mkdir($this->docFirmados . DIRECTORY_SEPARATOR . 'transmitidosSinRespuesta', 0755, true)) {
                                $resp['error'] = true;
                                $resp['mensaje'] = 'Fallo al crear el directorio' . $this->docFirmados . DIRECTORY_SEPARATOR . 'transmitidosSinRespuesta';
                            } else
                                file_put_contents($this->docFirmados . DIRECTORY_SEPARATOR . 'transmitidosSinRespuesta' . DIRECTORY_SEPARATOR . $this->claveAcesso . '.xml', $docFirmado);
                    } else {
                        if (!is_dir($this->docFirmados . DIRECTORY_SEPARATOR . 'rechazados')) {
                            if (!mkdir($this->docFirmados . DIRECTORY_SEPARATOR . 'rechazados', 0755, true))
                                $resp['error'] = true;
                                $resp['mensaje'] = 'Fallo al crear el directorio' . $this->docFirmados . DIRECTORY_SEPARATOR . 'rechazados';
                        } else
                            try {
                                file_put_contents($this->docFirmados . DIRECTORY_SEPARATOR . 'rechazados' . DIRECTORY_SEPARATOR . $this->claveAcesso . '.xml', $docFirmado);
                                $resp['error'] = true;
                                $resp['mensaje'] = $mensaje;
                            } catch (Exception $ex) {
                                $resp['error'] = true;
                                $resp['mensaje'] = $ex->getMessage();
                            }

                    }

                } else {
                    $resp['error'] = true;
                    $resp['mensaje'] = $respuesta['mensaje'];
                }

            } elseif (array_key_exists('estado', $respuesta) && $respuesta['estado'] === 'RECIBIDA') {
                $resp['error'] = false;
                $resp['recibido'] = true;
            }
        } catch (Exception $ex) {
            $resp['error'] = true;
            $resp['mensaje'] = $ex->getMessage();
        }
        return $resp;
    }

    public function autorizacionIndividualSri($tipoDoc)
    {
        $resp = null;
        try {

            $url = $this->getUrlAutorizacion();

            if ($url === null)
                return array('error' => true, 'mensaje' => 'no se pudo identificar el tipo de ambiente para consulta de autorizacion');

            $respuesta = AutorizacionSoap::autorizar($this->claveAcesso, $url);

            $resp = $respuesta;

            if ($respuesta['error'] === false) {
                if (array_key_exists('estado', $respuesta)) {

                    $writer = new XMLWriter();
                    //$writer->openURI("newfile.xml");
                    $writer->openMemory();
                    $writer->setIndent(true);
                    $writer->setIndentString("");
                    $writer->startDocument('1.0', 'UTF-8');

                    $writer->startElement('autorizacion');

                    $writer->startElement("estado");
                    $writer->text($respuesta['estado']);
                    $writer->endElement();

                    if($respuesta['autorizado'] === true) {
                        $writer->startElement("numeroAutorizacion");
                        $writer->text($respuesta['numauto']);
                        $writer->endElement();
                    }

                    $writer->startElement("fechaAutorizacion");
                    $writer->startAttribute('class');
                    $writer->text('fechaAutorizacion');
                    $writer->endAttribute();
                    $writer->text($respuesta['fecauto']);
                    $writer->endElement();

                    $writer->startElement("ambiente");
                    $writer->text($respuesta['ambiente']);
                    $writer->endElement();

                    $writer->startElement('comprobante');
                    $writer->startCData();
                    $writer->text($respuesta['comprobante']);
                    $writer->endCData();
                    $writer->fullEndElement();

                    $writer->startElement("mensajes");

                    if (array_key_exists('mensaje', $respuesta))
                        $mensaje = $respuesta['mensaje'];
                    else
                        $mensaje = "";

                    $writer->text($mensaje);
                    $writer->endElement();

                    $writer->fullEndElement();

                    $writer->endDocument();
                    $cadenaXML = trim($writer->outputMemory());

                    $cadenaXML = str_replace(['&lt;', '&gt;'], ['<', '>'], $cadenaXML);

                    try {
                        if ($respuesta['autorizado'] === true)
                            file_put_contents($this->docAutorizados . DIRECTORY_SEPARATOR . $this->claveAcesso . '.xml', $cadenaXML);
                        else
                            file_put_contents($this->docRechazados . DIRECTORY_SEPARATOR . $this->claveAcesso . '.xml', $cadenaXML);

                    } catch (Exception $ex) {
                        $resp = array('error' => true, 'mensaje' => 'estado de la autorizacion: ' . $respuesta['estado'] . $ex->getMessage());
                    }

                    if(file_exists($this->docFirmados . DIRECTORY_SEPARATOR . $this->claveAcesso . '.xml') === true) {
                        if (!unlink($this->docFirmados . DIRECTORY_SEPARATOR . $this->claveAcesso . '.xml')) {
                            $resp = array('error' => true, 'mensaje' => 'error al eliminar el documento firmado: ' . $this->docFirmados . DIRECTORY_SEPARATOR . $this->claveAcesso . '.xml');
                        }
                    }
                    $resp['comprobante'] = str_replace(['&lt;', '&gt;'], ['<', '>'], $cadenaXML);

                } else
                    $resp = array('error' => true, 'mensaje' => $respuesta['mensaje']);

            } else

                $resp = array('error' => true, 'mensaje' => $respuesta['mensaje']);

        } catch (Exception $ex) {
            $resp = array('error' => true, 'mensaje' => $ex->getMessage());
        }
        return $resp;
    }

}