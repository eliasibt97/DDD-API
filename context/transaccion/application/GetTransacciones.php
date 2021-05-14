<?php

require_once 'context/transaccion/infrastructure/TransaccionRepository.php';

class GetTransacciones {

    private $repository;

    public function __construct()
    {
        if(!$this->repository) $this->repository = new TransaccionRepository();
        return $this->repository;
    }

    public function run($numeroTarjeta, $desde, $hasta) {
        return $this->repository->getTransacciones($numeroTarjeta, $desde, $hasta);
    }
}