<?php

namespace App\Alura;

use App\Alura\SaldoInsuficienteException;
use App\Alura\OperacaoNaoRealizadaException;

class ContaCorrente
{
	private $titular;
	public  $agencia;
	private $numero;
	private $saldo;

	#Atributos estáticos
	public static $totalDeContas;
	public static $taxaOperacao;

	private $totalDeSaquesNaoPermitidos;

	public static $operacaoNaoRealizada;

	#O método mágico __construct() é disparado assim que é criado um objeto
	public function __construct($titular, $agencia, $numero, $saldo)
	{
		$this->titular = $titular;
		$this->agencia = $agencia;
		$this->numero = $numero;
		$this->saldo = $saldo;

		#Atributo estático que incrementa 1 valor sempre que um objeto for criado
		ContaCorrente::$totalDeContas ++;

		#Bloco try() catch() para lançar exceções
		try{

			#Para cada uma das opções do movimento financeiro no
			#banco, são aplicadas taxas. Uma taxa para o saque,
			#depósito e transfência. A função intdiv() retorna 
			#um inteiro entre a divisão dos dois valores
			if(ContaCorrente::$totalDeContas < 1){
				throw new Exception("O número de contas é inferior 0!");
			}
			
			ContaCorrente::$taxaOperacao = (30 / ContaCorrente::$totalDeContas);

		}
		#No php temos 2 classes para lançar exceções que são
		#as classe Error e Exception que retornan mensagens
		#de erros diferentes. A classe error() é uma classe 
		#de erros personalizados, e a classe exception é uma
		#classe de erros específicos da classe
		catch(Exception $erro){
			echo $erro->getMessage();
			exit;
		}

	}

	#O método mágico __get() é disparado sempre que qualquer atributos da classe
	#é acessado, seja ele privado ou não, reparar no detalhe do $ junta da 
	#palavra reservada $this, ela significa que estamos acessando os atributos 
	#com um método mágico __get() ou __set(). Essa técnica é chamada de 
	# overloading/sobrecarga
	public function __get($atributo)
	{
		#Fazendo a validação do nome e saldo do titular
		#através do método estático da classe Validacao()
		Validacao::protegeAtributo($atributo);

		return $this->$atributo;
	}

	#O método mágico __set() está setando o valor de qualquer  
	#atributo da classe, seja ele privado ou não
	public function __set($atributo, $valor)
	{
		Validacao::protegeAtributo($atributo);

		$this->$atributo = $valor;
	}

	#O tipo ContaCorrente é também uma classe, que nos dá acesso aos seus métodos
	#O tipo ContaCorrente serve para declarar uma instância de ContaCorrente
	public function transferir($valor, ContaCorrente $contaCorrente)
	{
		/*
		#Estrutura if() verificando se o $valor é numérico
		if(!is_numeric($valor)){ 
			throw new InvalidArgumentException("O valor passado não é um número.");
		}

		#Estrutura if() inpedindo a transferência de valores negativos
		if ($valor < 0) {

			#No php exceptions temos algumas classes para o tratamento de erros além
			#das classes error() e exception(), como por exemplo a classe demonstrada abaixo
			#que é muito utilizada nos parâmetros errados
			throw new Exception("Não é permitido a transferência de valores negativos.");
		}

		$this->sacar($valor);
		$contaCorrente->depositar($valor);

		#O return $this serve para encadear métodos
		return $this;
		*/

		try{
			$arquivo = new LeitorArquivo("logTransferencia.txt");

			$arquivo->abrirArquivo();
			$arquivo->escreverNoArquivo();

			Validacao::verificaNumerico($valor);

			Validacao::verificaValorNegativo($valor);

			$this->sacar($valor);

			$contaCorrente->depositar($valor);

			$arquivo->fecharArquivo();

			return $this;

		}catch(\Exception $e){

			ContaCorrente::$operacaoNaoRealizada ++;
			throw new \exception\OperacaoNaoRealizadaException("Operação não realizada", 55,$e);

		}finally{
			echo "Finally";
			$arquivo->fecharArquivo();

		}
	}

	#Método getTitular() para não acessar diretamente o atributo $titular
	public function getTitular()
	{
		#Retornando o atributo $titular
		return $this->titular;
	}

	#Método sacar()
	public function sacar($valor)
	{ 
		#Validação que se certifica se o valor é numérico
		Validacao::verificaNumerico($valor);

		if($valor > $this->saldo){

			#Lançando a minha própria exception
			throw new SaldoInsuficienteException("Saldo insuficiente.",
		                                         $valor, $this->saldo);
		}

		$this->saldo -= $valor;
		return $this;
	}

	public function depositar($valor)
	{
		#Validação que se certifica que o atributo 
		#nome e saldo não sejam acessados diretamente
		Validacao::verificaNumerico($valor);

		$this->saldo += $valor;
		return $this;
	}

	#Setando o número da conta
	public function setNumero($numero)
	{
		return $this->numero = $numero;
	}

	#Colocando uma máscara de formato no saldo
	private function formataSaldo()
	{
		#Função number_format() adicionando máscara da formato de saldo
		return "R$ " . number_format($this->saldo, 2, ",", ".");
	}

	#Método que retorna o saldo
	public function getSaldo()
	{
		return $this->formataSaldo();
	}

	#O método __toString() é chamado quando tentamos exibir 
	#um objeto (converter um objeto em string).
	public function __toString()
	{
		#O método __toString() é chamado quando tentamos exibir 
		#um objeto (converter um objeto em string).
		return (string) $this->saldo;
	}

}
