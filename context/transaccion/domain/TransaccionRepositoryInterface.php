<?php

interface TransaccionRepositoryInterface {
    function getTransacciones($numeroTarjeta, $desde, $hasta);
}