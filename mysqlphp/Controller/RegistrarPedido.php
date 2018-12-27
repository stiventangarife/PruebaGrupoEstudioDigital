<?php  

include('../Model/Facturaciones.php');

$Model = new Facturaciones();

$Consecutivo = $_POST['Consecutivo'];
$idCliente = $_POST['Cliente'];
$Fecha = date('Y-m-d');
$Hora = date('h:m');
$Iva = $_POST['Iva'];
$Subtotal = 0;
$Descuento = $_POST['Descuento'];
$Total = 0;

$Model->createPedido($Consecutivo, $idCliente, $Fecha, $Hora, $Iva, $Subtotal, $Descuento, $Total);

?>