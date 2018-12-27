<!DOCTYPE html>
<html>
<head>
	<title>Formulario Persona</title>
</head>
<body>
	<form method="POST" action="Ejercicio/Controlador/Registro.php">
		<label>Nombre</label><br>
		<input type="text" name="Nombre" autocomplete="off" required="" placeholder="Nombre">
		<br>
		<label>Apellido</label><br>
		<input type="text" name="Apellido" autocomplete="off" required="" placeholder="Apellido">
		<br>
		<label>Fecha de Nacimiento</label><br>
		<input type="date" name="FechaNacimiento" autocomplete="off" required="" placeholder="Fecha">
		<br><br>
		<input type="submit" name="Enviar" value="Enviar">
	</form>
	<br>
	<a href="empleado.php">Ir a formulario Empleado</a>
</body>
</html>