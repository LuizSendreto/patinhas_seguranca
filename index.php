<php

include "../infra/conexao.php";

$animais = mysqli_query($conexao, "SELECT * FROM animais");

$usuarios = mysqli_query($conexao, "SELECT * FROM usuarios");

$resulta