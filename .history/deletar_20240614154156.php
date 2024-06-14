<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';

$id = 3;

if ($id != "") {
    $delete = "DELETE FROM pessoas WHERE id = $id ";
    $result = $conn->query($result);
    ;

    if (!$result) {
        throw new \Exception('Não foi possível deletar os dados do banco de dados!', 409); // 409 conflict statusCode
    } else {

    }

}