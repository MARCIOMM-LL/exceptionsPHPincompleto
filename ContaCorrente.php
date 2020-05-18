<?php

class ContaCorrente
{
	private $titular;
	public  $agencia;
	private $numero;
	private $saldo;

	public static $totalDeContas;
	public static $taxaOperacao;

	public function __construct($titular, $agencia, $numero, $saldo)
	{
		$this->titular = $titular;
		$this->agencia = $agencia;
		$this->numero = $numero;
		$this->saldo = $saldo;

		try{

			self::$taxaOperacao = intDiv(30, self::$totalDeContas);

		}catch(Error $e){

			echo "Não é possivel realizar divisão por zero.";
			exit;

		}

		self::$totalDeContas ++;
	}

	public function __get($atributo)
	{

		Validacao::protegeAtributo($atributo);

		return $this->$atributo;

	}


	public function __set($atributo, $valor)
	{

		Validacao::protegeAtributo($atributo);

		$this->$atributo = $valor;

	}

	public function transferir($valor, ContaCorrente $contaCorrente)
	{

		if(!is_numeric($valor)){ 

			echo "o Tipo passado nao é um numero valido!";
			exit;

		}

		$this->sacar($valor);

		$contaCorrente->depositar($valor);

		return $this;
	}

	public function getTitular()
	{
		return $this->titular;
	}

	public function sacar($valor)
	{ 

		Validacao::verificaNumerico($valor);

		$this->saldo = $this->saldo - $valor;
		return $this;

	}

	public function depositar($valor)
	{
		Validacao::verificaNumerico($valor);

		$this->saldo = $this->saldo + $valor;
		return $this;
	}

	public function setNumero($numero)
	{
		return $this->numero = $numero;
	}

	private function formataSaldo()
	{
		return "R$ " . number_format($this->saldo, 2, ",", ".");
	}

	public function getSaldo()
	{
		return $this->formataSaldo();
	}

	public function __toString()
	{
		return $this->saldo;
	}

}
