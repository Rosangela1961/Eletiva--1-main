<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteção: Se não estiver logado, manda de volta
if (!isset($_SESSION['usuario_nome'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca Universitária</title>
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

    <div class="col-md-3 col-lg-2 sidebar">
      <h2>Biblioteca</h2>
      <small class="d-block mb-3 text-white-50 text-center">Olá, <?=htmlspecialchars($_SESSION['usuario_nome'])?></small>
      
      <a href="listar_livros.php">Livros</a>
      <a href="listar_alunos.php">Alunos</a>
      <a href="emprestimos.php">Empréstimos</a>
      <a href="relatorios.php">Relatórios</a>
      <a href="logout.php" class="text-white-50 mt-4">Sair</a>
    </div>

    <div class="col-md-9 col-lg-10 content"></div>