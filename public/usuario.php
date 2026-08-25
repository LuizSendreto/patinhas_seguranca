<?php

include "../infra/conexao.php";

$sql = "SELECT * FROM usuarios ORDER BY nome";
$resultado = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Clientes - AUmigos</title>
</head>

<body>

<h1>Clientes</h1>

<a href="../index.php">Início</a> |
<a href="cadastrar_usuario.php">Cadastrar Cliente</a> |
<a href="listar_animais.php">Animais</a>

<hr>

<?php if (mysqli_num_rows($resultado) > 0): ?>

<table border="1" cellpadding="8">

<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Ações</th>
</tr>

<?php while ($cliente = mysqli_fetch_assoc($resultado)): ?>

<tr>

<td>
    <?php echo $cliente['id']; ?>
</td>

<td>
    <?php echo htmlspecialchars($cliente['nome']); ?>
</td>

<td>
    <?php echo htmlspecialchars($cliente['email']); ?>
</td>

<td>
    <a href="detalhes_usuario.php?id=<?php echo $cliente['id']; ?>">
        Ver detalhes
    </a>

    |

    <a href="editar_usuario.php?id=<?php echo $cliente['id']; ?>">
        Editar
    </a>

    |

    <a href="excluir_usuario.php?id=<?php echo $cliente['id']; ?>"
       onclick="return confirm('Deseja realmente excluir este cliente?');">
        Excluir
    </a>
</td>

</tr>

<?php endwhile; ?>

</table>

<?php else: ?>

<p>Nenhum cliente cadastrado.</p>

<?php endif; ?>

</body>
</html>