<?php
include 'db.php';

$nome = $email = $ddi = $ddd = $telefone = "";
$nome_err = $email_err = $ddi_err = $ddd_err = $telefone_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["nome"]))) {
        $nome_err = "Por favor, insira um nome.";
    } else {
        $nome = trim($_POST["nome"]);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, insira um nome.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["ddi"]))) {
        $ddi_err = "Por favor, insira um DDI válido"
    }
}