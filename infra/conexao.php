<?php

$host = "localhost";
$usuario = "root";
$senha = "root";
$banco = "patinhas_seguranca";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

$conexao->set_charset("utf8mb4");

?>