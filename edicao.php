<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Controle de Carros</title>
</head>

<body>

<a href="index.html">Home</a> | <a href="consulta.php">Consulta</a>
<hr>

<h1>Edição de Carros</h1>

</body>
</html>

<?php

include("bd.php");

if (!isset($_POST["codCarro"])) {
    echo "Selecione o carro a ser editado";
} else {
    $cod = $_POST["codCarro"];

    try {

        $stmt = buscarEdicao($cod);

        $audi = "";
        $mercedes = "";
        $ferrari = "";
        $porsche = "";
        $mistsubishi = "";
        $BMW = "";

        while ($row = $stmt->fetch()) {

            //para setar o curso correto no combo
            if ($row['Montadora'] == "Audi") {
                $audi = "selected";
            } else if ($row['Montadora'] == "Mercedes") {
                $mercedes = "selected";
            } else if ($row['Montadora'] == "Ferrari") {
                $ferrari = "selected";
            } else if ($row['Montadora'] == "Porsche") {
                $porsche = "selected";
            } else if ($row['Montadora'] == "Mistsubishi") {
                $mistsubishi = "selected";
            } else if ($row['Montadora'] == "BMW") {
                $BMW = "selected";
            }

            $foto = $row['foto'];

            echo "<form method='post' enctype='multipart/form-data' action='altera.php'>\n
            Codigo:<br>\n
            <input type='text' size='10' name='codCarro' value='$row[Cod]' readonly><br><br>\n
            Nome:<br>\n
            <input type='text' size='30' name='nome' value='$row[Nome]'><br><br>\n
            Montadora:<br>\n
            <select name='montadora'>\n
                <option></option>\n
                 <option value='Audi' $audi>Audi</option>\n
                <option value='Mercedes' $mercedes>Mercedes</option>\n
                <option value='Ferrari' $ferrari>Ferrari</option>\n
                <option value='Porsche' $porsche>Porsche</option>\n
                <option value='Mistsubishi' $mistsubishi>Mistsubishi</option>\n
                 <option value='BMW' $BMW>BMW</option>\n
             </select><br><br>\n    
             Foto:<br>";
            if ($foto=="") {
              echo "-<br><br>";
            } else {
              echo  "<img src='data:image;base64,". base64_encode($foto)."' width='50px' height='50px'><br><br>";
            }
            echo "
             <input type='file' name='foto'><br><br>


             <input type='submit' value='Salvar Alterações'>\n        
             <hr>\n
            </form>";
        }

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

}

?>