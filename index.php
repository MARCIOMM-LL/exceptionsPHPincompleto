<?php
#Trecho de código pra reportar erros
 ini_set('display_errors',1);
 error_reporting(E_ALL);
 header('Content-Type: text/html; charset=utf-8');

require "Validacao.php";
require "ContaCorrente.php";

$contaJoao = new ContaCorrente("Joao","1212","343477-9",2000.00);
$contaMaria = new ContaCorrente("Maria","1212","343423-9",6000.00);
$contaJose = new ContaCorrente("Jose","1212","343423-9",6000.00);

#Exibindo o método __get
#echo $contaJoao->titular;

#Definindo o método __set
#echo $contaJoao->titular = "Márcio";

#Transfêrir 
#$contaJoao->transferir(20.00, $contaMaria);

#Encadiando métodos com o return $this nos métodos sacar() e depositar()
#echo $contaJoao->sacra(400.90)->depositar(30.9);


echo ContaCorrente::$totalDeContas;

echo "<br>";

echo ContaCorrente::$taxaOperacao;

echo "<h1>Contas Correntes</h1>";

echo "<h2>Conta Corrente: Titular: ".$contaJoao->getTitular()."</h2>";
var_dump($contaJoao);

echo "<h3>Após uma Transferencia R$ 20</h3>";
$contaJoao->transferir(20, $contaMaria);

var_dump($contaJoao);