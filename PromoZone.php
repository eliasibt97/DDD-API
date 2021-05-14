<?php

require_once('context/shared/Response.php');

class PromoZone {

    private $API_URL = "https://api.promo-zone.com.mx/v1/establecimientos/";
    private $response;

    public function __construct() {
        if(!$this->response) $this->response = new Response();
        return $this->response;
    }

    public function obtenerEstablecimiento($id) {
        try {
            $url = $this->API_URL."$id";
            $curl = curl_init();
            $opciones = [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => 1
            ];

            curl_setopt_array($curl, $opciones);
            $respuesta = curl_exec($curl);

            curl_close($curl);
            if( !$respuesta ) return $this->response->noResultsFound();

            // $data = json_decode($respuesta);
            
            return $this->response->allRight('establecimiento', $respuesta);
        } catch(Exception $e) {
            return $this->response->error();
        }
    }  


}