<?php

include "infra/conexao.php";

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Patinhas</title>

</head>

<body>

    <h1>Patinhas - Sistema de Clientes e Animais</h1>

    <hr>

    <h2>Clientes</h2>

    <a href="public/cadastrar_usuario.php">
        Cadastrar cliente
    </a>

    <br><br>

    <?php

    $sqlUsuarios = "SELECT id, nome, email FROM usuarios ORDER BY nome";

    $usuarios = $conexao->query($sqlUsuarios);

    ?>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
        </tr>

        <?php while ($usuario = $usuarios->fetch_assoc()): ?>

            <tr>

                <td>
                    <?= $usuario["id"] ?>
                </td>

                <td>
                    <?= htmlspecialchars($usuario["nome"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($usuario["email"]) ?>
                </td>

            </tr>

        <?php endwhile; ?>

    </table>

    <hr>

    <h2>Animais</h2>

    <a href="public/cadastrar_animais.php">
        Cadastrar animal
    </a>

    <br><br>

    <a href="public/listar_animais.php">
        Ver animais e seus responsáveis
    </a>

</body>

</html>