<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';

$id = $_GET['id'];
$data = json_decode(file_get_contents('php://input'), true);

$slq = "UPDATE pessoas SET nome = $data[nome], email=$data[email], ddi=$data[ddi'], $data['ddd'], $data['telefone']) WHERE id = $id ";


var_dump($data['nome']);
var_dump($id);