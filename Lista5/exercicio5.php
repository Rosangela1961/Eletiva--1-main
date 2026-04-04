<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 5</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body> 
<div class="container py-3">

<h1>Exercício 5</h1>

<form method="post">

<?php for($i = 1; $i <= 5; $i++){ ?>

    <div class="mb-3">
        <label for="titulo<?php echo $i; ?>" class="form-label">
            Digite o nome do livro <?php echo $i; ?>
        </label>
        <input type="text" id="titulo<?php echo $i; ?>" name="titulo[]" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="numero<?php echo $i; ?>" class="form-label">
            Digite a quantidade em estoque <?php echo $i; ?>
        </label>
        <input type="number" id="numero<?php echo $i; ?>" name="numero[]" class="form-control" required>
    </div>

<?php } ?>

<button type="submit" class="btn btn-primary">Enviar</button>

</form>

<hr>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $titulos = $_POST['titulo'];
    $quantidades = $_POST['numero'];

    $mapa = array();


    for($i = 0; $i < count($titulos); $i++){
        $mapa[$titulos[$i]] = $quantidades[$i];
    }

    echo "<h4>Mapa original:</h4>";
    print_r($mapa);

    echo "<hr>";

    
    ksort($mapa);

    echo "<h4>Lista de livros ordenada por título:</h4>";

    echo "<table class='table table-bordered'>";
    echo "<tr><th>Título</th><th>Quantidade</th></tr>";

    foreach($mapa as $chave => $valor){

        
        if($valor < 5){
            echo "<tr class='table-danger'>";
        } else {
            echo "<tr>";
        }

        echo "<td>$chave</td>";
        echo "<td>$valor</td>";
        echo "</tr>";
    }

    echo "</table>";

    
    foreach($mapa as $chave => $valor){
        if($valor < 5){
            echo "<div class='alert alert-danger'>
                    Atenção: O livro <strong>$chave</strong> está com estoque baixo!
                  </div>";
        }
    }

    
}
?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>