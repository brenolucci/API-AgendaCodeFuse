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

    return true;
}

function validarRequest(string $nome) : bool
{
    $requiredFields = ['nome', 'email',];

    $errors = [];
    foreach ($_POST as $field => $value) {
        if (!in_array($field, $requiredFields)) {
            $errors[] = "O campo {$field} não está na lista de campos permitidos!";
        }
    }

    return true;
}

function validarNome(string $nome) : bool
{
    if (empty(trim($_POST["nome"]))) {
        $nome_err = "Por favor, insira um nome.";
    } else {
        $nome = trim($_POST["nome"]);
    }
}