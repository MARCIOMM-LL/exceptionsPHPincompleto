<?php

#O parâmetro $classe mostra o caminho do namespace/caminho lógico
spl_autoload_register(function ($classe) {

    #O App\, caminho lógico, se refere a pasta src/caminho físico 
    $prefixo = "App\\";

    #A constante mágica __DIR__ traz o diretório/exceptionsphp do nosso projeto,
    #a contante DIRECTORY_SEPARATOR, colocar a barra certa para o sistema 
    #operacional e, a pasta src é trazida logo em seguida
    $diretorio = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;

    #A função strncmp() verifica a ocorrência dos primeiros caracteres, se os primeiros 
    #caracteres da váriavel $prefixo forem encontrados na variável $prefixo, ele vai 
    #procurar até a variável $prefixo, depois é usada a função strlen() para transformar
    #essa correspondência em números, se o resultado for diferente de 0 será retornado 
    #o valor correspondente a variável #prefixo
    if (strncmp($prefixo, $classe, strlen($prefixo)) !== 0) {
        return;
    }

    #A função substr() vai exibir somente depois de App em diante
    #Como a função substr() precisa de 2 parâmetros, o retorno 
    #precisa ser um inteiro 
    $namespace = substr($classe, strlen($prefixo));

    #É subtituída a barra para cada sistema operacional em $namespace
    $namespace_arquivo = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);

    #Aqui é carregado a variável $diretorio que contém a raíz do projeto/exceptionsphp
    #e a pasta src, que está concatenado com a variável $namespace_arquivo que contém
    #a inversão de barra para cada sistema operacional na variável $namespace
    $arquivo = $diretorio . $namespace_arquivo . '.php';

    #Se o arquivo que contém a classe existir, o arquivo é requirido.
    #Exemplo de arquivo, Validacao.php
    if (file_exists($arquivo)) {
        require $arquivo;
    }

});

