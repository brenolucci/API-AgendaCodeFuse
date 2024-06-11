<?php

include 'db.php';

$nome = $email = $ddi = $ddd = $telefone = "";
$nome_err = $email_err = $ddi_err = $ddd_err = $telefone_err = "";

try {
    if (strtoupper($_SERVER["REQUEST_METHOD"]) === 'POST') {

        validarDados($_POST);

        // Segue o baile
        // Gravar os dados

        // Monta o response
        $response = [
            'error' => false,
            'message' => 'Dados gravados com sucesso!',
        ];
        $statusCode = 200;
    }

} catch (\InvalidArgumentException $e) {
    $response = [
        'error' => true,
        'message' => 'Erro na validação de dados: <br>' . $e->getMessage(),
    ];
    $statusCode = getStatusCode($e);
} catch (\PDOException) {
    $response = [
        'error' => true,
        'message' => 'Erro gravando dados no banco: <br>' . $e->getMessage(),
    ];
    $statusCode = getStatusCode($e);
}

header('Content-type: application/json');
header('http_status', $statusCode);
echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

/**
 * Executa a validação dos dados enviados pelo form
 *
 * @param array $dados
 * @return boolean
 */
function validarDados(array $dados): bool
{
    validarRequest($dados);

    validarNome($dados['nome']);

    return true;
}

/**
 * Valida se os campos obrigatórios foram informados
 *
 * @param array $postData
 * @throws \InvalidArgumentException
 * @return bool
 */
function validarRequest(array $postData): bool
{
    $requiredFields = ['nome', 'email',];

    $errors = [];
    foreach ($postData as $field => $value) {
        if (!in_array($field, $requiredFields)) {
            $errors[] = "O campo {$field} não está na lista de campos permitidos!";
        }
    }

    if (!empty($errors)) {
        throw new \InvalidArgumentException('Os erros erros foram encontrados!<br>' . implode('<br>', $errors), 422);
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
function validarNome(string $nome): bool
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
 * Valida se o statusCode da exception é um http response code válido, senão retorna erro 400
 *
 * @param \Exception $e
 * @return int
 */
function getStatusCode(\Exception $e): int
{
    return (empty($e->getCode()) || !is_numeric($e->getCode()) || $e->getCode() < 100 || $e->getCode() > 599) ? 400 : $e->getCode();
}