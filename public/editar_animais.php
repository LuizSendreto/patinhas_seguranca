<?php

include "/infra/conexao.php";

$id = $_GET['id'];
$sql = "SELECT * FROM animais WHERE id = $id";

$resultado = mysqli_query($conexao, $sql);

$animal = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>

<form action="../public/editar_animais.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $animal['id']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $animal['nome']; ?>" required><br>

        <label for="idade">Idade:</label>
        <input type="number" name="idade" value="<?php echo $animal['idade']; ?>" required><br>

        <label for="especie">Espécie:</label>
        <input type="text" name="especie" value="<?php echo $animal['especie']; ?>" required><br>

        <label for="raca">Raça:</label>
        <input type="text" name="raca" value="<?php echo $animal['raca']; ?>" required><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required><?php echo $animal['descricao']; ?></textarea><br>

        <input type="submit" value="Atualizar">
    </form>
