<?php

require_once 'context/recompensa/infrastructure/RecompensaRepository.php';

class GetRecompensas {
    
    private $repository;

    public function __construct()
    {
        if(!$this->repository) $this->repository = new RecompensaRepository();
        return $this->repository;
    }

    public function run($agenciaId, $esVitrina) {
        return $this->repository->getRecompensas($agenciaId, $esVitrina);
    }
}