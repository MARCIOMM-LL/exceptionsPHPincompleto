<?php

class LeitorArquivo
{
    private $arquivo;

    public function __construct($arquivo)
    {
        $this->arquivo = $arquivo;
    }

    public function abrirArquivo()
    {
        echo "Abrindo arquivo <br />";
    }

    public function lerArquivo()
    {
        echo "lendo arquivo <br />";
    }

    public function escreverNoArquivo()
    {
        echo "Escrevendo no arquivo <br />";
    }

    public function fecharArquivo()
    {
        echo "Fechando arquivo <br />";
    }
}

