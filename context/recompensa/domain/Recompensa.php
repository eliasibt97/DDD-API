<?php

class Recompensa {

    public $id;
    public $descripcion;
    public $Valor;
    public $PuntosAsociados;
    public $imagen;

    public function __construct($id, $descripcion, $Valor, $PuntosAsociados, $imagen)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->Valor = $Valor;
        $this->PuntosAsociados = $PuntosAsociados;
        $this->imagen = $imagen;
    }

    public static function fromArray($recompensa) {
        return new Recompensa(
            $recompensa['IdRecompensaVitrina'],
            $recompensa['DescripcionRecompensaVitrina'],
            $recompensa['Valor'],
            $recompensa['PuntosAsociados'],
            $recompensa['imagen']
        );
    }
}