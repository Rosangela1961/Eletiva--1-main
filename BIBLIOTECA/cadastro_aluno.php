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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao_salvar_aluno'])) {
    $nome  = $_POST['nome'] ?? '';
    $ra    = $_POST['ra'] ?? '';
    $email = $_POST['email'] ?? '';

    try {
        $stmt = $pdo->prepare('INSERT INTO alunos (nome, ra, email) VALUES (?, ?, ?)');
        $stmt->execute([$nome, $ra, $email]);
        $mensagem = "<div class='alert alert-success mt-3'>Aluno cadastrado com sucesso!</div>";
    } catch (PDOException $e) {
        $mensagem = "<div class='alert alert-danger mt-3'>Erro ao salvar: " . $e->getMessage() . "</div>";
    }
}

try {
    $alunos = $pdo->query("SELECT * FROM alunos")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $alunos = [];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca Universitária - Alunos</title>
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
      <h1 class="mb-4">Cadastro de Alunos</h1>

      <div class="card p-4">
        <form method="POST">

          <div class="row mb-3">
            <div class="col-md-8">
              <label class="form-label">Nome Completo</label>
              <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="col-md-4">
              <label class="form-label">RA (Registro Acadêmico)</label>
              <input type="text" name="ra" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-12">
              <label class="form-label">E-mail</label>
              <input type="email" name="email" class="form-control">
            </div>
          </div>

          <div class="mt-4">
            <button type="submit" name="acao_salvar_aluno" class="btn btn-primary">Salvar Aluno</button>
          </div>

        </form>
        <?= $mensagem ?>
      </div>

      <div class="card p-4 mt-4">
        <h3>Alunos Cadastrados</h3>
        <table class="table table-striped mt-3">
          <thead>
            <tr>
              <th>Código</th>
              <th>Nome</th>
              <th>RA</th>
              <th>E-mail</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($alunos) > 0): ?>
              <?php foreach ($alunos as $aluno): ?>
                <tr>
                  <td>#<?= $aluno['id'] ?></td>
                  <td class="fw-bold"><?= htmlspecialchars($aluno['nome']) ?></td>
                  <td><?= htmlspecialchars($aluno['ra']) ?></td>
                  <td><?= htmlspecialchars($aluno['email']) ?></td>
                  <td>
                     <a href="editar_aluno.php?id=<?= $aluno['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                     <a href="excluir_aluno.php?id=<?= $aluno['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir aluno?')">Excluir</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center text-muted py-3">Nenhum aluno cadastrado.</td>
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