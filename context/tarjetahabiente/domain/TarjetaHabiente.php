<?php

class TarjetaHabiente {
    public $id;
    public $IdAgencia;
    public $FechaAfiliacion;
    public $NumeroTarjeta;
    public $NombreTarjetaHabiente;
    public $ApellidosTarjetaHabiente;
    public $Puntos;
    public $Email;
    public $uuid;

    public function __construct($id,$IdAgencia, $FechaAfiliacion,$NumeroTarjeta,$NombreTarjetaHabiente,
                                $ApellidosTarjetaHabiente,$Puntos,$Email,$uuid)
    {
        $this->id = $id;
        $this->IdAgencia = $IdAgencia;
        $this->FechaAfiliacion = $FechaAfiliacion;
        $this->NumeroTarjeta = $NumeroTarjeta;
        $this->NombreTarjetaHabiente = $NombreTarjetaHabiente;
        $this->ApellidosTarjetaHabiente = $ApellidosTarjetaHabiente;
        $this->Puntos = $Puntos;
        $this->Email = $Email;
        $this->uuid = $uuid;
    }

	public static function fromArray($tarjetaHabiente) {
		return new TarjetaHabiente(
			$tarjetaHabiente['IdTarjetaHabiente'],
			$tarjetaHabiente['IdAgencia'],
			$tarjetaHabiente['FechaAfiliacion'],
			$tarjetaHabiente['NumeroTarjeta'],
			$tarjetaHabiente['NombreTarjetaHabiente'],
			$tarjetaHabiente['ApellidosTarjetaHabiente'],
			$tarjetaHabiente['Puntos'],
			$tarjetaHabiente['Email'],
			$tarjetaHabiente['uuid']
		); 
	}   
    
}