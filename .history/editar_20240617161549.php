<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';


$data = json_decode(file_get_contents('php://input'), true);

$sql = "UPDATE pessoas SET nome = '$data[nome]', email= '$data[email]', ddi= '$data[ddi]', ddd= '$data[ddd]', telefone= '$data[telefone]' WHERE id = id ";

if (!mysqli_query($conn, $sql)) {
    throw new \Exception('Não foi possível alterar os dados do banco de dados!', 409);
} else {
    echo 'Contato editado com sucesso!';
}

// var_dump($sql);

// var_dump($data['nome']);
// var_dump($id);