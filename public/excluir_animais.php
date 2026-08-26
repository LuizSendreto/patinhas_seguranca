<?php

include "../infra/conexao.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID inválido.");
}

$id = intval($_GET["id"]);

$sql = "DELETE FROM animais WHERE id = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    echo "Animal excluído com sucesso!<br><br>";

} else {

    echo "Erro ao excluir animal.";

}

$stmt->close();
$conexao->close();

?>

<a href="listar_animais.php">Voltar para animais</a>