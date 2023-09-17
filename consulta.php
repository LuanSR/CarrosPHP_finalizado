<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Controle de Carros</title>
</head>

<body>

<a href="index.html">Home</a>
<hr>

<h1>Consulta de Carros</h1>
<div>
    <form method="post">

        Código:<br>
        <input type="text" size="10" name="codCarro">
        <input type="submit" value="Consultar">
        <hr>
    </form>
</div>

</body>
</html>

<?php
    include("bd.php");

     if ($_SERVER["REQUEST_METHOD"] === 'POST') {

         try {

             $stmt = consultar();

             echo "<form method='post'><table border='1px'>";
             echo "<tr><th></th><th>Código</th><th>Nome</th><th>Montadora</th><th>Foto</th></tr>";

             while ($row = $stmt->fetch()) {
                 echo "<tr>";
                 echo "<td><input type='radio' name='codCarro' 
                      value='" . $row['Cod'] . "'>";
                 echo "<td>" . $row['Cod'] . "</td>";
                 echo "<td>" . $row['Nome'] . "</td>";
                 echo "<td>" . $row['Montadora'] . "</td>";
                  if ($row["foto"] == null) {
                     echo "<td align='center'> - </td>";
                 } else {
                    echo "<td align='center'><img src='data:image;base64,".base64_encode($row["foto"])."' width='50px' height='50px'></td>";
                    //base64 - Maneira de codificar dados binários em texto ASCII, informando ao navegador que os dados estão embutidos em uma imagem.
                 }
                 echo "</tr>";
             }


             echo "</table><br>
             
             <button type='submit' formaction='remove.php'>Excluir Carro</button>
             <button type='submit' formaction='edicao.php'>Editar Carro</button>
             
             </form>";

         } catch (PDOException $e) {
             echo 'Error: ' . $e->getMessage();
         }

     }
?>