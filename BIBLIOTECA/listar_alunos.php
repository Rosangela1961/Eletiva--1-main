<?php
// 1. Inclui o cabeçalho corrigido
include 'cabecalho.php'; 
require_once('conexao.php');

$busca = isset($_GET['busca']) ? $_GET['busca'] : '';

try {
    if (!empty($busca)) {
        $stmt = $pdo->prepare("SELECT * FROM alunos WHERE nome LIKE ? OR ra LIKE ? ORDER BY nome ASC");
        $stmt->execute(["%$busca%", "%$busca%"]);
        $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $alunos = $pdo->query("SELECT * FROM alunos ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    $alunos = [];
}
?>

<div class="container bg-white p-4 shadow-sm rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">🎓 Alunos Cadastrados</h2>
        <a href="cadastro_aluno.php" class="btn btn-success fw-bold">+ Cadastrar Novo Aluno</a>
    </div>

    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-9">
            <input type="text" name="busca" class="form-control" placeholder="Buscar por nome ou RA..." value="<?=htmlspecialchars($busca)?>">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-secondary w-100 fw-bold">Pesquisar</button>
        </div>
    </form>

    <table class="table table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome do Aluno</th>
                <th>RA (Registro Acadêmico)</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($alunos) > 0): ?>
                <?php foreach($alunos as $a): ?>
                <tr>
                    <td>#<?=$a['id']?></td>
                    <td class="fw-bold"><?=$a['nome']?></td>
                    <td><span class="badge bg-info text-dark"><?=$a['ra']?></span></td>
                    <td><?=$a['email']?></td>
                    <td>
                        <a href="editar_aluno.php?id=<?=$a['id']?>" class="btn btn-sm btn-warning fw-bold">Editar</a>
                        <a href="excluir_aluno.php?id=<?=$a['id']?>" class="btn btn-sm btn-danger fw-bold" onclick="return confirm('Deseja remover este aluno?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center text-muted">Nenhum aluno encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</div> </div> </div> </body>
</html>