<?php 

require_once('../Model/Facturaciones.php');

$DetalleVenta = new Facturaciones();

echo $IdVenta = $_POST['IdVenta'];
echo $IdProducto = $_POST['IdProducto'];
echo $Descripcion = $_POST['Descripcion'];
echo $Valor = $_POST['Valor'];
echo $Descuento = $_POST['Descuento'];
echo $Iva = $_POST['Iva'];
echo $Total = $Valor ;

$DetalleVenta->createDetalleProducto($IdVenta, $IdProducto, $Descripcion, $Valor, $Descuento, $Iva, $Total)


?>