<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';


class Pessoas {
    public $sql = "SELECT * FROM pessoas";
    public $result = $conn->query($sql);

    public $pessoas = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pessoas[] = $row;
        }
    }
    $conn->close();

    echo json_encode($pessoas);
}




