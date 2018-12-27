<?php 

require_once('../Model/Facturaciones.php');

$Registro = new Facturaciones();

$Nombre = $_POST['Nombre'];
$Documento = $_POST['Documento'];

$Registro->createCliente($Nombre, $Documento);

?>