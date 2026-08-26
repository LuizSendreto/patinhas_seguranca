<?php

include "../infra/conexao.php";

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

    $sql = "INSERT INTO animais
            (nome, especie, raca, idade, descricao, usuario_id)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar a consulta.");
    }

    $stmt->bind_param(
        "sssisi",
        $nome,
        $especie,
        $raca,
        $idade,
        $descricao,
        $usuario_id
    );

    if ($stmt->execute()) {
        echo "Animal cadastrado com sucesso!<br><br>";
        echo '<a href="../index.php">Voltar</a>';
    } else {
        echo "Erro ao cadastrar animal.";
    }

    $stmt->close();
    $conexao->close();

    exit;
}

$sql = "SELECT id, nome FROM usuarios ORDER BY nome";

$resultado = $conexao->query($sql);

?>

<h2>Cadastrar Animal</h2>

<form method="POST">

    <label>Nome do animal:</label><br>
    <input type="text" name="nome" required>

    <br><br>

    <label>Espécie:</label><br>
    <input type="text" name="especie" required>

    <br><br>

    <label>Raça:</label><br>
    <input type="text" name="raca" required>

    <br><br>

    <label>Idade:</label><br>
    <input type="number" name="idade" min="0" required>

    <br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao"></textarea>

    <br><br>

    <label>Responsável:</label><br>

    <select name="usuario_id" required>

        <option value="">Selecione o responsável</option>

        <?php while ($usuario = $resultado->fetch_assoc()): ?>

            <option value="<?= $usuario["id"] ?>">
                <?= htmlspecialchars($usuario["nome"]) ?>
            </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <button type="submit">Cadastrar animal</button>

</form>

<br>

<a href="../index.php">Voltar</a>