<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';


$sql = "SELECT * FROM pessoas";
$result = $conn->query($sql);




function paginaContatos($inicio, $limite) {
$contagem = count($pessoas);
echo ($contagem);
$inicio = 10;
$fim = 10;
}
$pagina = array_slice($pessoas, $inicio, $limit);

echo json_encode($pagina);

