<?php
require_once('conexao.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    try {
        $stmt = $pdo->prepare("DELETE FROM livros WHERE id = ?");
        $stmt->execute([$id]);
    } catch (Exception $e) {
        // Silencioso ou trate o erro se houver FK
    }
}

header("Location: listar_livros.php");
exit;
?>