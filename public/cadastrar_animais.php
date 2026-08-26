<?php

include "../infra/conexao.php";

if (!isset($_GET["id"]) && !isset($_POST["id"])) {
    header("Location: usuario.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $especie = $_POST["especie"];
    $raca = $_POST["raca"];
    $idade = $_POST["idade"];
    $descricao = $_POST["descricao"];

    $sql = "UPDATE animais
            SET nome = ?, especie = ?, raca = ?, idade = ?, descricao = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssis",
        $nome,
        $especie,
        $raca,
        $idade,
        $descricao,
        $id
    );

    mysqli_stmt_execute($stmt);

    header("Location: usuario.php");
    exit;
}

$id = $_GET["id"];

$sql = "SELECT * FROM animais WHERE id = ?";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$animal = mysqli_fetch_assoc($resultado);

if (!$animal) {
    die("Animal não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Animal</title>
</head>

<body>

<h1>Cadastrar Animal</h1>

<form method="POST">

    <input type="hidden" name="id"
           value="<?php echo $animal['id']; ?>">

    <label>Nome:</label><br>

    <input type="text"
           name="nome"
           value="<?php echo htmlspecialchars($animal['nome']); ?>"
           required>

    <br><br>

    <label>Espécie:</label><br>

    <input type="text"
           name="especie"
           value="<?php echo htmlspecialchars($animal['especie']); ?>"
           required>

    <br><br>

    <label>Raça:</label><br>

    <input type="text"
           name="raca"
           value="<?php echo htmlspecialchars($animal['raca']); ?>"
           required>

    <br><br>

    <label>Idade:</label><br>

    <input type="number"
           name="idade"
           value="<?php echo $animal['idade']; ?>"
           required>

    <br><br>

    <button type="submit">Salvar alterações</button>

</form>

<br>

<a href="usuario.php">Voltar</a>

</body>
</html>