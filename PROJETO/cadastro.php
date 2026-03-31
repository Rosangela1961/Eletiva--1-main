<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .register-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { width: 100%; max-width: 450px; border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container register-container">
    <div class="card p-4">
        <div class="card-body">
            <h3 class="text-center mb-4">Criar Conta</h3>
            <form action="processa_cadastro.php" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Crie uma senha forte" required>
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                <div class="text-center mt-3">
                    <p class="small">Já possui conta? <a href="login.html">Voltar ao login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>