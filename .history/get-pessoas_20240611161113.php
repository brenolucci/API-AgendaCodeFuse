<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';


$sql = "SELECT * FROM pessoas";
$result = $conn->query($sql);

$limit = 10;

$pessoas = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pessoas[] = $row;
    }
}
$conn->close();

$contagem = count($pessoas);
echo ($contagem);
$inicio = 1;
$fim = 10;

$pagina = array_slice($pessoas, , $limit);

echo json_encode($pagina);

