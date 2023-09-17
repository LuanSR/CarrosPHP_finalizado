<!-- faltando fazer select de RA já existentes que no cap 9 já fiz -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Controle de alunos</title>

    <style>
        #sucess {
            color: green;
            font-weight: bold;
        }

        #error {
            color: red;
            font-weight: bold;
        }

        #warning {
            color: orange;
            font-weight: bold;
        }

    </style>

</head>

<body>

    <a href="index.html">Home</a>
    <hr>

    <h1>Cadastro de Carros</h1>
    <div>
        <form method="post" enctype="multipart/form-data">

            Código:<br>
            <input type="text" size="10" name="codCarro"><br><br>

            Nome:<br>
            <input type="text" size="30" name="nome"><br><br>

            Montadora:<br>
            <select name="montadora">
                <option></option>
                <option value="Audi">Audi</option>
                <option value="Mercedes">Mercedes</option>
                <option value="Ferrari">Ferrari</option>
                <option value="Porsche">Porsche</option>
                <option value="Mistsubishi">Mistsubishi</option>
                <option value="BMW">BMW</option>
            </select><br><br>

            Foto:<br>
            <input type="file" name="foto" accept="image/gif, image/png, image/jpg, image/jpeg"><br><br>


            <input type="submit" value="Cadastrar">

            <hr>

        </form>
    </div>

</body>
</html>

<?php
include("bd.php");

define('TAMANHO_MAXIMO', (2 * 1024 * 1024));

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    try{
            //inserindo dados
        $cod = $_POST["codCarro"];
        $nome = $_POST["nome"];
        $montadora = $_POST["montadora"];
            //foto
        $foto = $_FILES["foto"];
        $nomeFoto = $foto["name"];
        $tipoFoto = $foto["type"];
        $tamanhoFoto = $foto["size"];

        if ((trim($cod) == "") || (trim($nome) == "")) {
            echo "<span id='warning'>Código e Nome são obrigatórios!</span>";
        } else if ( ($nomeFoto != "") && 
            (!preg_match('/^image\/(jpg|jpeg|png|gif)$/', $tipoFoto)) ) {
            echo "<span id='error'>Não é uma imagem válida!</span>";
            //validação tamanho arquivo
        } else if ($tamanhoFoto > TAMANHO_MAXIMO) { 
            echo "<span id='error'>A imagem deve possuir no máximo 2 MB</span>";
        }
            else {
                cadastrar($cod, $nome, $montadora, $nomeFoto, $foto);
            }
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
?>