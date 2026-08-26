<?php

include "../infra/conexao.php";

$sql = "SELECT
            animais.id,
            animais.nome AS animal,
            animais.especie,
            animais.raca,
            animais.idade,
            animais.descricao,
            usuarios.nome AS responsavel,
            usuarios.email
        FROM animais
        INNER JOIN usuarios
            ON animais.usuario_id = usuarios.id
        ORDER BY animais.nome";

$resultado = $conexao->query($sql);

?>

<h2>Animais cadastrados</h2>

<a href="../index.php">Voltar</a>

<br><br>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Animal</th>
        <th>Espécie</th>
        <th>Raça</th>
        <th>Idade</th>
        <th>Descrição</th>
        <th>Responsável</th>
        <th>E-mail</th>
        <th>Ações</th>
    </tr>

    <?php while ($animal = $resultado->fetch_assoc()): ?>

        <tr>

            <td>
                <?= $animal["id"] ?>
            </td>

            <td>
                <?= htmlspecialchars($animal["animal"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($animal["especie"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($animal["raca"]) ?>
            </td>

            <td>
                <?= $animal["idade"] ?>
            </td>

            <td>
                <?= htmlspecialchars($animal["descricao"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($animal["responsavel"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($animal["email"]) ?>
            </td>

            <td>

                <a href="editar_animais.php?id=<?= $animal["id"] ?>">
                    Editar
                </a>

                |

                <a href="excluir_animais.php?id=<?= $animal["id"] ?>"
                   onclick="return confirm('Deseja realmente excluir este animal?');">
                    Excluir
                </a>

            </td>

        </tr>

    <?php endwhile; ?>

</table>