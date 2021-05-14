<?php

require_once 'modelo/Recompensa.php';
 
class Recompensas
{
	
	public function __construct()
	{	
		$this->_modelo = new Recompensa();
	}	

	public function selectRecompensas( $agencia, $isVitrina )
	{
		return $this->_modelo->selectRecompensas( $agencia, $isVitrina );
	}
	
}