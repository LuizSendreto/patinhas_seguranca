<?php

include "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha)
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $nome,
        $email,
        $senha
    );

    mysqli_stmt_execute($stmt);

    header("Location: usuario.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente</title>
</head>

<body>

<h1>Cadastrar Cliente</h1>

<form method="POST">

    <label>Nome:</label><br>
    <input type="text" name="nome" required>

    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required>

    <br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required>

    <br><br>

    <button type="submit">Cadastrar</button>

</form>

<br>

<a href="usuario.php">Voltar</a>

</body>
</html>