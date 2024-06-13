<?php
$nomeServidor = "localhost";
$nomeUsuario = "root";
$senha = "";
$nomeBanco = "agenda_db";

$conn = new mysqli($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
var_dump
if ($conn->connect_error) {
    die("Conexão Falhou: " . $conn->connect_error);
}
