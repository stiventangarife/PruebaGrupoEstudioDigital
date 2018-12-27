<?php  

include('../Model/Facturaciones.php');

$Modelo = new Facturaciones();

$Modelo->deleteProducto($_POST['Id']);

?>