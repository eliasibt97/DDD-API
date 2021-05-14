<?php

require 'context/noticia/infrastructure/NoticiaRepository.php';

class GetNoticias {

    private $repository;

    public function __construct()
    {
        if (!$this->repository) $this->repository = new NoticiaRepository;
        return $this->repository;
    }

    public function run($agenciaId, $numeroTarjeta) {
        return $this->repository->getNoticias($agenciaId, $numeroTarjeta);
    }
}