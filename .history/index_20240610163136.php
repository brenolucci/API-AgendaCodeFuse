<?php
include 'db.php';

$sql = "SELECT * FROM pessoas";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>AGENDA</title>
</head>

<body>
    <h1>Lista de Contatos</h1>
    <a href="criar.php">Adicionar um novo contato</a>
    <table border="1">

    </table>
</body>




</html>