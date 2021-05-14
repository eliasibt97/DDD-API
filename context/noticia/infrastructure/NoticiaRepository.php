<?php

require_once 'context/shared/DBConfig.php';
require 'context/noticia/domain/NoticiaRepositoryInterface.php';
require 'context/noticia/domain/Noticia.php';

class NoticiaRepository implements NoticiaRepositoryInterface
{
	private $db;
	
	public function __construct()
	{
		if(!$this->db) $this->db = new DBConfig();
		return $this->db;
	}		

	public function getNoticias($agenciaId, $numeroTarjeta)
	{		
	try{
		$query = $this->db->db_connect->prepare("SELECT
			c.NombreCampania AS nombre, c.FechaInicioEnvio AS fechaInicio, c.PuntosPorClick as puntos, c.Asunto as asunto,
			CASE WHEN ic.RutaImagen IS NULL OR ic.RutaImagen = ''
			THEN CONCAT('https://tusprivilegios.com/RETAIL/GARAGE290/imagenes/default.png')
			ELSE CONCAT('https://tusprivilegios.com/AGENCIA/GARAGE290/SUCURSAL/', REPLACE(ic.RutaImagen, '../',''))
			END AS logotipo
			FROM campania c
			INNER JOIN imagencampania ic ON ic.IdCampania = c.IdCampania
			WHERE c.IdAgencia = $agenciaId AND c.Estatus = 2");
		$query->execute();

		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		if(!$data) return [];

		$noticias = [];
		foreach($data as $noticia) {
			array_push($noticias, Noticia::fromArray($noticia));
		}

		return $noticias;

		} catch(PDOException $e){			
			throw $e->getMessage();
		} catch(Exception $e) {			
			throw $e->getMessage();
		}	
	}
	
	public function searchArray($value, $key, $array) {
       foreach ($array as $k => $val) {
           if ($val[$key] == $value) {
               return $k;
           }
       }
       return null;
    }
	
	function orderArray($a, $b) {
        
		$date1 = strtotime($a['fecha_order'].' 00:00:00');
        $date2 = strtotime($b['fecha_order'].' 00:00:00');
        //echo $date1 .''.$date2;
		if ($date1 < $date2) return 1;
        if ($date1 == $date2) return 0;
        if ($date1 > $date2) return -1;
		//return strcmp($a['fecha_order'], $b['fecha_order']);
    }
	
}
