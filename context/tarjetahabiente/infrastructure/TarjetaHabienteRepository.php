<?php
/**
*  Tarjetahabiente
*  Modelo gestión de la data de clientes con la base de datos.
*/

require 'context/tarjetahabiente/domain/TarjetaHabiente.php';
require_once 'context/tarjetahabiente/domain/TarjetaHabienteRepositoryInterface.php';

require_once('context/shared/DBConfig.php');

class TarjetaHabienteRepository implements TarjetaHabienteRepositoryInterface
{
	
	private $db;

	public function __construct()
	{
		$this->db = new DBConfig();
	}


	public function login($email, $password) {
		try {
			$query = $this->db->db_connect->prepare("SELECT IdTarjetaHabiente, IdAgencia, FechaAfiliacion, NumeroTarjeta, 
			NombreTarjetaHabiente, ApellidosTarjetaHabiente, Puntos, Email, uuid FROM tarjetahabiente
			WHERE Email = '$email' AND NumeroTarjeta = '$password'");
			$query->execute();

			$perfil = $query->fetch(PDO::FETCH_ASSOC);
			
			return TarjetaHabiente::fromArray($perfil);
		} catch(PDOException $e) {
			throw $e;
		} catch(Exception $d) {
			throw $d;
		}
	}

	public function updateUUID($idTarjetaHabiente, $uuid) {
		try {
			$query = $this->db->db_connect->prepare("UPDATE tarjetahabiente
			SET uuid = '$uuid' WHERE IdTarjetaHabiente = $idTarjetaHabiente");

			$query->execute();
			$perfil = $query->fetch(PDO::FETCH_ASSOC);

			return $perfil;
		} catch (PDOException $th) {
			throw $th;
		}
	}

}
