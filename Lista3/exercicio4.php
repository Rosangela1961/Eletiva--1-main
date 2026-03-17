<?php
$valorProduto = 110;
if($valorProduto > 100){
    $desconto = $valorProduto * 15 / 100;
    $novoValor = $valorProduto - $desconto;
    echo "O novo valor do produto é: $novoValor";
}else{
    echo "O produto não atingiu o valor mínimo para desconto";
}