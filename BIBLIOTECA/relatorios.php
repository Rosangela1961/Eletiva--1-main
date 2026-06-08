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

// Inicializa as variáveis com zero por segurança
$total_livros = 0;
$total_alunos = 0;
$emprestimos_pendentes = 0;
$lista_emprestimos = [];

try {
    // 1. CONTA O TOTAL DE LIVROS CADASTRADOS
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM livros");
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_livros = $resultado['total'] ?? 0;

    // 2. CONTA O TOTAL DE ALUNOS CADASTRADOS
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM alunos");
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_alunos = $resultado['total'] ?? 0;

    // 3. CONTA QUANTOS EMPRÉSTIMOS ESTÃO PENDENTES
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM emprestimos WHERE data_devolucao = 'Pendente' OR data_devolucao IS NULL OR data_devolucao = ''");
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $emprestimos_pendentes = $resultado['total'] ?? 0;

    // 4. BUSCA A LISTA DETALHADA DE TODOS OS EMPRÉSTIMOS PARA A TABELA DO RELATÓRIO
    // Junta as tabelas para trazer o nome do aluno e título do livro reais
    $sql = "SELECT e.id, a.nome AS aluno_nome, l.titulo AS livro_titulo, e.data_emprestimo, e.data_devolucao 
            FROM emprestimos e
            JOIN alunos a ON e.aluno_id = a.id
            JOIN livros l ON e.livro_id = l.id
            ORDER BY e.id DESC";
    $lista_emprestimos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $erro_banco = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca Universitária - Relatórios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f4f6f9; }
    .sidebar { height: 100vh; background-color: #0d6efd; color: white; padding: 20px; }
    .sidebar h2 { text-align: center; margin-bottom: 30px; }
    .sidebar a { display: block; color: white; text-decoration: none; padding: 10px; border-radius: 8px; margin-bottom: 10px; }
    .sidebar a:hover { background-color: rgba(255,255,255,0.2); }
    .content { padding: 30px; }
    .card-dashboard { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); transition: transform 0.2s; }
    .card-dashboard:hover { transform: translateY(-5px); }
    .card-detalhes { border: none; border-radius: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">

    <?php include 'interface.php'; ?>

    <div class="col-md-9 col-lg-10 content">
      <h1 class="mb-4">Painel de Relatórios e Estatísticas</h1>

      <?php if (isset($erro_banco)): ?>
        <div class="alert alert-danger">Erro ao carregar indicadores: <?= $erro_banco ?></div>
      <?php endif; ?>

      <div class="row g-4">
        
        <div class="col-md-4">
          <div class="card card-dashboard p-4 bg-white border-start border-primary border-5">
            <h5 class="text-muted text-uppercase small font-weight-bold">Total de Livros</h5>
            <div class="d-flex align-items-center justify-content-between mt-2">
              <h2 class="display-5 text-primary mb-0 fw-bold"><?= $total_livros ?></h2>
              <span class="fs-1 text-black-50">📚</span>
            </div>
            <a href="cadastro_livro.php" class="btn btn-sm btn-outline-primary mt-3 w-100">Gerenciar Livros</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-dashboard p-4 bg-white border-start border-success border-5">
            <h5 class="text-muted text-uppercase small font-weight-bold">Alunos Cadastrados</h5>
            <div class="d-flex align-items-center justify-content-between mt-2">
              <h2 class="display-5 text-success mb-0 fw-bold"><?= $total_alunos ?></h2>
              <span class="fs-1 text-black-50">👨‍🎓</span>
            </div>
            <a href="cadastro_aluno.php" class="btn btn-sm btn-outline-success mt-3 w-100">Gerenciar Alunos</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-dashboard p-4 bg-white border-start border-danger border-5">
            <h5 class="text-muted text-uppercase small font-weight-bold">Empréstimos Pendentes</h5>
            <div class="d-flex align-items-center justify-content-between mt-2">
              <h2 class="display-5 text-danger mb-0 fw-bold"><?= $emprestimos_pendentes ?></h2>
              <span class="fs-1 text-black-50">⏳</span>
            </div>
            <a href="emprestimos.php" class="btn btn-sm btn-outline-danger mt-3 w-100">Ver Empréstimos</a>
          </div>
        </div>

      </div>

      <div class="card card-detalhes p-4 mt-5">
        <h3 class="mb-3">Relatório Detalhado de Movimentações</h3>
        <p class="text-muted small">Abaixo constam todos os registros de empréstimos e suas respectivas situações atuais no banco de dados.</p>
        
        <table class="table table-striped mt-3">
          <thead>
            <tr>
              <th>Cód Empréstimo</th>
              <th>Aluno / Beneficiário</th>
              <th>Livro Retirado</th>
              <th>Data da Retirada</th>
              <th>Situação Atual</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($lista_emprestimos) > 0): ?>
              <?php foreach ($lista_emprestimos as $emp): ?>
                <tr>
                  <td>#<?= $emp['id'] ?></td>
                  <td class="fw-bold"><?= htmlspecialchars($emp['aluno_nome']) ?></td>
                  <td><?= htmlspecialchars($emp['livro_titulo']) ?></td>
                  <td>
                    <?= !empty($emp['data_emprestimo']) ? date('d/m/Y', strtotime($emp['data_emprestimo'])) : '---' ?>
                  </td>
                  <td>
                    <?php if (empty($emp['data_devolucao']) || $emp['data_devolucao'] === 'Pendente'): ?>
                      <span class="badge bg-danger">Ainda não Devolvido (Pendente)</span>
                    <?php else: ?>
                      <span class="badge bg-success">Devolvido em <?= date('d/m/Y', strtotime($emp['data_devolucao'])) ?></span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center text-muted py-4">Nenhuma movimentação ou empréstimo registrado no banco de dados até o momento.</td>
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