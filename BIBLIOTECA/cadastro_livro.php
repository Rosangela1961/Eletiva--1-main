<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit;
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'conexao.php';
$mensagem = "";

// 1. PROCESSA O SALVAMENTO (Botão Salvar)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao_salvar'])) {
    $titulo     = $_POST['titulo'] ?? '';
    $autor      = $_POST['autor'] ?? '';
    $editora    = $_POST['editora'] ?? '';
    $ano        = !empty($_POST['ano']) ? intval($_POST['ano']) : null;
    $quantidade = !empty($_POST['quantidade']) ? intval($_POST['quantidade']) : 1;
    $categoria  = $_POST['categoria'] ?? '';

    try {
        $stmt = $pdo->prepare('INSERT INTO livros (titulo, autor, editora, ano, quantidade, categoria) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$titulo, $autor, $editora, $ano, $quantidade, $categoria]);
        $mensagem = "<div class='alert alert-success mt-3'>Livro cadastrado com sucesso!</div>";
    } catch (PDOException $e) {
        $mensagem = "<div class='alert alert-danger mt-3'>Erro ao salvar: " . $e->getMessage() . "</div>";
    }
}

// 2. BUSCA OS LIVROS PARA A SUA TABELA
try {
    $livros = $pdo->query("SELECT * FROM livros")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $livros = [];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca Universitária - Livros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f4f6f9; }
    .sidebar { height: 100vh; background-color: #0d6efd; color: white; padding: 20px; }
    .sidebar h2 { text-align: center; margin-bottom: 30px; }
    .sidebar a { display: block; color: white; text-decoration: none; padding: 10px; border-radius: 8px; margin-bottom: 10px; }
    .sidebar a:hover { background-color: rgba(255,255,255,0.2); }
    .content { padding: 30px; }
    .card { border: none; border-radius: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">

    <?php include 'interface.php'; ?>

    <div class="col-md-9 col-lg-10 content">
      <h1 class="mb-4">Cadastro de Livros</h1>

      <div class="card p-4">
        <form method="POST">

          <div class="row mb-3">
            <div class="col-md-2">
              <label class="form-label">Código</label>
              <input type="text" class="form-control" placeholder="Automático" disabled>
            </div>

            <div class="col-md-10">
              <label class="form-label">Título</label>
              <input type="text" name="titulo" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" name="autor" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Editora</label>
              <input type="text" name="editora" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4">
              <label class="form-label">Ano</label>
              <input type="number" name="ano" class="form-control">
            </div>

            <div class="col-md-4">
              <label class="form-label">Quantidade</label>
              <input type="number" name="quantidade" class="form-control" value="1">
            </div>

            <div class="col-md-4">
              <label class="form-label">Categoria</label>
              <input type="text" name="categoria" class="form-control">
            </div>
          </div>

          <div class="mt-4">
            <button type="submit" name="acao_salvar" class="btn btn-primary">Salvar</button>
            <a href="listar_livros.php" class="btn btn-secondary">Ver Todos</a>
          </div>

        </form>
        <?= $mensagem ?>
      </div>

      <div class="card p-4 mt-4">
        <h3>Livros Cadastrados</h3>
        <table class="table table-striped mt-3">
          <thead>
            <tr>
              <th>Código</th>
              <th>Título</th>
              <th>Autor</th>
              <th>Categoria</th>
              <th>Quantidade</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($livros) > 0): ?>
              <?php foreach ($livros as $livro): ?>
                <tr>
                  <td>#<?= $livro['id'] ?></td>
                  <td class="fw-bold"><?= htmlspecialchars($livro['titulo']) ?></td>
                  <td><?= htmlspecialchars($livro['autor']) ?></td>
                  <td><?= htmlspecialchars($livro['categoria']) ?></td>
                  <td><?= $livro['quantidade'] ?></td>
                  <td>
                     <a href="editar_livro.php?id=<?= $livro['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                     <a href="excluir_livro.php?id=<?= $livro['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir livro?')">Excluir</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center text-muted py-3">Nenhum livro cadastrado no banco de dados.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

</body>
</html>