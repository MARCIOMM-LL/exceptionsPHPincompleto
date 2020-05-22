<?php

namespace App\Alura;

class Validacao
{

	#Método estático
	public static function protegeAtributo($atributo)
	{

		#Se tentarem acessar o nome do titular e o saldo,
		#com essa validação não será possível acessar 
		#Com a validação nem os métodos mágicos __get() 
		#e __set() conseguem acessar também  
		if($atributo == "titular" || $atributo == "saldo"){

			throw new Exception("O atributo $atributo continua privado.");

		}

	}

	public static function verificaNumerico($valor)
	{

		#Se não for um numérico, será lançada uma exceção
		if(!is_numeric($valor)){

			throw new InvalidArgumentException("O Tipo passado nao é um número válido.");
			
		}

	}

}
