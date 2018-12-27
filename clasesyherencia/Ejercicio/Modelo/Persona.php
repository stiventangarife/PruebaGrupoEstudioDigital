<?php  

class Persona
{
	private $nombre;
	private $apellido;
	private $fechaNacimiento;

	public function getNombre()
	{
		return $this->nombre;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function getApellido()
	{
		return $this->apellido;
	}

	public function setApellido($apellido)
	{
		$this->apellido = $apellido;
	}

	public function getFechaNacimiento()
	{
		return $this->fechaNacimiento;
	}

	public function setFechaNacimiento($fechaNacimiento)
	{
		$this->fechaNacimiento = $fechaNacimiento;
	}

	public function __construct()
	{

	}

	public function edad()
	{
		$nacimiento = new DateTime($this->fechaNacimiento);
	    $fechaActual = new DateTime();
	    $edad = $fechaActual->diff($nacimiento);
	    return $edad->y;
	}

	public function diasproximocumpleanos()
	{
		$fechaNacimiento = strtotime($this->fechaNacimiento);

		$yearNacimiento = date('Y', $fechaNacimiento);
		$mesNacimiento = date('m', $fechaNacimiento);
		$diaNacimiento = date('d', $fechaNacimiento);

		$fechaActual = strtotime(date('Y-m-d'));

		$yearActual = date('Y', $fechaActual);
		$mesActual = date('m', $fechaActual);
		$diaActual = date('d', $fechaActual);

		$fechaNueva = (12-$mesActual)+$mesNacimiento;
		$diasRestantes = (30-$diaActual)+$diaNacimiento;
		
		return $total = ($fechaNueva*30)+$diasRestantes;
	}
}

?>