<?php
$numeros = [10, 3, 5, 2, 17];
$menorValor = $numeros[0];
$posicao = 0;

for ($i = 0; $i < count($numeros ); $i++) {
    if($numeros[$i] < $menorValor){
        $menorValor = $numeros[$i];
        $posicao = $i;
    }

}
echo "Menor valor : $menorValor";
echo "Posição do menor valor: $posicao";
?>