<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercicio 2 - Médias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
    <h1>Exercicio 2</h1>
    
    <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <div class="card p-3 mb-3 bg-light">
                <h5>Aluno <?= $i ?></h5>
                <div class="mb-3">
                    <label class="form-label">Nome do Aluno</label>
                    <input type="text" name="nome[]" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="form-label">Nota 1</label>
                        <input type="number" step="0.01" name="nota1[]" class="form-control" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Nota 2</label>
                        <input type="number" step="0.01" name="nota2[]" class="form-control" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Nota 3</label>
                        <input type="number" step="0.01" name="nota3[]" class="form-control" required>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
        <button type="submit" class="btn btn-primary w-100">Calcular Médias</button>
    </form>

    <hr>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nomes = $_POST['nome'];
        $nota1 = $_POST['nota1'];
        $nota2 = $_POST['nota2'];
        $nota3 = $_POST['nota3'];
        $alunos = [];
        
        
        for ($i = 0; $i < 5; $i++) {
            $n1 = (float)$nota1[$i];
            $n2 = (float)$nota2[$i];
            $n3 = (float)$nota3[$i];
                
            $media = ($n1 + $n2 + $n3) / 3;
            $alunos[$nomes[$i]] = $media;
        }

        arsort($alunos);

        echo "<h3>Resultado (Ordenado por média)</h3>";
        echo "<table class='table table-striped table-bordered mt-3'>";
        echo "<thead class='table-dark'><tr><th>Nome</th><th>Média</th></tr></thead>";
        echo "<tbody>";

        foreach ($alunos as $nome => $media) {
            echo "<tr>";
            echo "<td>$nome</td>";
            echo "<td>" . number_format($media, 2, ',', '.') . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>
</body>
</html>