<?php
$nomeServidor = "localhost";
$nomeUsuario = "";
$senha = "YES";
$nomeBanco = "agenda_db";

$conn = new mysqli($nomeServidor, $nomeUsuario, $senha, $nomeBanco);

if ($conn->connect_error) {
    die("Conexão Falhou: " . $conn->connect_error);
}