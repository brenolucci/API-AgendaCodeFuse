<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';
include 'criar.php';

try {
    $data = json_decode(file_get_contents('php://input'), true);

    validateData()

    

} catch (\InvalidArgumentException $e) {
    $response = [
        'error' => true,
        'message' => 'Erro na validação de dados: <br>' . $e->getMessage(),
    ];
    $statusCode = getStatusCode($e);

} catch (\PDOException $e) {
    $response = [
        'error' => true,
        'message' => 'Erro gravando dados no banco: <br>' . $e->getMessage(),
    ];
    $statusCode = getStatusCode($e);

} catch (\Exception $e) {
    $response = [
        'error' => true,
        'message' => 'Erro na requisição: <br>' . $e->getMessage(),
    ];
    $statusCode = getStatusCode($e);
}


function gravarContato(array $data): bool
{
    global $conn;

    $sql = "INSERT INTO pessoas (nome, email, ddi, ddd, telefone) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('sssss', $data['nome'], $data['email'], $data['ddi'], $data['ddd'], $data['telefone']);

    if ($stmt->execute()) {
        return true;
    } else {
        throw new \PDOException('Erro ao inserir os dados no banco de dados');
    }
}