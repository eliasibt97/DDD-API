<?php

require_once 'SimpleRest.php';

class Response extends SimpleRest {

    private $INVALID_TOKEN;
    private $LOGIN_FAILED;
    private $SESSION_EXISTS;
    private $NO_RESULTS_FOUND;
    private $OK;
    private $NOT_FOUND;
    private $INTERNAL_ERROR;

    public function __construct(){
        $this->NOT_FOUND = ['success' => false, 'status' => "No encontrado", 'message' => "El recurso solicitado no está disponible"];
        $this->INVALID_TOKEN = ['success' => false, 'message' => 'Token not match'];
        $this->INTERNAL_ERROR = ['success' => false, 'message' => "Ocurrió un error al procesar la solicitud, por favor intente más tarde"];
        $this->LOGIN_FAILED = ['success' => false, 'message' => 'Error al iniciar sesión'];
        $this->SESSION_EXISTS = ['success' => false, 'message' => 'Ya has iniciado sesión en otro dispositivo'];
        $this->NO_RESULTS_FOUND = ['success' => false, 'message' => 'No se encontraron resultados'];
        $this->OK = ['success' => true, 'message' => 'OK'];
    }

    private function splitHTMLTagsFromResponse($data){
        // $data = strip_tags(json_encode($data));
        $data = strip_tags($data);
        return json_decode($data);
    }

    public function notFound() {
        
        self::setHttpHeaders('application/json', 404);
        return json_encode($this->NOT_FOUND);
    }

    public function invalidToken(){

        self::setHttpHeaders('application/json', 400);
        return json_encode($this->INVALID_TOKEN);
    }
    
    public function loginFailed(){
        
        self::setHttpHeaders('application/json', 401);
        return json_encode($this->LOGIN_FAILED);
    }
    
    public function sessionExists(){
        
        self::setHttpHeaders('application/json', 401);
        return json_encode($this->SESSION_EXISTS);
    }
    
    public function noResultsFound(){
        
        self::setHttpHeaders('application/json', 200);
        return json_encode($this->NO_RESULTS_FOUND);
    }
    
    public function ok($collection_name, $data){
        
        self::setHttpHeaders('application/json', 200);
        $newResponse = array_merge($this->OK, [$collection_name => $data]);
        return json_encode($newResponse);
    }

    public function error($message = ""){
        
        self::setHttpHeaders('application/json', 500);
        return json_encode($this->INTERNAL_ERROR);
    }
    
    // Exclusive responses for PromoZone API V1
    public function allRight($collection_name, $data) {

        $data = $this->splitHTMLTagsFromResponse($data);

        self::setHttpHeaders('application/json', 200);
        return json_encode(['success' => true, 'message' => 'OK', $collection_name => $data]);
    }

}