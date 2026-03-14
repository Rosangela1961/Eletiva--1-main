<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 10</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 10</h1>
<form method="post">
<div class="mb-3">
              <label for="valor1" class="form-label">Inserir valor da largura do retangulo</label>
              <input type="number" id="valor1" name="valor1" class="form-control">
            </div><div class="mb-3">
              <label for="valo2" class="form-label">Inserir valor da altura do retangulo</label>
              <input type="number" id="valo2" name="valo2" class="form-control">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $largura = $_POST['valor1'];
    $altura = $_POST['valor2'];
    $perimetro = 2 * ($largura + $altura);
    echo "O perímetro do retangulo é:" .$perimetro;
}
?>    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>