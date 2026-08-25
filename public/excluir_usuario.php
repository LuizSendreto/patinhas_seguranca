<?php

include "../infra/conexao.php";

if (!isset($_GET["id"])) {
    header("Location: usuario.php");
    exit;
}

$id = $_GET["id"];

$sql = "DELETE FROM usuarios WHERE id = ?";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

header("Location: usuario.php");
exit;