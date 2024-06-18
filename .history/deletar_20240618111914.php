<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: DELETE");

include 'db.php';

try {
    var_dump(validateRequestType(['POST']));
    echo 'FIM';
    die;
    $id = $_GET['id'];

    $sql = "DELETE FROM pessoas WHERE id = $id";

    if (!mysqli_query($conn, $sql)) {
        throw new \Exception('Não foi possível deletar os dados do banco de dados!', 422); // Unprocessable entity
    } else {
        $statusCode = 200;
        $response = [
            'message' => 'Contato excluído com sucesso!',
        ];
    }

    $conn->close();

} catch (\Exception $e) {
    $response = [
        'error' => true,
        'message' => $e->getMessage(),
    ];
    $statusCode = $e->getCode();
}


header('Content-type: application/json');
http_response_code($statusCode);
if (!empty($response)) {
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
