<?php

include "../infra/conexao.php";

if (!isset($_GET["id"]) && !isset($_POST["id"])) {
    header("Location: listar_animais.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $especie = $_POST["especie"];
    $raca = $_POST["raca"];
    $descricao = $_POST["descricao"];
    $cliente_id = $_POST["cliente_id"];

    if (empty($cliente_id)) {
        die("É obrigatório selecionar um responsável.");
    }

    $sql = "UPDATE animais
            SET nome = ?,
                idade = ?,
                especie = ?,
                raca = ?,
                descricao = ?,
                cliente_id = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sisssii",
        $nome,
        $idade,
        $especie,
        $raca,
        $descricao,
        $cliente_id,
        $id
    );

    mysqli_stmt_execute($stmt);

    header("Location: listar_animais.php");
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

$clientes = mysqli_query(
    $conexao,
    "SELECT id, nome FROM usuarios ORDER BY nome"
);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Animal</title>
</head>

<body>

<h1>Editar Animal</h1>

<form method="POST">

    <input type="hidden"
           name="id"
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
           min="0"
           required>

    <br><br>

    <label>Descrição:</label><br>

    <textarea name="descricao"><?php
        echo htmlspecialchars($animal['descricao']);
    ?></textarea>

    <br><br>

    <label>Responsável:</label><br>

    <select name="cliente_id" required>

        <?php while ($cliente = mysqli_fetch_assoc($clientes)): ?>

            <option
                value="<?php echo $cliente['id']; ?>"
                <?php
                if ($cliente['id'] == $animal['cliente_id']) {
                    echo "selected";
                }
                ?>
            >
                <?php echo htmlspecialchars($cliente['nome']); ?>
            </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <button type="submit">Salvar alterações</button>

</form>

<br>

<a href="listar_animais.php">Voltar</a>

</body>
</html>