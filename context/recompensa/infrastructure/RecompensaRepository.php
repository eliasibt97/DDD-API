<?php
/**
*  Recompensa
*  Modelo gestión de la data de clientes con la base de datos.
*/

require 'context/recompensa/domain/Recompensa.php';
require 'context/recompensa/domain/RecompensaRepositoryInterface.php';

require_once('context/shared/DBConfig.php');

class RecompensaRepository implements RecompensaRepositoryInterface
{
	
	private $db;

	public function __construct()
	{
		$this->db = new DBConfig();
	}
		
	public function getRecompensas( $agenciaId, $isVitrina )
	{		
		$query = $this->db->db_connect->prepare("SELECT r.IdRecompensaVitrina AS id, r.DescripcionRecompensaVitrina, r.Valor, r.PuntosAsociados,
			CONCAT('https://www.misrecompensas.com.mx/MOC/AGENCIA/agregar/imgrecvitrina/',ri.Imagen) as imagen
			FROM recompensavitrina r
			INNER JOIN recompensaimagen ri ON r.IdRecompensaVitrina = ri.IdRecompensa
			WHERE r.IdAgencia = $agenciaId AND ri.DeVitrina = $isVitrina");
		$query->execute();
		$data = $query->fetch(PDO::FETCH_ASSOC);
		if(!$data) return [];

		$recompensas = [];
		foreach($data as $recompensa) {
			array_push($recompensas, Recompensa::fromArray($recompensa));
		}
		
		return $recompensas;		
	
	}

}
