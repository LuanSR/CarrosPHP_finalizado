<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Controle de Carros</title>
</head>

<body>

<a href="index.html">Home</a> | <a href="consulta.php">Consulta</a>
<hr>

<h2>Edição de Alunos</h2>

</body>
</html>

<?php

    include("bd.php");

    $cod = $_POST['codCarro'];
    $novoNome = $_POST['nome'];
    $novaMontadora = $_POST['montadora'];
    $novaFoto = $_FILES['foto'];
    $nomeFoto = $novaFoto['name'];
    $tipoFoto = $novaFoto['type'];
    $tamanhoFoto = $novaFoto['size'];

    alterar($cod, $novoNome, $novaMontadora, $novaFoto, $nomeFoto);

?>