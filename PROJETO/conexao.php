<?php

    $dominio = "mysql:host=localhost;dbname=projetophp";//primeiro parâmetro
    $usuario = "root";
    $senha = "Rose@2509";

    try {
        $pdo = new PDO($dominio, $usuario, $senha);
    } catch (Exception $e){
        die("Erro ao conectar ao banco: ". $e->getMessage());

    }
