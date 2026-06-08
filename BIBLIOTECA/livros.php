<?php
// 1. Conecta ao banco de dados
include 'conexao.php'; 

// 2. Processa o formulário quando o usuário clica em "Salvar"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo     = $_POST['titulo'];
    $autor      = $_POST['autor'];
    $editora    = $_POST['editora'];
    $ano        = intval($_POST['ano']);
    $quantidade = intval($_POST['quantidade']);
    $categoria  = $_POST['categoria'];

    try {
        // Insere o livro na tabela correta do seu banco de dados
        $stmt = $pdo->prepare('INSERT INTO livros (titulo, autor, editora, ano, quantidade, categoria) VALUES (?, ?, ?, ?, ?, ?)');
        
        if ($stmt->execute([$titulo, $autor, $editora, $ano, $quantidade, $categoria])) {
            $mensagem = "<div class='alert alert-success mt-3 text-center fw-bold'>Livro cadastrado com sucesso!</div>";
        } else {
            $mensagem = "<div class='alert alert-danger mt-3 text-center fw-bold'>Erro ao cadastrar o livro!</div>";
        }
    } catch (Exception $e) {
        $mensagem = "<div class='alert alert-danger mt-3 text-center fw-bold'>Erro: " . $e->getMessage() . "</div>";
    }
}

// 3. Busca todos os livros já cadastrados para exibir na tabela abaixo
try {
    $dados_livros = $pdo->query("SELECT * FROM livros ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $dados_livros = [];
}

// 4. INCLUI O MENU LATERAL AZUL UNIFICADO
include 'cabecalho.php'; 
?>

<h1 class="mb-4">Cadastro de Livros</h1>

<div class="card p-4">
  <form method="POST">
    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Título do Livro</label>
        <input type="text" name="titulo" class="form-control" placeholder="Ex: O Alquimista" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Autor</label>
        <input type="text" name="autor" class="