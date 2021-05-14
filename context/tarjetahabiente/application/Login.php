<?php

require_once 'context/tarjetahabiente/infrastructure/TarjetaHabienteRepository.php';

class Login {

    private $repository;

    public function __construct()
    {
        if(!$this->repository) $this->repository = new TarjetaHabienteRepository();
        return $this->repository;
    }

    public function run($email, $password) {
        return $this->repository->login($email, $password);
    }

}