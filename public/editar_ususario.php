<?php

include "../infra/conexao.php";

if (!isset($_GET["id"]) && !isset($_POST["id"])) {
    header("Location: usuario.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $sql = "UPDATE usuarios
            SET nome = ?, email = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssi",
        $nome,
        $email,
        $id
    );

    mysqli_stmt_execute($stmt);

    header("Location: usuario.php");
    exit;
}

$id = $_GET["id"];

$sql = "SELECT * FROM usuarios WHERE id = ?";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$cliente = mysqli_fetch_assoc($resultado);

if (!$cliente) {
    die("Cliente não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>

<body>

<h1>Editar Cliente</h1>

<form method="POST">

    <input type="hidden" name="id"
           value="<?php echo $cliente['id']; ?>">

    <label>Nome:</label><br>

    <input type="text"
           name="nome"
           value="<?php echo htmlspecialchars($cliente['nome']); ?>"
           required>

    <br><br>

    <label>Email:</label><br>

    <input type="email"
           name="email"
           value="<?php echo htmlspecialchars($cliente['email']); ?>"
           required>

    <br><br>

    <button type="submit">Salvar alterações</button>

</form>

<br>

<a href="usuario.php">Voltar</a>

</body>
</html>