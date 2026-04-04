<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercicio 1 - Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> 
<div class="container py-3">
    <h1>Exercicio 1</h1>
    
    <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <div class="card mb-3 p-3 bg-light">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Informe o nome <?= $i ?></label>
                        <input type="text" name="nome[]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Informe o telefone <?= $i ?></label>
                        <input type="text" name="telefone[]" class="form-control" required>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
        <button type="submit" class="btn btn-primary w-100">Enviar e Ordenar</button>
    </form>

    <hr>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nomes = $_POST['nome'];
        $telefones = $_POST['telefone'];
        
        $agenda = [];
        $erros = [];

        for ($i = 0; $i < count($nomes); $i++) {
            $n = trim($nomes[$i]);
            $t = trim($telefones[$i]);

            
            if (array_key_exists($n, $agenda)) {
                $erros[] = "O nome <strong>$n</strong> está duplicado!<br>";
                continue;
            }

            
            if (in_array($t, $agenda)) {
                $erros[] = "O telefone <strong>$t</strong> está duplicado!<br>";
                continue;
            }

        
            if (!empty($n)) {
                $agenda[$n] = $t;
            }
        }

        
        ksort($agenda);

    
        if (!empty($erros)) {
            echo "<div class='alert alert-danger'>";
            foreach ($erros as $e) {
                echo $e;
            }
            echo "</div>";
        }

        // Exibe a lista final organizada
        echo "<h3>Lista de Contatos Ordenada</h3>";
        echo "<ul class='list-group shadow-sm'>";
        foreach ($agenda as $nome_contato => $tel_contato) {
            echo "<li class='list-group-item d-flex justify-content-between'>";
            echo "<strong>$nome_contato</strong> <span>$tel_contato</span>";
            echo "</li>";
        }
        echo "</ul>";
    } 
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>
</body>
</html>