<?php
// Inicia a sessão para poder destruí-la
session_start();

// Limpa todas as variáveis da memória
$_SESSION = array();

// Destrói a sessão ativa
session_destroy();

// Redireciona imediatamente para a tela de login
header("Location: login.php");
exit;
?>