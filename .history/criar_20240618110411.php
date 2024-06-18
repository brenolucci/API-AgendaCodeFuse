<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';

$nome = $email = $ddi = $ddd = $telefone = "";
$nome_err = $email_err = $ddi_err = $ddd_err = $telefone_err = "";

try {
    $data = json_decode(file_get_contents('php://input'), true);

    validateData($data);

    gravarContato($data);

    $response = [
        'error' => false,
        'message' => 'Dados gravados com sucesso!',
    ];
    $statusCode = 201;

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

header('Content-type: application/json');
http_response_code($statusCode);
if (!empty($response)) {
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

/**
 * Executa a validação dos dados enviados pelo form
 *
 * @param array $dados
 * @return boolean
 */
function validateData(array $dados): bool
{
    validateRequestType();

    validateRequest($dados);

    validateNome($dados['nome']);

    return true;
}

/**
 * Valida se a request do usuário é um POST
 * 
 * @throws \Exception
 * @return bool
 */
function validateRequestType(): bool
{
    if (strtoupper($_SERVER["REQUEST_METHOD"]) !== 'POST') {
        throw new \Exception('Tipo de requisição inválido!', 405);
    }

    return true;
}

/**
 * Valida se os campos obrigatórios foram informados
 *
 * @param array $postData
 * @throws \InvalidArgumentException
 * @return bool
 */
function validateRequest(array $postData): bool
{
    $requiredFields = ['nome', 'email', 'ddi', 'ddd', 'telefone'];

    $errors = [];
    foreach ($requiredFields as $field) {
        if (empty($postData[$field])) {
            $errors[] = "O campo {$field} é obrigatório!";
        }
    }

    if (!empty($errors)) {
        throw new \InvalidArgumentException('Os seguintes erros foram encontrados!<br>' . implode('<br>', $errors), 422);
    }

    return true;
}

/**
 * Realiza a validação do nome do contato
 * 
 * @param string $nome
 * @throws \InvalidArgumentException
 * @return bool
 */
function validateNome(string $nome): bool
{
    $nome = trim($nome);
    if (empty($nome)) {
        throw new \InvalidArgumentException('Nome: preenchimento obrigatório!');
    }

    if (strlen($nome) > 45) {
        throw new \InvalidArgumentException('O nome deve conter no máximo 45 caracteres.');
    }

    if (strlen($nome) < 3) {
        throw new \InvalidArgumentException('O nome deve conter no mínimo 3 caracteres.');
    }

    return true;
}


/**
 * Grava os dados no banco de dados
 *
 * @param array $data
 * @return bool
 */
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
