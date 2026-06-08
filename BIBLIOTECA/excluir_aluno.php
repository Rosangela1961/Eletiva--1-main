<?php
// 1. Inicia a sessão e ativa a exibição de erros para controle
session_start();
require_once('conexao.php');

// 2. Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    try {
        // Prepara a exclusão do aluno pelo ID
        $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = ?");
        $stmt->execute([$id]); // Erro do $id corrigido aqui!
    } catch (Exception $e) {
        // Se o aluno tiver um empréstimo ativo, o banco vai dar erro. 
        // Armazenamos o aviso para não quebrar a tela.
        $_SESSION['erro_excluir'] = "Não é possível excluir este aluno pois ele possui empréstimos pendentes!";
    }
}

// 3. Redireciona de volta para a lista de alunos atualizada
header("Location: listar_alunos.php");
exit;
?>