<?php  

require_once('../Model/Facturaciones.php');

$Editar = new Facturaciones();

echo $Id = $_POST['Id'];
echo $Nombre = $_POST['Nombre'];
echo $Descripcion = $_POST['Descripcion'];
echo $Valor = $_POST['Valor'];

$Editar->updateProducto($Id, $Nombre, $Descripcion, $Valor);

?>