<?php

require 'modelo/Tarjetahabiente.php';

class Tarjetahabientes
{
	
	/**
	* Modelo gestión del tarjetahabiente
	* @var object
	* @access private
	*/
	
	private $_modeloTarjetahabiente;
	
	public function __construct()
	{	
		$this->_modeloTarjetahabiente = new Tarjetahabiente();
	}

	public function selectTHPorLogin( $password, $email )
	{
		return $this->_modeloTarjetahabiente->login( $password, $email );
	}
	
	public function traerEstadoDeCuenta( $p, $desde, $hasta )
	{
		return $this->_modeloTarjetahabiente->traerEstadoDeCuenta( $p, $desde, $hasta );
	}	
    	
	public function updateUUID($idTarjetaHabiente, $uuid)
	{
		return $this->_modeloTarjetahabiente->updateUUID($idTarjetaHabiente, $uuid);
	}
	
	public function verificarUsuario( $numeroTarjeta )
	{
		return $this->_modeloTarjetahabiente->verifyUser($numeroTarjeta);
	}

}