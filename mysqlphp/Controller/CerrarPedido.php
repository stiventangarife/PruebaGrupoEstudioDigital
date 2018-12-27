<?php  

include('../Model/Facturaciones.php');

$Model = new Facturaciones();

echo $IdPedido = $_POST['IdCerrar'];
echo $SubTotal = $_POST['Subtotal'];
echo $TotalNeto = $_POST['Total'];

$Model->closeVenta($IdPedido, $SubTotal, $TotalNeto);

?>