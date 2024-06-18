<?php
$nomeServidor = "localhost";
$nomeUsuario = "root";
$senha = "";
$nomeBanco = "agenda_db";

$conn = new mysqli($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
if ($conn->connect_error) {
    die("Conexão Falhou: " . $conn->connect_error);
}
var_dump((realpath(dirname(__FILE__) . '/') . '/functions.php'));
die;
require_once (realpath(dirname(__FILE__) . '/') . 'functions.php');
