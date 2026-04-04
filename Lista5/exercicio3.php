<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"> 
<div class="container py-5">
    <h1 class="mb-4">Cadastro de Produtos</h1>
    
    <form method="post" class="card p-4 shadow-sm">
        <?php for($i=0; $i<5; $i++): ?>
            <div class="row g-3 mb-4 border-bottom pb-3">
                <h5>Produto <?= $i+1 ?></h5>
                <div class="col-md-3">
                    <label class="form-label">Código</label>
                    <input type="text" name="codigo[]" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nome do Produto</label>
                    <input type="text" name="nome[]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Preço (R$)</label>
                    <input type="number" step="0.01" name="preco[]" class="form-control" required>
                </div>
            </div>
        <?php endfor; ?>
        <button type="submit" class="btn btn-success">Processar Produtos</button>
    </form>

    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $codigos = $_POST['codigo'];
        $nomes = $_POST['nome'];
        $precos = $_POST['preco'];

        $produtos = [];

        for($i=0; $i < count($codigos); $i++){
            $codigo = $codigos[$i];
            $precoOriginal = (float)$precos[$i];

            $precoFinal = $precoOriginal;
            if($precoOriginal > 100){
                $precoFinal = $precoOriginal * 0.90;
            }

            $produtos[$codigo] = [
                "nome" => $nomes[$i],
                "preco" => $precoFinal
            ];
        }

        
        uasort($produtos, function($a, $b) {
            return strcasecmp($a['nome'], $b['nome']);
        });

        
        echo "<h2 class='mt-5'>Lista de Produtos (Ordenada por Nome)</h2>";
        echo "<table class='table table-striped table-hover mt-3 bg-white shadow-sm'>";
        echo "<thead class='table-dark'>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Preço Final (c/ Desconto se > 100)</th>
                </tr>
              </thead>
              <tbody>";

        foreach ($produtos as $codigo => $dados) {
            echo "<tr>
                    <td>{$codigo}</td>
                    <td>{$dados['nome']}</td>
                    <td>R$ " . number_format($dados['preco'], 2, ',', '.') . "</td>
                  </tr>";
        }
        echo "</tbody></table>";
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>