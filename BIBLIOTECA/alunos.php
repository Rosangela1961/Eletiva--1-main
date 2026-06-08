<?php
// 1. FORÇA O PHP A MOSTRAR ERROS (Isso impede a tela branca)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Tenta conectar de forma segura
try {
    include 'conexao.php'; 
} catch (Throwable $e) {
    echo "<div style='color: red; background: #ffcccc; padding: 20px; margin: 20px; border: 20px solid red;'>";
    echo "<h3>Erro ao carregar o arquivo de conexão:</h3>";
    echo $e->getMessage();
    echo "</div>";
    exit; // Para o código aqui para você ler o erro
}

// Processa o cadastro de alunos quando o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome  = $_POST['nome'] ?? '';
    $ra    = $_POST['ra'] ?? '';
    $email = $_POST['email'] ?? '';

    try {
        $stmt = $pdo->prepare('INSERT INTO alunos (nome, ra, email) VALUES (?, ?, ?)');
        if ($stmt->execute([$nome, $ra, $email])) {
            $mensagem = "<div class='alert alert-success mt-3 text-center'>Aluno cadastrado com sucesso!</div>";
        } else {
            $mensagem = "<div class='alert alert-danger mt-3 text-center'>Erro ao cadastrar! Tente novamente.</div>";
        }
    } catch (Throwable $e) {
        $mensagem = "<div class='alert alert-danger mt-3 text-center'>Erro no Banco de Dados: " . $e->getMessage() . "</div>";
    }
}

// 3. BUSCA SEGURA: Puxa a lista de alunos
try {
    $dados = $pdo->query("SELECT * FROM alunos")->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $dados = [];
    $erro_busca = $e->getMessage();
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
    .sidebar a.active { background-color: rgba(255,255,255,0.3); font-weight: bold; }
    .content { padding: 30px; }
    .card { border: none; border-radius: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-3 col-lg-2 sidebar">
      <h2>Biblioteca</h2>
      <p class="text-white-50 text-center">Olá, Rosangela</p>
      <a href="cadastro.php">Livros</a>
      <a href="alunos.php" class="active">Alunos</a>
      <a href="emprestimos.php">Empréstimos</a>
      <a href="#">Relatórios</a>
      <a href="#" class="text-white-50">Sair</a>
    </div>

    <div class="col-md-9 col-lg-10 content">

      <?php if (isset($erro_busca)): ?>
        <div class="alert alert-warning">Nota: Não foi possível listar os alunos cadastrados: <?= $erro_busca ?></div>
      <?php endif; ?>

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
            <button type="submit" class="btn btn-primary">Salvar Aluno</button>
          </div>
        </form>

        <?php if (isset($mensagem)) echo $mensagem; ?>
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
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($dados) && count($dados) > 0): ?>
              <?php foreach ($dados as $aluno): ?>
                <tr>
                  <td>#<?=$aluno['id']?></td>
                  <td class="fw-bold"><?=$aluno['nome']?></td>
                  <td><?=$aluno['ra']?></td>
                  <td><?=$aluno['email']?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center text-muted py-4">Nenhum aluno cadastrado no banco de dados.</td>
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