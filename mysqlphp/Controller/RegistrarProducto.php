<?php 

require_once('../Model/Facturaciones.php');

$Registro = new Facturaciones();

$Nombre = $_POST['Nombre'];
$Descripcion = $_POST['Descripcion'];
$Valor = $_POST['Valor'];

$Registro->createProducto($Nombre, $Descripcion, $Valor);

?>