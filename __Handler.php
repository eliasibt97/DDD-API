<?php
require_once("Perfil.php");

class Handler {

	private $handler;

	public function __construct() {
		$this->handler = new Perfil();
	}
	
	public function login($us, $pss, $tkn, $uuid) {
		return $this->handler->login($us,$pss, $tkn, $uuid);
	}
	
	public function getTransacciones($nth, $tkn, $desde, $hasta) {
		return $this->handler->getTransacciones($nth, $tkn, $desde, $hasta);
	}   	
	
	public function getRecompensas(array $data) {

		$p = $data['numeroTarjeta'];
		$t = $data['token'];
		$agencia = $data['agencia'];
		$esVitrina = $data['vitrina'];

		return $this->handler->getRecompensas($p, $t, $agencia, $esVitrina);

	}

	public function notFound() {
		return $this->handler->notFound();
	}
	
}
?>