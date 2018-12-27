<?php  

include('Persona.php');

class Empleado extends Persona
{
	private $cargo;
	private $fechaIngreso;
	private $salario;

	public function getCargo()
	{
		return $this->cargo;
	}

	public function setCargo($cargo)
	{
		$this->cargo = $cargo;
	}

	public function getFechaIngreso()
	{
		return $this->fechaIngreso;
	}

	public function setFechaIngreso($fechaIngreso)
	{
		$this->fechaIngreso = $fechaIngreso;
	}

	public function getSalario()
	{
		return $this->salario;
	}

	public function setSalarioBase($salario)
	{
		$this->salario = $salario;
	}

	public function duracionContrato()
	{
		$ingreso = new DateTime($this->fechaIngreso);
	    $fechaActual = new DateTime();
	    $duracion = $fechaActual->diff($ingreso);
	    return $duracion->y;
	}

	public function salarioNeto()
	{
		$duracion = self::duracionContrato();
		$edad = parent::edad();

		$bonoDuracion = $duracion < 3 ? $this->salario * 0.20: $this->salario * 0.40; 
		$bonoEdad = $edad > 30 ? 100000: 0;
		return $this->salario + $bonoDuracion + $bonoEdad;
	}
}

?>