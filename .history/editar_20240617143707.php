<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';
include 'criar.php';

try {
    $data = json_decode(file_get_contents('php://input'), true);


    
} catch {

}