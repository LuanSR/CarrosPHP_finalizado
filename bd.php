<?php

function conectarBD() {
 $pdo = new PDO("mysql:host=143.106.241.3;dbname=cl201273;charset=utf8", "cl201273", "MarcosLeonardo18");
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 return $pdo;
}

function cadastrar($cod, $nome, $montadora, $nomeFoto, $foto) {
    try {
        $pdo = conectarBD();
        $rows = verificarCadastro($cod, $pdo);

        if ($rows <= 0) {
            if ($nomeFoto == "") {
                $fotoBinario = null;
            } else {
                        // Lendo o conteudo do arq para uma var
                $fotoBinario = file_get_contents($foto['tmp_name']);
            }
            $stmt = $pdo->prepare("insert into carrosPHP (Cod, Nome, Montadora, foto) values(:cod, :nome, :montadora, :foto)");
            $stmt->bindParam(':cod', $cod);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':montadora', $montadora);
            $stmt->bindParam(':foto', $fotoBinario);
            $stmt->execute();
            echo "<span id='sucess'>Carro Cadastrado!</span>";
        } else {
            echo "<span id='error'>Este código já existente!</span>";
        }
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


function verificarCadastro($cod, $pdo) {

    $stmt = $pdo->prepare("select * from carrosPHP where Cod = :cod");
    $stmt->bindParam(':cod', $cod);
    $stmt->execute();

    $rows = $stmt->rowCount();
    return $rows;
}

function consultar() {
    $pdo = conectarBD();
    if (isset($_POST["codCarro"]) && ($_POST["codCarro"] != "")) {
        $cod = $_POST["codCarro"];
        $stmt = $pdo->prepare("select * from carrosPHP where Cod = :cod order by Montadora, Nome");
        $stmt->bindParam(':cod', $cod);
    } else {
        $stmt = $pdo->prepare("select * from carrosPHP order by Montadora, Nome");
    }

    $stmt->execute();

    return $stmt;
}

function buscarEdicao($cod) {
    $pdo = conectarBD();
    $stmt = $pdo->prepare('select * from carrosPHP where Cod = :cod');
    $stmt->bindParam(':cod', $cod);
    $stmt->execute();
    return $stmt;
}

function alterar($cod, $novoNome, $novaMontadora, $novaFoto, $nomeFoto) {
    try {
        $pdo = conectarBD();
        if ($nomeFoto != "") {
        // Lendo o conteudo do arq para uma var
        $fotoBinario = file_get_contents($novaFoto['tmp_name']);
        $stmt = $pdo->prepare('update carrosPHP SET Nome = :novoNome, Montadora = :novaMontadora, foto = :novaFoto where Cod = :cod');
        $stmt->bindParam(':novoNome', $novoNome);
        $stmt->bindParam(':novaMontadora', $novaMontadora);
        $stmt->bindParam(':novaFoto', $fotoBinario);
        $stmt->bindParam(':cod', $cod);
    } else {
        $stmt = $pdo->prepare('update carrosPHP SET nome = :novoNome, Montadora = :novaMontadora where Cod = :cod');
        $stmt->bindParam(':novoNome', $novoNome);
        $stmt->bindParam(':novaMontadora', $novaMontadora);
        $stmt->bindParam(':cod', $cod);
    }
        $stmt->execute();
        echo "Os dados do carro de código $cod foram alterados!";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

function excluir($cod) {
    try {
        $pdo = conectarBD();
        $stmt = $pdo->prepare('delete from carrosPHP where Cod = :cod');
        $stmt->bindParam(':cod', $cod);
        $stmt->execute();

        echo $stmt->rowCount() . " Carro de código $cod removido!";

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

?>