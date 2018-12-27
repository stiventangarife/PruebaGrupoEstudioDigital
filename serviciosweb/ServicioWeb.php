<?php
$servicio = simplexml_load_file("http://xml.tutiempo.net/xml/70140.xml");

echo "
<center>\n
	<h1>Servicio Web</h1>\n
	<table border='1' cellpading='10'>\n

	<tr><th>Pais</th><th>Ciudad</th><th>Fecha</th><th>Temp min</th><th>Temp max</th><th>Logo Estado</th><th>Estado</th><th>Humedad</th><th>Viento</th><th>Dirección</th><th>Logo Dirección</th><th>Salida Sol</th><th>Puesta Sol</th><th>Salida Luna</th><th>Puesta Luna</th><th>Fase Lunar</th></tr>\n

	<tr><td>".$servicio->localidad->pais."</td><td>".$servicio->localidad->nombre."</td><td>".$servicio->pronostico_dias->dia->fecha."</td><td>".$servicio->pronostico_dias->dia->temp_minima."</td><td>".$servicio->pronostico_dias->dia->temp_maxima."</td><td><img src=".$servicio->pronostico_dias->dia->icono."></img></td><td>".$servicio->pronostico_dias->dia->texto."</td><td>".$servicio->pronostico_dias->dia->humedad."</td><td>".$servicio->pronostico_dias->dia->viento."</td><td>".$servicio->pronostico_dias->dia->dir_viento."</td><td><img src=".$servicio->pronostico_dias->dia->ico_viento."></img></td><td>".$servicio->pronostico_dias->dia->salida_sol."</td><td>".$servicio->pronostico_dias->dia->puesta_sol."</td><td>".$servicio->pronostico_dias->dia->salida_luna."</td><td>".$servicio->pronostico_dias->dia->puesta_luna."</td><td><img src=".$servicio->pronostico_dias->dia->ico_fase_luna."></img></td></tr>\n
	
	</table>\n
</center>
";
?>