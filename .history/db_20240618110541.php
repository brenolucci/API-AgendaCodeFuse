<?php
$nomeServidor = "localhost";
$nomeUsuario = "root";
$senha = "";
$nomeBanco = "agenda_db";

$conn = new mysqli($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
if ($conn->connect_error) {
    die("Conexão Falhou: " . $conn->connect_error);
}

include 'functions.php';
