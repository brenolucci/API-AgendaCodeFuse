<?php
include 'db.php';

$nome = $email = $ddi = $ddd = $telefone = "";
$nome_err = $email_err = $ddi_err = $ddd_err = $telefone_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_POST["nome"]))) {
        $nome_err = "Por favor, insira um nome."
    } else {
        $nome = trim($_POST)
    }
}