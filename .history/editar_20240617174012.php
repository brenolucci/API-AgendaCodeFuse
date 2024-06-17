<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';

try{
$data = json_decode(file_get_contents('php://input'), true);

$sql = "UPDATE pessoas SET nome = '{$data['nome']}', email= '{$data['email']}', ddi= '{$data['ddi']}', ddd='{$data['ddd']}', telefone= '{$data['telefone']}' WHERE id = {$data['id']} ";

if (!mysqli_query($conn, $sql)) {
    throw new \Exception('Não foi possível alterar os dados do banco de dados!', 409);
}

$statusCode = 200;
$result = [
    'error' => false,
    'message' => 'Dados gravados com sucesso!',
    'data' => $data,
];

} catch (\Exception $e) {
    $statusCode = $e->getCode();
    $result = [
        'error' => true,
        'message' => $e->getMessage(),
    ];
}
// var_dump($sql);

// var_dump($data['nome']);
// var_dump($id);