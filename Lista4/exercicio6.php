<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 6</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 6</h1>
<form method="post">
<div class="mb-3">
              <label for="numero" class="form-label">Inserir um número decimal</label>
              <input type="number" id="numero" name="numero" step= "0.01" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $num = (float)$_POST["numero"];
    $cima = ceil ($num);
    $baixo = floor ($num);
    $normal = round ($num);

    echo "O número arredondado para cima: $cima<p>";
    echo "O número arredondado para baixo: $baixo<p>";
    echo "O número arredondado normalmente: $normal<p>";
            
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>