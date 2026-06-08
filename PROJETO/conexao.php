<?php

    $dominio = "mysql:host=localhost:3308;dbname=phpprojeto";//primeiro parâmetro
    $usuario = "root";
    $senha = "";

    try {
        $pdo = new PDO($dominio, $usuario, $senha);
    } catch (Exception $e){
        die("Erro ao conectar ao banco: ". $e->getMessage());

    }
