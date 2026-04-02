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
              <label for="texto" class="form-label">Inserir um nome completo</label>
              <input type="text" id="texto" name="texto" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome_completo = $_POST['texto'];
    $nome_limpo = mb_strtoupper(trim($nome_completo));
    $partes = explode(' ', $nome_limpo);
    $ignorar = ['DE', 'DO', 'DA', 'DOS', 'DAS', 'E'];
    $iniciais = [];
    foreach ($partes as $parte){
        if (!empty($parte) && !in_array($parte, $ignorar)){
            $iniciais[] = mb_substr($parte, 0, 1);
        }
    }
    $resultado = implode('.', $iniciais). '.';
    echo "Entrada: $nome_completo<p>";
    echo "Saída: $resultado<p>";
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>