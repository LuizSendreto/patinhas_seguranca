<?php

include "infra/conexao.php";

$sql_clientes = "SELECT * FROM usuarios ORDER BY nome";
$clientes = mysqli_query($conexao, $sql_clientes);

$sql_animais = "SELECT * FROM animais ORDER BY nome";
$animais = mysqli_query($conexao, $sql_animais);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>AUmigos</title>
</head>

<body>

<h1>AUmigos</h1>

<p>Sistema de gerenciamento de clientes e animais.</p>

<hr>

<h2>Menu</h2>

<a href="index.php">Início</a> |
<a href="public/usuario.php">Clientes</a> |
<a href="public/listar_animais.php">Animais</a>

<hr>

<h2>Clientes</h2>

<a href="public/cadastrar_usuario.php">
    Cadastrar Cliente
</a>

<br><br>

<table border="1" cellpadding="8">

<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Ações</th>
</tr>

<?php while ($cliente = mysqli_fetch_assoc($clientes)): ?>

<tr>

<td><?php echo $cliente['id']; ?></td>

<td>
    <?php echo htmlspecialchars($cliente['nome']); ?>
</td>

<td>
    <?php echo htmlspecialchars($cliente['email']); ?>
</td>

<td>
    <a href="public/detalhes_usuario.php?id=<?php echo $cliente['id']; ?>">
        Detalhes
    </a>
</td>

</tr>

<?php endwhile; ?>

</table>

<hr>

<h2>Animais</h2>

<a href="public/cadastrar_animais.php">
    Cadastrar Animal
</a>

<br><br>

<table border="1" cellpadding="8">

<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Espécie</th>
    <th>Raça</th>
    <th>Idade</th>
    <th>Responsável</th>
</tr>

<?php while ($animal = mysqli_fetch_assoc($animais)): ?>

<tr>

<td><?php echo $animal['id']; ?></td>

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
    <?php echo htmlspecialchars($animal['responsavel']); ?>
</td>

</tr>

<?php endwhile; ?>

</table>

<hr>

<p>
    Sistema AUmigos - Cadastro de clientes e animais.
</p>

</body>
</html>