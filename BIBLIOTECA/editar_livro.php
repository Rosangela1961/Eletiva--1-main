<?php
require_once('conexao.php');

if (!isset($_GET['id'])) {
    header("Location: listar_livros.php");
    exit;
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $ano = intval($_POST['ano']);
    $quantidade = intval($_POST['quantidade']);
    $categoria = $_POST['categoria'];

    try {
        $stmt = $pdo->prepare('UPDATE livros SET titulo=?, autor=?, editora=?, ano=?, quantidade=?, categoria=? WHERE id=?');
        if ($stmt->execute([$titulo, $autor, $editora, $ano, $quantidade, $categoria, $id])) {
            header("Location: listar_livros.php");
            exit;
        }
    } catch (Exception $e) {
        $erro = "Erro ao atualizar: " . $e->getMessage();
    }
}

// Busca os dados antigos do livro para preencher o formulário
$stmt = $pdo->prepare("SELECT * FROM livros WHERE id = ?");
$stmt->execute([$id]);
$l = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white p-4 shadow-sm rounded" style="max-width: 600px;">
    <h3 class="mb-4">Editar Livro #<?=$l['id']?></h3>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="<?=htmlspecialchars($l['titulo'])?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Autor</label>
            <input type="text" name="autor" class="form-control" value="<?=htmlspecialchars($l['autor'])?>" required>
        </div>
        <div class="row mb-3">
            <div class="col"><label class="form-label">Editora</label><input type="text" name="editora" class="form-control" value="<?=htmlspecialchars($l['editora'])?>"></div>
            <div class="col"><label class="form-label">Ano</label><input type="number" name="ano" class="form-control" value="<?=$l['ano']?>"></div>
        </div>
        <div class="row mb-3">
            <div class="col"><label class="form-label">Qtd Estoque</label><input type="number" name="quantidade" class="form-control" value="<?=$l['quantidade']?>" required></div>
            <div class="col"><label class="form-label">Categoria</label><input type="text" name="categoria" class="form-control" value="<?=htmlspecialchars($l['categoria'])?>"></div>
        </div>
        <button type="submit" class="btn btn-warning fw-bold text-dark">Atualizar Livro</button>
        <a href="listar_livros.php" class="btn btn-secondary">Cancelar</a>
    </form>
    <?php if(isset($erro)) echo "<div class='alert alert-danger mt-3'>$erro</div>"; ?>
</div>
</body>
</html>