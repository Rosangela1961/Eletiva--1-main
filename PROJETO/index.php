<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { width: 100%; max-width: 400px; border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container login-container">
    <div class="card p-4">
        <div class="card-body">
            <h3 class="text-center mb-4">Sistema de Controle de Estoque</h3>
            <form  method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input nome="email" type ="email class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required>
                </div>
            
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input nome="senha"  type= "password" class="form-control" id="senha" name="senha" placeholder="Sua senha" required>
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
                <div class="text-center mt-3">
                    <p class="small">Não tem uma conta? <a href="cadastro.html">Cadastre-se</a></p>
                </div>

            </form>

            <?php
               session_start(); 
               if ($_SERVER["REQUEST_METHOD"] == 'POST'){
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                if($email == "adm@adm" && $senha == '123'){
                    $_SESSION['nome'] = 'Administrador';
                    $_SESSION['acesso'] = true;
                    header('Location:  principal.php');
                } else {
                    $_SESSION['acesso'] = false;
                    echo "<p> class= 'text-danger'Email e/ou senha incorretos!</p>";
                }

               } 
            ?>
        </div>
    </div>
</div>

</body>
</html>