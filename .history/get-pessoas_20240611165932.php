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
$limite = getQuantidade();

$sql .= " LIMIT {$offset}, {$limite}";

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
function getQuantidade(): int
{
    $defaultPaging = 0;

    if (!isset($_GET['limite'])) {
        return $defaultPaging;
    }

    $limite = (int) trim($_GET['limite']);
    if (empty($limite)) {
        throw new InvalidArgumentException('Número da página inválido!', 422);
    }

    if ($limite <= 0) {
        throw new InvalidArgumentException('Número da página deve iniciar em 1!', 422);
    }

    $totalPaginas = totalPaginas();
    if ($limite > $totalPaginas) {
        throw new InvalidArgumentException("Número da página deve terminar em {$totalPaginas}!", 422);
    }

    return ($limite - 1) * getOffset(); // PQ o MySQL inicia em ZERO
}

/**
 * Retorna o início da paginação, a partir de qual registro será obtido o resultado. "AKA Página"
 * 
 * @return int
 */
function getOffset(): int
{
    return $_GET['offset'] ?? 0;
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