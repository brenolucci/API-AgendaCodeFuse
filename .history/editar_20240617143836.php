<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';
include 'criar.php';

try {
    $data = json_decode(file_get_contents('php://input'), true);

    criar.p

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