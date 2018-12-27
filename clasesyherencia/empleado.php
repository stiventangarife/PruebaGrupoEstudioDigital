<!DOCTYPE html>
<html>
<head>
	<title>Formulario Persona</title>
</head>
<body>
	<form method="POST" action="Ejercicio/Controlador/RegistroEmpleado.php">
		<label>Nombre</label><br>
		<input type="text" name="Nombre" autocomplete="off" required="" placeholder="Nombre">
		<br>
		<label>Apellido</label><br>
		<input type="text" name="Apellido" autocomplete="off" required="" placeholder="Apellido">
		<br>
		<label>Fecha de Nacimiento</label><br>
		<input type="date" name="FechaNacimiento" autocomplete="off" required="" placeholder="Fecha">
		<br>
		<label>Cargo</label><br>
		<select name="Cargo">
			<option>Seleccione</option>
			<option value="Gerente">Gerente</option>
			<option value="Asesor">Asesor</option>
			<option value="Contador">Contador</option>
		</select>
		<br>
		<label>Fecha Ingreso</label><br>
		<input type="date" name="FechaIngreso" placeholder="Fecha Ingreso" autocomplete="off" required="">
		<br>
		<label>Salario Base</label><br>
		<input type="number" name="Salario" autocomplete="off" placeholder="Salario Base" required="">
		<br><br>
		<input type="submit" name="Enviar" value="Enviar">
	</form>
	<br>
	<a href="index.php">Ir a formulario Persona</a>
</body>
</html>