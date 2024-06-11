<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';

Interface 


final class Pessoas extends AnotherClass implements Interface
{
    $sql = "SELECT * FROM pessoas";
$result = $conn->query($sql);

$pessoas = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pessoas[] = $row;
    }
}
$conn->close();

echo json_encode($pessoas);
}




