<?php
$nomeServidor = "localhost";
$nomeUsuario = "";
$senha = "agenda_db";
$nomeBanco = "agenda_db";

$conn = new mysqli($nomeServidor, $nomeUsuario, $senha, $nomeBanco);

if ($conn->connect_error) {
    die
}