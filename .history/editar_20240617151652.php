<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: DELETE");

include 'db.php';

$id = $_GET['id'];
$data = json_decode(file_get_contents('php://input'), true);




var_dump($data['nome']);
var_dump($id);