<?php

class Transaccion {
    public $FechaTransaccion;
    public $SaldoAntes;
    public $SaldoDespues;
    public $Concepto;
    public $ConceptoDos;
    public $PuntosTotalesSumados;
    public $PuntosTotalesRedimidos;

    public function __construct($FechaTransaccion,$SaldoAntes,$SaldoDespues,$Concepto,$ConceptoDos,$PuntosTotalesSumados,$PuntosTotalesRedimidos)
    {
        $this->FechaTransaccion = $FechaTransaccion;
        $this->SaldoAntes = $SaldoAntes;
        $this->SaldoDespues = $SaldoDespues;
        $this->Concepto = $Concepto;
        $this->ConceptoDos = $ConceptoDos;
        $this->PuntosTotalesSumados = $PuntosTotalesSumados;
        $this->PuntosTotalesRedimidos  = $PuntosTotalesRedimidos;
    }

    public static function fromArray($transaccion) {
        return new Transaccion(
            $transaccion['FechaTransaccion'],
            $transaccion['SaldoAntes'],
            $transaccion['SaldoDespues'],
            $transaccion['Concepto'],
            $transaccion['ConceptoDos'],
            $transaccion['PuntosTotalesSumados'],
            $transaccion['PuntosTotalesRedimidos']
        );
    }
}