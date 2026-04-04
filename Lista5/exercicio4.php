<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 4</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 4</h1>
<form method="post">
    <?php for($i = 1; $i <= 5; $i++){ ?>
<div class="mb-3">
              <label for="nome" class="form-label">Digite o nome do item<?php echo $i;?></label>
              <input type="text" id="nome" name="nome[]" class="form-control" required="">
            </div><div class="mb-3">
              <label for="valor" class="form-label">Digite o preço do item<?php echo $i?></label>
              <input type="number" step="0.01 " id="valor" name="valor[]" class="form-control" required="">
</div>
<?php } ?>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if($_POST){

    $nomes = $_POST["nome"];
    $precos = $_POST["valor"];

    $mapa = array();

    for($i = 0; $i < count($nomes); $i++){
        $precoComImposto = $precos[$i] * 1.15;
        $mapa[$nomes[$i]] = $precoComImposto;
    }

    echo "<h4>Mapa original:</h4>";
    print_r($mapa);

    echo "<hr>";

    asort($mapa);

    echo "<h4>Itens ordenados por preço (com imposto):</h4>";

    echo "<table class='table table-striped'>";
    echo "<tr><th>Nome</th><th>Preço com imposto</th></tr>";

    foreach($mapa as $chave => $valor){
        echo "<tr>";
        echo "<td>$chave</td>";
        echo "<td>R$ " . number_format($valor, 2, ',', '.') . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "<p>Qtd. elementos: " . count($mapa) . "</p>";
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>