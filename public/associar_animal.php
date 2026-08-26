<?php

include "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $animal_id = intval($_POST["animal_id"]);
    $usuario_id = intval($_POST["usuario_id"]);

    if ($animal_id <= 0 || $usuario_id <= 0) {
        die("Selecione um animal e um responsável.");
    }

    $sql = "UPDATE animais
            SET usuario_id = ?
            WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar a consulta.");
    }

    $stmt->bind_param("ii", $usuario_id, $animal_id);

    if ($stmt->execute()) {
        echo "Animal associado ao responsável com sucesso!<br><br>";
        echo '<a href="../index.php">Voltar para o início</a>';
    } else {
        echo "Erro ao associar animal.";
    }

    $stmt->close();
    $conexao->close();

    exit;
}

$animais = $conexao->query(
    "SELECT id, nome FROM animais ORDER BY nome"
);

$usuarios = $conexao->query(
    "SELECT id, nome FROM usuarios ORDER BY nome"
);

?>

<h2>Associar Animal a um Responsável</h2>

<form method="POST">

    <label>Animal:</label><br>

    <select name="animal_id" required>

        <option value="">Selecione o animal</option>

        <?php while ($animal = $animais->fetch_assoc()): ?>

            <option value="<?= $animal["id"] ?>">
                <?= htmlspecialchars($animal["nome"]) ?>
            </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <label>Responsável:</label><br>

    <select name="usuario_id" required>

        <option value="">Selecione o responsável</option>

        <?php while ($usuario = $usuarios->fetch_assoc()): ?>

            <option value="<?= $usuario["id"] ?>">
                <?= htmlspecialchars($usuario["nome"]) ?>
            </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <button type="submit">
        Associar
    </button>

</form>

<br>

<a href="../index.php">Voltar</a>