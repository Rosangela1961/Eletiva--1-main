<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Proteção da página: Só entra se estiver logado
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit;
}

include 'conexao.php';
$mensagem = "";

// 1. PROCESSA O CADASTRO DO EMPRÉSTIMO
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao_emprestar'])) {
    $aluno_id = $_POST['aluno_id'] ?? '';
    $livro_id = $_POST['livro_id'] ?? '';
    $data_emprestimo = $_POST['data_emprestimo'] ?? date('Y-m-d');

    try {
        // Correção feita de 'libro_id' para 'livro_id'
        $stmt = $pdo->prepare('INSERT INTO emprestimos (aluno_id, livro_id, data_emprestimo, data_devolucao) VALUES (?, ?, ?, NULL)');
        $stmt->execute([$aluno_id, $livro_id, $data_emprestimo]);
        $mensagem = "<div class='alert alert-success mt-3'>Empréstimo registrado com sucesso!</div>";
    } catch (PDOException $e) {
        $mensagem = "<div class='alert alert-danger mt-3'>Erro ao registrar empréstimo: " . $e->getMessage() . "</div>";
    }
}

// 2. PROCESSA A DEVOLUÇÃO (Muda o status de 'Pendente' para a data atual)
if (isset($_GET['devolver_id'])) {
    $id_emprestimo = intval($_GET['devolver_id']);
    $data_hoje = date('Y-m-d');
    try {
        $stmt = $pdo->prepare('UPDATE emprestimos SET data_devolucao = ? WHERE id = ?');
        $stmt->execute([$data_hoje, $id_emprestimo]);
        header("Location: emprestimos.php");
        exit;
    } catch (PDOException $e) {
        $mensagem = "<div class='alert alert-danger mt-3'>Erro ao devolver: " . $e->getMessage() . "</div>";
    }
}

// 3. BUSCA ALUNOS E LIVROS PARA OS SELECTS
try {
    $lista_alunos = $pdo->query("SELECT id, nome FROM alunos ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
    $lista_livros = $pdo->query("SELECT id, titulo FROM livros WHERE quantidade > 0 ORDER BY titulo ASC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $lista_alunos = [];
    $lista_livros = [];
}

// 4. BUSCA HISTÓRICO PARA A TABELA DE DEVOLUÇÃO (Aqui estava o erro antigo)
try {
    // Correção feita na linha do JOIN de 'e.libro_id' para 'e.livro_id'
    $sql = "SELECT e.id, a.nome AS aluno_nome, l.titulo AS livro_titulo, e.data_emprestimo, e.data_devolucao 
            FROM emprestimos e
            JOIN alunos a ON e.aluno_id = a.id
            JOIN livros l ON e.livro_id = l.id
            ORDER BY e.id DESC";
    $emprestimos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $emprestimos = [];
    $mensagem = "<div class='alert alert-danger mt-3'>Erro ao carregar histórico: " . $e->getMessage() . "</div>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca Universitária - Empréstimos</title>
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
      <h1 class="mb-4">Registro de Empréstimos</h1>

      <div class="card p-4">
        <form method="POST">
          <div class="row mb-3">
            <div class="col-md-5">
              <label class="form-label">Selecione o Aluno</label>
              <select name="aluno_id" class="form-select" required>
                <option value="">-- Escolha um Aluno --</option>
                <?php foreach ($lista_alunos as $aluno): ?>
                  <option value="<?= $aluno['id'] ?>"><?= htmlspecialchars($aluno['nome']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-5">
              <label class="form-label">Selecione o Livro</label>
              <select name="livro_id" class="form-select" required>
                <option value="">-- Escolha um Livro --</option>
                <?php foreach ($lista_livros as $livro): ?>
                  <option value="<?= $livro['id'] ?>"><?= htmlspecialchars($livro['titulo']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-2">
              <label class="form-label">Data</label>
              <input type="date" name="data_emprestimo" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
          </div>

          <div class="mt-4">
            <button type="submit" name="acao_emprestar" class="btn btn-primary">Confirmar Empréstimo</button>
          </div>
        </form>
        <?= $mensagem ?>
      </div>

      <div class="card p-4 mt-4">
        <h3>Histórico e Devoluções</h3>
        <table class="table table-striped mt-3">
          <thead>
            <tr>
              <th>Cód</th>
              <th>Aluno</th>
              <th>Livro</th>
              <th>Data Empréstimo</th>
              <th>Status Atual</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($emprestimos) > 0): ?>
              <?php foreach ($emprestimos as $emp): ?>
                <tr>
                  <td>#<?= $emp['id'] ?></td>
                  <td class="fw-bold"><?= htmlspecialchars($emp['aluno_nome']) ?></td>
                  <td><?= htmlspecialchars($emp['livro_titulo']) ?></td>
                  <td><?= date('d/m/Y', strtotime($emp['data_emprestimo'])) ?></td>
                  <td>
                    <?php if (empty($emp['data_devolucao']) || $emp['data_devolucao'] === 'Pendente'): ?>
                      <span class="badge bg-danger">Pendente</span>
                    <?php else: ?>
                      <span class="badge bg-success">Devolvido em <?= date('d/m/Y', strtotime($emp['data_devolucao'])) ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if (empty($emp['data_devolucao']) || $emp['data_devolucao'] === 'Pendente'): ?>
                      <a href="emprestimos.php?devolver_id=<?= $emp['id'] ?>" class="btn btn-sm btn-success" onclick="return confirm('Confirmar a devolução deste livro?')">Dar Baixa / Devolver</a>
                    <?php else: ?>
                      <button class="btn btn-sm btn-secondary" disabled>Encerrado</button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center text-muted py-3">Nenhum empréstimo registrado no momento.</td>
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