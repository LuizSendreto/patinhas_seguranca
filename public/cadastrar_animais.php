<php

include"/infra/conexao.php";

$nome = $_POST['nome'];
$idade = $_POST['idade'];
$especie = $_POST['especie'];
$raca = $_POST['raca'];
$descricao = $_POST['descricao'];

$sql = "INSERT INTO animais (nome, idade, especie, raca, descricao) VALUES ('$nome', '$idade', '$especie', '$raca', '$descricao')";

mysqli_query($conexao, $sql);

header("Location:../index.php");