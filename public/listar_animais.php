<?php

include "../infra/conexao.php";

$sql = "SELECT
            animais.id,
            animais.nome,
            animais.especie,
            animais.raca,
            animais.idade,
            animais.descricao,
            usuarios.nome AS responsavel
        FROM animais
        INNER JOIN usuarios
            ON animais.cliente_id = usuarios.id
        ORDER BY animais.nome";



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Animais - AUmigos</title>
</head>

<body>

<h1>Animais</h1>

<a href="../index.php">Início</a> |
<a href="cadastrar_animais.php">Cadastrar Animal</a> |
<a href="usuario.php">Clientes</a>

<hr>

<?php if (mysqli_num_rows($resultado) > 0): ?>

<table border="1" cellpadding="8">

<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Espécie</th>
    <th>Raça</th>
    <th>Idade</th>
    <th>Responsável</th>
    <th>Ações</th>
</tr>

<?php while ($animal = mysqli_fetch_assoc($resultado)): ?>

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

<td>

<a href="editar_animais.php?id=<?php echo $animal['id']; ?>">
    Editar
</a>

|

<a href="excluir_animais.php?id=<?php echo $animal['id']; ?>"
   onclick="return confirm('Deseja realmente excluir este animal?');">
    Excluir
</a>

</td>

</tr>

<?php endwhile; ?>

</table>

<?php else: ?>

<p>Nenhum animal cadastrado.</p>

<?php endif; ?>

</body>
</html>