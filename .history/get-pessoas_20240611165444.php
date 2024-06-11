<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';

$conditions = [];

$sql = "SELECT * FROM pessoas";
if (isset($_GET['nome'])) {
    $conditions[] = 'nome LIKE %' . escapeParam($_GET['nome']) . '%';
}

if (!empty($conditions)) {
    $sql .= 'WHERE ' . implode(' AND ', $conditions);
}
// 
$offset = getOffset();
$pagina = getPagina();

$sql .= " LIMIT {$pagina}, {$offset}";

echo $sql;
die;

$result = $conn->query($sql);

$limit = 20;

$pessoas = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pessoas[] = $row;
    }
}
$conn->close();


$contagem = count($pessoas);
echo ($contagem);
$inicio = 10;
$fim = 10;

$pagina = array_slice($pessoas, $inicio, $limit);

echo json_encode($pagina);

function validateQueryParams(array $params)
{
    // foreach ($params as $param) {
    //     if (!in_array($))
    // }
}

function escapeParam(string $param): string
{
    return addslashes(htmlspecialchars(trim($param)));
}

/**
 * Obtém o número da página
 *
 * @return integer
 */
function getPagina(): int
{
    $defaultPaging = 0;

    if (!isset($_GET['pagina'])) {
        return $defaultPaging;
    }

    $pagina = (int) trim($_GET['pagina']);
    if (empty($pagina)) {
        throw new InvalidArgumentException('Número da página inválido!', 422);
    }

    if ($pagina <= 0) {
        throw new InvalidArgumentException('Número da página deve iniciar em 1!', 422);
    }

    $totalPaginas = totalPaginas();
    if ($pagina > $totalPaginas) {
        throw new InvalidArgumentException("Número da página deve terminar em {$totalPaginas}!", 422);
    }

    return $pagina - 1; // PQ o MySQL inicia em ZERO
}

/**
 * Retorna a quantidade de registro por página
 *
 * @return int
 */
function getOffset(): int
{
    return $_GET['offset'] ?? 10;
}

/**
 * Calcula o total de páginas
 *
 * @return int
 */
function totalPaginas(): int
{
    return 100;// Calcular o total da página
}