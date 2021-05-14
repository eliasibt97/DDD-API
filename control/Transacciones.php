<?php

require_once 'modelo/Transaccion.php';
 
class Transacciones
{
	
	private $_modelo;	
	
	public function __construct()
	{	
		$this->_modelo = new Transaccion();
	}

	public function obtenerTransacciones($pass, $desde, $hasta)
	{
		return $this->_modelo->getTransactions($pass, $desde, $hasta);
	}

}

?>