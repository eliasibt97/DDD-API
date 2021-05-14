<?php

require 'context/transaccion/domain/Transaccion.php';
require_once 'context/transaccion/domain/TransaccionRepositoryInterface.php';

require_once('context/shared/DBConfig.php');

class TransaccionRepository implements TransaccionRepositoryInterface
{	

	private $db;

	public function __construct(){
		if(!$this->db) $this->db = new DBConfig();
		return $this->db;
	}

	public function getTransacciones($numeroTarjeta, $desde, $hasta) {
		try {		
			$query = $this->db->db_connect->prepare("SELECT	
			FechaTransaccion, SaldoAntes , SaldoDespues, Concepto, ConceptoDos, 
			PuntosTotalesSumados, PuntosTotalesRedimidos
			FROM transaccion
			WHERE NumeroTarjeta = '$numeroTarjeta'
			AND FechaTransaccion >= '$desde' AND FechaTransaccion <= '$hasta'");
			
			$query->execute();

			$data = $query->fetchAll(PDO::FETCH_ASSOC);
			
			$transacciones = [];
			foreach($data as $transaccion) {
				array_push($transacciones, Transaccion::fromArray($transaccion));
			}
			
			return $transacciones;
		} catch(PDOException $e) {
			throw $e;
		}
	}
	
}
