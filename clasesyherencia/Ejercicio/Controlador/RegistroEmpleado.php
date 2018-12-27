<?php  

include('../Modelo/Empleado.php');

$Modelo = new Empleado();

$Modelo->setNombre($_POST['Nombre']);
$Modelo->setApellido($_POST['Apellido']);
$Modelo->setFechaNacimiento($_POST['FechaNacimiento']);
$Modelo->setCargo($_POST['Cargo']);
$Modelo->setFechaIngreso($_POST['FechaIngreso']);
$Modelo->setSalarioBase($_POST['Salario']);

$JSon = new stdClass();
$JSon->nombre = $Modelo->getNombre();
$JSon->apellido = $Modelo->getApellido();
$JSon->fechaNacimiento = $Modelo->getFechaNacimiento();
$JSon->edad = $Modelo->edad($Modelo->getFechaNacimiento());
$JSon->cargo = $Modelo->getCargo();
$JSon->fechaIngeso = $Modelo->getFechaIngreso();
$JSon->salario = $Modelo->getSalario();
$JSon->salarioNeto = $Modelo->salarioNeto();

$ResultJSon = json_encode($JSon);

echo $ResultJSon;

?>