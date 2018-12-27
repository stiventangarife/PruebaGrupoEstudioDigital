<?php  

include('../Modelo/Persona.php');

$Modelo = new Persona();

$Modelo->setNombre($_POST['Nombre']);
$Modelo->setApellido($_POST['Apellido']);
$Modelo->setFechaNacimiento($_POST['FechaNacimiento']);

$JSon = new stdClass();
$JSon->nombre = $Modelo->getNombre();
$JSon->apellido = $Modelo->getApellido();
$JSon->fechaNacimiento = $Modelo->getFechaNacimiento();
$JSon->edad = $Modelo->edad();
$JSon->dias = $Modelo->diasproximocumpleanos();

$ResultJSon = json_encode($JSon);

echo $ResultJSon;
?>