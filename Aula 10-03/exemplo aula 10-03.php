<?php

    date_default_timezone_set("America/Sao_Paulo");
    $data = date("d/m/Y H:i:s");// date("d/m/y h:i:s) -> dia mes ano com 2 digitos e horas minutos e sec
    echo "<p>Data: $data </p>";
    $valor = 1505.8888888;
    $valor_arredondado = round($valor);
    echo "<p>Valor: $valor_arredondado</p>";
    $valor_formatado = number_format($valor,2,",","."); 
    echo "<p> Valor sem formatação: $valor </p>";
    echo "<p> Valor formatado: $valor_formatado </p>";
    //Exponenciação
    $exp = pow(3,4);
    //Raiz quadrada
    $raiz = sqrt(16);
    //Números aleatórios
    $aleatorio = rand(1,100);
    if (isset($nome))
    {
        echo "<p> Nome informado! </p>";
    }
    else
    {
        echo "<p> Nome não informado! </p>";
        die();
    }
    if (is_float($valor))
    {
        echo "<p> É um número flutuante! </p>";
    }

?>