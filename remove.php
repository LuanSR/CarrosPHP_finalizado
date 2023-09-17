<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Controle de Carros</title>
</head>

<body>

<a href="index.html">Home</a> | <a href="consulta.php">Consulta</a>
<hr>

<h1>Exclusão de Carros</h1>

</body>
</html>

<?php

include("bd.php");

if (!isset($_POST["codCarro"])) {
    echo "Selecione o carro a ser excluído";
} else {
    $cod = $_POST["codCarro"];
    excluir($cod);
}

?>