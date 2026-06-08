<?php
require_once('conexao.php');

if (!isset($_GET['id'])) {
    header("Location: listar_alunos.php");
    exit;
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $ra = $_POST['ra'];
    $email = $_POST['email'];

    try {
        $stmt = $pdo->prepare('UPDATE alunos SET nome=?, ra=?, email=? WHERE id=?');
        if ($stmt->execute([$nome, $ra, $email, $id])) {
            header("Location: listar_alunos.php");
            exit;
        }
    } catch (Exception $e) {
        $erro = "Erro ao atualizar: " . $e->getMessage();
    }
}

// Busca os dados atuais do aluno
$stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
$stmt->execute([$id]);
$a = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white p-4 shadow-sm rounded" style="max-width: 500px;">
    <h3 class="mb-4">Editar Aluno #<?=$a['id']?></h3>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nome Completo</label>
            <input type="text" name="nome" class="form-control" value="<?=htmlspecialchars($a['nome'])?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">RA (Registro Académico)</label>
            <input type="text" name="ra" class="form-control" value="<?=htmlspecialchars($a['ra'])?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="<?=htmlspecialchars($a['email'])?>">
        </div>
        <button type="submit" class="btn btn-warning fw-bold text-dark">Atualizar Aluno</button>
        <a href="listar_alunos.php" class="btn btn-secondary">Cancelar</a>
    </form>
    <?php if(isset($erro)) echo "<div class='alert alert-danger mt-3'>$erro</div>"; ?>
</div>
</body>
</html>