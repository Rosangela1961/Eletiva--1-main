<?php
// Configurações para o SEU XAMPP (Porta 3308 e sem senha)
$dominio = "mysql:host=127.0.0.1;port=3308;dbname=biblioteca;charset=utf8"; 
$usuario = "root";
$senha = ""; 

try {
    // Cria a variável $pdo global que o cadastro.php tanto procura
    $pdo = new PDO($dominio, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // Se der erro na conexão, ele para aqui e te avisa o motivo real
    die("Erro crítico de conexão no arquivo conexao.php: " . $e->getMessage());
}
?>