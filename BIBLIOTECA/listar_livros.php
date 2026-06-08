<?php
include 'cabecalho.php';
require_once('conexao.php');

// Lógica para Salvar um Novo Livro quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao_salvar'])) {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $ano = intval($_POST['ano']);
    $quantidade = intval($_POST['quantidade']);
    $categoria = $_POST['categoria'];

    try {
        $stmt = $pdo->prepare('INSERT INTO livros (titulo, autor, editora, ano, quantidade, categoria) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$titulo, $autor, $editora, $ano, $quantidade, $categoria]);
        echo "<script>window.location.href='listar_livros.php';</script>";
        exit;
    } catch (Exception $e) {
        $erro = "Erro ao salvar: " . $e->getMessage();
    }
}

// Lógica de Busca Dinâmica no Banco de Dados
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
try {
    if (!empty($busca)) {
        $stmt = $pdo->prepare("SELECT * FROM livros WHERE titulo LIKE ? OR autor LIKE ? ORDER BY titulo ASC");
        $stmt->execute(["%$busca%", "%$busca%"]);
        $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $livros = $pdo->query("SELECT * FROM livros ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    $livros = [];
}
?>

<h1 class="mb-4">Cadastro de Livros</h1>

<?php if(isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>

<div class="card p-4">
  <form method="POST">
    <input type="hidden" name="acao_salvar" value="1">

    <div class="row mb-3">
      <div class="col-md-12">
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
        <input type="number" name="quantidade" class="form-control" value="1" required>
      </div>

      <div class="col-md-4">
        <label class="form-label">Categoria</label>
        <input type="text" name="categoria" class="form-control">
      </div>
    </div>

    <div class="mt-4">
      <button type="submit" class="btn btn-primary fw-bold">Salvar Novo Livro</button>
    </div>
  </form>
</div>

<div class="card p-4 mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Livros Cadastrados</h3>
    <form method="GET" class="d-flex gap-2" style="max-width: 400px;">
        <input type="text" name="busca" class="form-control" placeholder="Buscar título ou autor..." value="<?=htmlspecialchars($busca)?>">
        <button type="submit" class="btn btn-secondary">Buscar</button>
    </form>
  </div>

  <table class="table table-striped mt-3">
    <thead>
      <tr>
        <th>Código (ID)</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Categoria</th>
        <th>Quantidade</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if(count($livros) > 0): ?>
          <?php foreach($livros as $l): ?>
          <tr>
            <td>#<?=$l['id']?></td>
            <td class="fw-bold"><?=$l['titulo']?></td>
            <td><?=$l['autor']?></td>
            <td><?=$l['categoria']?></td>
            <td><?=$l['quantidade']?> un.</td>
            <td>
                <a href="editar_livro.php?id=<?=$l['id']?>" class="btn btn-sm btn-warning fw-bold">Editar</a>
                <a href="excluir_livro.php?id=<?=$l['id']?>" class="btn btn-sm btn-danger fw-bold" onclick="return confirm('Excluir este livro?')">Excluir</a>
            </td>
          </tr>
          <?php endforeach; ?>
      <?php else: ?>
          <tr><td colspan="6" class="text-center text-muted">Nenhum livro registrado no acervo.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</div>
</div>
</div>

</body>
</html>