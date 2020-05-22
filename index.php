<?php
#Trecho de código pra reportar erros
 ini_set('display_errors',1);
 error_reporting(E_ALL);
 header('Content-Type: text/html; charset=utf-8');

 #Importação do arquivo autoload.php
require_once "autoload.php";

#Importação das classes
use App\Alura\Validacao;
use App\Alura\ContaCorrente;
use App\Alura\SaldoInsuficienteException;

echo "<pre>";

$contaJoao = new ContaCorrente("Joao","1212","343477-9",2000.00);
$contaMaria = new ContaCorrente("Maria","1212","343423-9",6000.00);
$contaJose = new ContaCorrente("Jose","1212","343423-9",6000.00);

#Exibindo o método __get
#echo "Nome do titular: " . $contaJoao->titular;

#Definindo o método __set
#echo $contaJoao->titular = "Márcio";

#Transfêrir 
#$contaJoao->transferir(20.00, $contaMaria);

#Encadiando métodos com o return $this nos métodos sacar() e depositar()
#echo $contaJoao->sacra(400.90)->depositar(30.9);

#Exibindo o número de contas criadas
#echo "O número total de contas criadas é: " . ContaCorrente::$totalDeContas;

#echo "<br>";

#Exibindo a taxa aplicada a cada uma das formas de movimento da conta
#echo "A taxa a ser paga é de: " . "$" . ContaCorrente::$taxaOperacao;

#echo "<h1>Contas Correntes</h1>";

#echo "<h2>Conta Corrente: Titular: " . $contaJoao->getTitular() . "</h2>";
#var_dump($contaJoao);

#Esse bloco try() exibe o resultado com sucesso, e catch() mostra 
#uma mensagem de erro semalhante ao bloco if()
try{
    #echo "<h3>Após uma Transferencia R$ 20</h3>";
    $contaJoao->transferir(5000, $contaMaria);
}catch(\InvalidArgumentException $erro){
    echo $erro->getMessage();
}catch(src\Alura\SaldoInsuficienteException $erro){
    echo $error->getMessage() . " <b>Saldo em conta: " . $erro-saldo . "valor do saque: " . $erro-valor . "</b>";

    $contaJoao->$totalDeSaquesNaoPermitidos++;

}catch(\Exception $erro){
    //var_dump($erro->getPrevious());
    echo $erro->getPrevious()->getTraceAsString();
    //echo "<b>" . $erro->getPrevious()->getMessage() . "</b>";
    //echo $erro->getMessage();
}

echo "<br>";
var_dump($contaJoao);

echo "<br>";
echo "<br>";
echo "<br>";
var_dump($contaMaria);

echo "Operações não realizadas: " . ContaCorrente::$operacaoNaoRealizada;