<?php

require_once 'modelo/Correo.php';
//require_once "../../../../comun_tusprivilegios/configuracion.php";


class Correos
{
	
	/**
	* Modelo gestión de las campanias
	* @var object
	* @access private
	*/
	
	private $_modeloCampania = NULL;
	
	private $_idCampania = 0;
	
	
	public function __construct()
	{	
		$this->_modelo = new Correo();
	}
		
	public function getRequest( $request )
	{
		$data = array();
		
		if ( $request != '' ) {
			
			$arreglo = explode ('&',$request);
			
			foreach ($arreglo as $elemento) {
				list($item, $value) = explode ('=',$elemento);
				$data[$item] = urldecode($value);
			}
		}
		
		return $data;
	}	

	public function enviarCorreoCita( $data, $tarjetahabiente  )
	{
		return $this->_modelo->enviarCorreoCita( $data, $tarjetahabiente);
	}
	
		
	public function upperCaseTexto( $cadena = '' )
	{
		$cadenaFinal = '';
		
		//return $cadenaFinal = strtoupper($cadena);
		return strtr(strtoupper($cadena), array(
			'à' => 'À',
			'è' => 'È',
			'ì' => 'Ì',
			'ò' => 'Ò',
			'ù' => 'Ù',
			'á' => 'Á',
			'é' => 'É',
			'í' => 'Í',
			'ó' => 'Ó',
			'ú' => 'Ú',
			'â' => 'Â',
			'ê' => 'Ê',
			'î' => 'Î',
			'ô' => 'Ô',
			'û' => 'Û',
			'ç' => 'Ç',
			'ñ' => 'Ñ'
		));
	}
}

?>