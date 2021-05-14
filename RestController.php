<?php

ini_set('display_errors', 1);

if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	exit(0);
}

$view = ltrim( $_SERVER['PATH_INFO'] , '/'); 

$inputJSON = file_get_contents('php://input');    
$data = json_decode($inputJSON, TRUE);
if($data == NULL){
	$data = $_POST;
}

require "app/Handler.php";
require_once("PromoZone.php");

$handler = new Handler();

/**
 * @author Eliasib Toriz
 */
switch($view){
	
	case "login":
		$perfil = $handler->login($data['email'], $data['password'], $data['token'], $data['uuid']);
		echo $perfil;
		break;	
	
	case "transacciones":
		$perfil = $handler->getTransacciones($data["numeroTarjeta"], $data["token"], $data['desde'],$data['hasta']);
		echo $perfil;
		break;
	
	case "recompensas":
        $recompensas = $handler->getRecompensas($data['numeroTarjeta'], $data['token'], $data['agencia'], $data['vitrina']);
		echo $recompensas;
        break;

	case "noticias":
		$noticias = $handler->getNoticias($data['numeroTarjeta'], $data['token'], $data['agencia']);
		echo $noticias;
		break;

	case "establecimiento":
		$promozone = new PromoZone();
		$branchInfo = $promozone->obtenerEstablecimiento($data['id']);
		echo $branchInfo;
		break;

	default:
		$response = $perfilRestHandler->notFound();
		echo $response;
		break;
}
?>
