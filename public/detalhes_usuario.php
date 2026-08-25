<?php

include "../infra/conexao.php";

if (!isset($_GET["id"])) {
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

$sql_animais = "SELECT *
                FROM animais
                WHERE cliente_id = ?
                ORDER BY nome";

$stmt_animais = mysqli_prepare(
    $conexao,
    $sql_animais
);

mysqli_stmt_bind_param(
    $stmt_animais,
    "i",
    $id
);

mysqli_stmt_execute($stmt_animais);

$animais = mysqli_stmt_get_result($stmt_animais);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Detalhes do Cliente</title>
</head>

<body>

<h1>Detalhes do Cliente</h1>

<a href="usuario.php">Voltar para clientes</a>

<hr>

<h2>
    <?php echo htmlspecialchars($cliente['nome']); ?>
</h2>

<p>
    <strong>ID:</strong>
    <?php echo $cliente['id']; ?>
</p>

<p>
    <strong>Email:</strong>
    <?php echo htmlspecialchars($cliente['email']); ?>
</p>

<hr>

<h2>Animais cadastrados</h2>

<?php if (mysqli_num_rows($animais) > 0): ?>

<table border="1" cellpadding="8">

<tr>
    <th>Nome</th>
    <th>Espécie</th>
    <th>Raça</th>
    <th>Idade</th>
    <th>Descrição</th>
</tr>

<?php while ($animal = mysqli_fetch_assoc($animais)): ?>

<tr>

<td>
    <?php echo htmlspecialchars($animal['nome']); ?>
</td>

<td>
    <?php echo htmlspecialchars($animal['especie']); ?>
</td>

<td>
    <?php echo htmlspecialchars($animal['raca']); ?>
</td>

<td>
    <?php echo $animal['idade']; ?> anos
</td>

<td>
    <?php echo htmlspecialchars($animal['descricao']); ?>
</td>

</tr>

<?php endwhile; ?>

</table>

<?php else: ?>

<p>Este cliente ainda não possui animais cadastrados.</p>

<?php endif; ?>

</body>
</html>