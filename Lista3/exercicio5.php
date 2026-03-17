<?php
$mes = 4;

switch($mes){
    case 1 :
        echo "1 - Janeiro";
    case 2:
        echo "2 - Fevereiro";
    case 3:
        echo "3 - Março";
    case 4:
        echo "4 - Abril";
    case 5:
        echo "5 - Maio";
    case 6:
        echo "6 - Junho";
    case 7:
        echo "7 - Julho";
    case 8:
        echo "8 - Agosto";
    case 9:
        echo "9 - Setembro";
    case 10:
        echo "10 - Outubro";
    case 11:
        echo "11 - Novembro";
    case 12:
        echo "12 - Dezembro";
        break;
    default:
        echo "Valor inválido! Digite um número de entre 1 e 12.";
        break;   

}
?>