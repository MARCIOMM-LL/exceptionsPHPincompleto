<?php

#O namespace específica a estrutura física de
#até as classes que desejamos carregar 
namespace App\Alura;

#Importação de classes que são herdadas
#use Exception;

#A barra invertida na classe Exception serve para ela procurar 
#essa classe nas bibliotecas do php, uma vez que essa classe não
#foi criada por mim e não está no meu diretório. uma outra alternativa
#seria usar o use Exception
class SaldoInsuficienteException extends \Exception
{
    private $valor;
    private $saldo;

    public function __construct($mensagem, $valor, $saldo)
    {
        $this->valor = $valor;
        $this->saldo = $saldo;

        #Chamando o __construct da classe Exception através do parent
        parent::__construct($mensagem, null, null);
    }

    public function __get($param)
    {
        return $this->$param;
    }
}