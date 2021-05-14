<?php

interface TarjetaHabienteRepositoryInterface {
    function login($email, $password);
    function updateUUID($idTarjetaHabiente, $uuid);
}