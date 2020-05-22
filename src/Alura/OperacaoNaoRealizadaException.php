<?php

namespace App\Alura;

class OperacaoNaoRealizadaException extends \Exception
{
    public function __construct($mensagem,$codigo,$ex)
    {
        parent::__construct($mensagem,$codigo,$ex);
    }

    public function __toString()
    {
        return $this->getCode() . ":" . $this->getMessage();
    }

}
