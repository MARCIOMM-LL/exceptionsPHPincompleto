<?php

class Validacao
{

	public static function protegeAtributo($atributo)
	{

		#Se tentarem acessar o nome do titular e o saldo do titular,
		#com essa validação não será possível acessar 
		if($atributo == "titular" || $atributo == "saldo"){

			throw new Exception("O atributo $atributo continua privado.");

		}

	}

	public static function verificaNumerico($valor)
	{

		#Se não for um numérico, será lançada uma exceção
		if(!is_numeric($valor)){

			throw new Exception("O Tipo passado nao é um número válido.");
			
		}

	}

}
