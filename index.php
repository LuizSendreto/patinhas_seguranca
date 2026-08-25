<?php

include "infra/conexao.php";

// Buscar clientes
$clientes = mysqli_query($conexao, "SELECT * FROM usuarios");

// Buscar animais
$animais = mysqli_query($conexao, "SELECT * FROM animais");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>AUmigos - Pet Shop</title>
</head>

<body>

    <h1>AUmigos</h1>

    <p>Pet Shop - Sistema de gerenciamento</p>

    <hr>

    <h2>Menu</h2>

    <a href="index.php">Início</a> |
    <a href="public/usuario.php">Clientes</a> |
    <a href="public/listar_animais.php">Animais</a>

    <hr>

    <h2>Clientes</h2>

    <p>
        <a href="public/cadastrar_usuario.php">
            Cadastrar Cliente
        </a>
    </p>

    <?php

    if (mysqli_num_rows($clientes) > 0) {

        echo "<table border='1' cellpadding='8'>";

        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nome</th>";
        echo "<th>Email</th>";
        echo "</tr>";

        while ($cliente = mysqli_fetch_assoc($clientes)) {

            echo "<tr>";

            echo "<td>";
            echo $cliente['id'];
            echo "</td>";

            echo "<td>";
            echo htmlspecialchars($cliente['nome']);
            echo "</td>";

            echo "<td>";
            echo htmlspecialchars($cliente['email']);
            echo "</td>";

            echo "</tr>";
        }

        echo "</table>";

    } else {

        echo "<p>Nenhum cliente cadastrado.</p>";

    }

    ?>
l
    <hr>

    <h2>Animais</h2>

    <p>
        <a href="public/cadastrar_animais.php">
            Cadastrar Animal
        </a>
    </p>

    <?php

    if (mysqli_num_rows($animais) > 0) {

        echo "<table border='1' cellpadding='8'>";

        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nome</th>";
        echo "<th>Espécie</th>";
        echo "<th>Raça</th>";
        echo "<th>Idade</th>";
        echo "</tr>";

        while ($animal = mysqli_fetch_assoc($animais)) {

            echo "<tr>";

            echo "<td>";
            echo $animal['id'];
            echo "</td>";

            echo "<td>";
            echo htmlspecialchars($animal['nome']);
            echo "</td>";

            echo "<td>";
            echo htmlspecialchars($animal['especie']);
            echo "</td>";

            echo "<td>";
            echo htmlspecialchars($animal['raca']);
            echo "</td>";

            echo "<td>";
            echo $animal['idade'];
            echo " anos";
            echo "</td>";

            echo "</tr>";
        }

        echo "</table>";

    } else {

        echo "<p>Nenhum animal cadastrado.</p>";

    }

    ?>

    <hr>

    <h2>Informações</h2>

    <p>
        Sistema de gerenciamento da AUmigos.
    </p>

    <p>
        Clientes cadastrados:
        <?php echo mysqli_num_rows($clientes); ?>
    </p>

    <p>
        Animais cadastrados:
        <?php echo mysqli_num_rows($animais); ?>
    </p>

</body>

</html>