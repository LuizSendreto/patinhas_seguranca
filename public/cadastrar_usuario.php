<?php

include "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    if (empty($nome) || empty($email) || empty($senha)) {
        die("Preencha todos os campos.");
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar a consulta.");
    }

    $stmt->bind_param("sss", $nome, $email, $senha_hash);

    if ($stmt->execute()) {
        echo "Cliente cadastrado com sucesso!<br><br>";
        echo '<a href="../index.php">Voltar</a>';
    } else {
        echo "Erro ao cadastrar cliente.";
    }

    $stmt->close();
    $conexao->close();
}

?>

<h2>Cadastrar Cliente</h2>

<form method="POST">

    <label>Nome:</label><br>
    <input type="text" name="nome" required>

    <br><br>

    <label>E-mail:</label><br>
    <input type="email" name="email" required>

    <br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required>

    <br><br>

    <button type="submit">Cadastrar</button>

</form>

<br>

<a href="../index.php">Voltar</a>