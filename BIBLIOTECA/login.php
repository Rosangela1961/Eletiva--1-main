<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inicia a sessão para guardar o login
session_start();
$erro = "";

// Defina aqui o usuário e a senha que você quer usar para entrar
$usuario_correto = "admin";
$senha_correta   = "123";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_digitado = $_POST['usuario'] ?? '';
    $senha_digitada   = $_POST['senha'] ?? '';

    // Verifica se o que foi digitado bate com as credenciais corretas
    if ($usuario_digitado === $usuario_correto && $senha_digitada === $senha_correta) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario_nome'] = $usuario_digitado;
        
        // Redireciona direto para a tela de livros
        header("Location: cadastro_livro.php");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - Biblioteca Universitária</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f4f6f9; height: 100vh; display: flex; align-items: center; justify-content: center; }
    .card-login { width: 100%; max-width: 400px; border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
  </style>
</head>
<body>

<div class="card card-login p-4 bg-white">
  <h2 class="text-center text-primary mb-4">Biblioteca</h2>
  <h5 class="text-center text-muted mb-4">Acesse sua conta</h5>

  <?php if (!empty($erro)): ?>
    <div class="alert alert-danger text-center"><?= $erro ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Usuário</label>
      <input type="text" name="usuario" class="form-control" placeholder="Ex: admin" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Senha</label>
      <input type="password" name="senha" class="form-control" placeholder="••••••••" required>
    </div>
    <button type="submit" class="btn btn-primary w-100 mt-3">Entrar</button>
  </form>
</div>

</body>
</html>