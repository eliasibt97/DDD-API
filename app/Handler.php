<?php

	require_once('context/shared/Response.php');

	require_once 'context/tarjetahabiente/application/Login.php';
	require_once 'context/tarjetahabiente/application/UpdateUuid.php';
	require_once 'context/transaccion/application/GetTransacciones.php';
	require_once 'context/recompensa/application/GetRecompensas.php';
	require_once 'context/noticia/application/GetNoticias.php';

class Handler {

	private $loginAction;
	private $uuidAction;
	private $getTransaccionAction;
	private $getRecompensasAction;
	private $response;
	private $getNoticiasAction;

	public function __construct(){
		if(!$this->loginAction) $this->loginAction = new Login();
		if(!$this->uuidAction) $this->uuidAction = new UpdateUuid();
		if(!$this->response) $this->response = new Response();
		if(!$this->getTransaccionAction) $this->getTransaccionAction = new GetTransacciones();
		if(!$this->getRecompensasAction) $this->getRecompensasAction = new GetRecompensas();
		if(!$this->getNoticiasAction) $this->getNoticiasAction = new GetNoticias();
	}

	private function validateToken($token, $password) {
		return $token == sha1($password."u420qwd");
	}

    public function login($email, $password, $token, $uuid){	
	    
		if( !$this->validateToken($token, $password) ) return $this->response->invalidToken();
							
		$tarjetahabiente = $this->loginAction->run($email, $password);
										
		if ( !$tarjetahabiente ) return $this->response->loginFailed();

		$id = $tarjetahabiente->id;
		
		$tarjetahabiente->uuid = is_null($tarjetahabiente->uuid) ? $this->uuidAction->run($id,$uuid) : $tarjetahabiente->uuid;

		if( $tarjetahabiente->uuid !== $uuid ) return $this->response->sessionExists();

		return $this->response->ok('usuario', $tarjetahabiente);
	}
	
	public function getTransacciones($numeroTarjeta,$tkn, $desde, $hasta){
				
		if( !$this->validateToken($tkn, $numeroTarjeta) ) return $this->response->invalidToken();
		
		$transacciones = [];
		$transacciones = $this->getTransaccionAction->run($numeroTarjeta,$desde,$hasta);
		
		if (empty($transacciones) || count($transacciones) <= 0) return $this->response->noResultsFound();
		
		return $this->response->ok('transacciones', $transacciones);
	}
	
	public function getRecompensas($numeroTarjeta, $token, $agenciaId, $esVitrina) {
		
		if( !$this->validateToken($token, $numeroTarjeta) ) return $this->response->invalidToken();

		$recompensas = $this->getRecompensasAction->run($agenciaId, $esVitrina);

		if(!$recompensas) return $this->response->noResultsFound();

		return $this->response->ok('recompensas', $recompensas);
	}

	public function getNoticias($numeroTarjeta, $token, $agenciaId) {
		if(!$this->validateToken($token, $numeroTarjeta)) return $this->response->invalidToken();

		$noticias = $this->getNoticiasAction->run($agenciaId, $numeroTarjeta);
		
		if(!$noticias) return $this->response->noResultsFound();

		return $this->response->ok('noticias', $noticias);
	}

	public function notFound() {
		return $this->response->notFound();
	}
}
