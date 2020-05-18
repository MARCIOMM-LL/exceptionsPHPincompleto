<?php

class ContaCorrente
{
	private $titular;
	public  $agencia;
	private $numero;
	private $saldo;

	#Atributos estáticos
	public static $totalDeContas;
	public static $taxaOperacao;

	#O método mágico __construct() é disparado assim que é criado um objeto
	public function __construct($titular, $agencia, $numero, $saldo)
	{
		$this->titular = $titular;
		$this->agencia = $agencia;
		$this->numero = $numero;
		$this->saldo = $saldo;

		#Bloco try() catch() para lançar exceções
		try{

			self::$taxaOperacao = intDiv(30, self::$totalDeContas);

		}catch(Error $e){

			echo "Não é possivel realizar divisão por zero.";
			exit;

		}

		#
		self::$totalDeContas ++;
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

	#O tipo ContaCorrente é também uma classe,
	#que nos dá acesso aos seus métodos
	public function transferir($valor, ContaCorrente $contaCorrente)
	{
		if(!is_numeric($valor)){ 
			echo "O valor passado não é um número válido!";
			exit;
		}

		$this->sacar($valor);
		$contaCorrente->depositar($valor);

		#O return $this serve para encadear métodos
		return $this;
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
