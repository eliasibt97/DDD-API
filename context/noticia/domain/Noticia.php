<?php

class Noticia {
    public $nombre;
    public $fechaInicio;
    public $logotipo;
    public $asunto;
    public $puntos;

    public function __construct($nombre,$fechaInicio,$logotipo,$asunto,$puntos)
    {
        $this->nombre = $nombre;
        $this->fechaInicio = $fechaInicio;
        $this->logotipo = $logotipo;
        $this->asunto = $asunto;
        $this->puntos = $puntos;
    }

    public static function fromArray($noticia) {
        return new Noticia(
            $noticia['nombre'],
            $noticia['fechaInicio'],
            $noticia['logotipo'],
            $noticia['asunto'],
            $noticia['puntos']
        );
    }
}