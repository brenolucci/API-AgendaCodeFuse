<?php

include 'db.php';

$nome = $email = $ddi = $ddd = $telefone = "";
$nome_err = $email_err = $ddi_err = $ddd_err = $telefone_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    validarDados($_POST);

    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, insira um nome.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["ddi"]))) {
        $ddi_err = "Por favor, insira um DDI válido.";
    } else {
        $ddi = trim($_POST["ddi"]);
    }

    if (empty(trim($_POST["ddd"]))) {
        $ddd_err = "Por favor, insira um DDD válido.";
    } else {
        $ddd = trim($_POST["ddd"]);
    }
}

function validarDados(array $dados) : bool
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
function validarRequest(array $postData) : bool
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
 * Undocumented function
 *
 * @param string $nome
 * @throws \InvalidArgumentException
 * @return bool
 */
function validarNome(string $nome) : bool
{
    if (empty())) {
        throw new \InvalidArgumentException('Por favor, insira um nome.');
    }

    return true;
}