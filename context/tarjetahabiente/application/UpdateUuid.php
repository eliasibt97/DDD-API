<?php

require_once('context/tarjetahabiente/infrastructure/TarjetaHabienteRepository.php');

class UpdateUuid {

    private $repository;

    public function __construct()
    {
        if(!$this->repository) $this->repository = new TarjetaHabienteRepository();
        return $this->repository;
    }

    public function run($idTarjetaHabiente, $uuid) {
        return $this->repository->updateUUID($idTarjetaHabiente, $uuid);
    }
}