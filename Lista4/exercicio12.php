<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercicio 12 </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> 
<div class="container py-5">
    <h1>Exercicio 12</h1>
    
    <form method="post">
        <div class="mb-3">
            <p class="text-muted">Clique no botão abaixo para gerar uma senha aleatória de 8 caracteres.</p>
        </div>
        <button type="submit" name="btn-gerar" class="btn btn-primary">Gerar Senha</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $senha_gerada = substr(str_shuffle($caracteres), 0, 8);
        echo "Senha Gerada: <code style='font-size: 1.5rem;'>" .$senha_gerada. "</code>";
      
         
        }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>





