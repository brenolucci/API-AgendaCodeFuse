<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';


$data = json_decode(file_get_contents('php://input'), true);

$sql = "UPDATE pessoas SET nome = '{$data['nome']}', email= '{$data['email']}', ddi= '{$data['ddi']}', ddd='{$data['ddd']}', telefone= '{$data['telefone']}' WHERE id = {$data['id']} ";

if (!mysqli_query($conn, $sql)) {
    throw new \Exception('Não foi possível alterar os dados do banco de dados!', 409);
}

$result = [
    
    'id' => $data['id'],
    'nome' => $data['nome'],
    'ddi' => $data['ddi'],
    'ddd' => $data['ddd'],
    'telefone' => $data['telefone']
    
];
// var_dump($sql);

// var_dump($data['nome']);
// var_dump($id);