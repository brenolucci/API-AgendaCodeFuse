<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';

$id = $_GET['id'];

if ($_GET['id'] != "") {
    $delete = "DELETE FROM pessoas WHERE id = " . $_GET['id'];
    $result = mysql_query($delete);

    if (!$result) {
        throw new \Exception('Não foi possível deletar os dados do banco de dados!', 409); // 409 conflict statusCode
    } else {

    }

}