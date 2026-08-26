<?php

include "../infra/conexao.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID inválido.");
}

$id = intval($_GET["id"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $especie = trim($_POST["especie"]);
    $raca = trim($_POST["raca"]);
    $idade = intval($_POST["idade"]);
    $descricao = trim($_POST["descricao"]);
    $usuario_id = intval($_POST["usuario_id"]);

    if (
        empty($nome) ||
        empty($especie) ||
        empty($raca) ||
        $idade < 0 ||
        $usuario_id <= 0
    ) {
        die("Preencha os campos corretamente.");
    }

    $sql = "UPDATE animais
            SET nome = ?,
                especie = ?,
                raca = ?,
                idade = ?,
                descricao = ?,
                usuario_id = ?
            WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param(
        "sssisis",
        $nome,
        $especie,
        $raca,
        $idade,
        $descricao,
        $usuario_id,
        $id
    );

    if ($stmt->execute()) {
        echo "Animal atualizado com sucesso!<br><br>";
        echo '<a href="listar_animais.php">Voltar para animais</a>';
    } else {
        echo "Erro ao atualizar animal.";
    }

    $stmt->close();
    $conexao->close();

    exit;
}

$sql = "SELECT * FROM animais WHERE id = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$resultado = $stmt->get_result();

$animal = $resultado->fetch_assoc();

if (!$animal) {
    die("Animal não encontrado.");
}

$sqlUsuarios = "SELECT id, nome FROM usuarios ORDER BY nome";

$usuarios = $conexao->query($sqlUsuarios);

?>

<h2>Editar Animal</h2>

<form method="POST">

    <label>Nome:</label><br>
    <input
        type="text"
        name="nome"
        value="<?= htmlspecialchars($animal["nome"]) ?>"
        required
    >

    <br><br>

    <label>Espécie:</label><br>
    <input
        type="text"
        name="especie"
        value="<?= htmlspecialchars($animal["especie"]) ?>"
        required
    >

    <br><br>

    <label>Raça:</label><br>
    <input
        type="text"
        name="raca"
        value="<?= htmlspecialchars($animal["raca"]) ?>"
        required
    >

    <br><br>

    <label>Idade:</label><br>
    <input
        type="number"
        name="idade"
        min="0"
        value="<?= $animal["idade"] ?>"
        required
    >

    <br><br>

    <label>Descrição:</label><br>

    <textarea name="descricao"><?= htmlspecialchars($animal["descricao"]) ?></textarea>

    <br><br>

    <label>Responsável:</label><br>

    <select name="usuario_id" required>

        <?php while ($usuario = $usuarios->fetch_assoc()): ?>

            <option
                value="<?= $usuario["id"] ?>"
                <?= $usuario["id"] == $animal["usuario_id"] ? "selected" : "" ?>
            >
                <?= htmlspecialchars($usuario["nome"]) ?>
            </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <button type="submit">Salvar alterações</button>

</form>

<br>

<a href="listar_animais.php">Voltar</a>