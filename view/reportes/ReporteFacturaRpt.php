<?php
include dirname(__FILE__).'\..\..\view\mpdf\mpdf.php';
$template = file_get_contents('view/reportes/template/ReporteFactura.html');
$footer = file_get_contents('view/reportes/template/pieret.html');

if(!empty($datos_reporte))
{
    foreach ($datos_reporte as $clave=>$valor) {
         $template = str_replace('{'.$clave.'}', $valor, $template);
    }
}

ob_end_clean();
$mpdf=new mPDF('utf-8', array(50,100));
$stylesheet = file_get_contents('view/reportes/template/ReporteFactura.css'); // la ruta a tu css
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($template,2);
$mpdf->debug = true;
$mpdf->Output();
exit();
?>

