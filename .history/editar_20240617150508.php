<?php
include 'db.php';

$query = '';
$table_data = '';

$data = json_decode(file_get_contents('php://input'), true);

$query = 
"INSERT INTO pessoas VALUES ('".$row["name"]."', '".$row["email"]."', '".$row["ddi"]."', '".$row["ddi"]."'); ";