<?php
include 'db.php';

$id = _GET
$table_data = '';

$data = json_decode(file_get_contents('php://input'), true);

$query =
    "INSERT INTO pessoas VALUES ('" . $row["name"] . "', '" . $row["email"] . "', '" . $row["ddi"] . "', '" . $row["ddd"] . "', '" . $row["telefone"] . "'); ";