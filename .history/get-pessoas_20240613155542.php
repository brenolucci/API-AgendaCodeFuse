<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';

$data = [];
try {

    $sql = getSqlStatement();

    $result = $conn->query($sql);

    $limit = 20;

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    $conn->close();

    $statusCode = 200;
    $result = [
        'totalRecords' => getTotalRecords($conn),
        'totalPages' => totalPaginas($conn),
        'data' => $data,
    ];

} catch (\InvalidArgumentException $e) {
    $result = [
        'error' => true,
        'message' => $e->getMessage(),
    ];

} catch (\Exception $e) {
    $result = [
        'error' => true,
        'message' => $e->getMessage(),
    ];
}

http_response_code($statusCode);
echo json_encode($result);


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
    return $_GET['limit'] ?? 10;
}

/**
 * Retorna o início da paginação.
 * Efetua o cálculo do Offset de acordo com o número da página informada
 * e quantidade de registros desejadas.
 * 
 * @param mysqli $conn
 * @return int
 */
function getPagina(mysqli $conn): int
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

    $totalPaginas = totalPaginas($conn);
    if ($pagina > $totalPaginas) {
        throw new InvalidArgumentException("Número da página deve terminar em {$totalPaginas}!", 422);
    }

    return ($pagina - 1) * getQuantidade();
}

/**
 * Valida as query params e retorna a instrução WHERE com as condições de pesquisa
 *
 * @return string
 */
function getConditions(): string
{
    $sql = '';
    $conditions = [];

    if (!empty($_GET['nome'])) {
        $conditions[] = 'nome LIKE "%' . escapeParam($_GET['nome']) . '%"';
    }
    if (!empty($_GET['email'])) {
        $conditions[] = 'email LIKE "%' . escapeParam($_GET['email']) . '%"';
    }
    if (!empty($_GET['ddi'])) {
        $conditions[] = 'ddi LIKE "%' . escapeParam($_GET['ddi']) . '%"';
    }
    if (!empty($_GET['ddd'])) {
        $conditions[] = 'ddd LIKE "%' . escapeParam($_GET['ddd']) . '%"';
    }
    if (!empty($_GET['telefone'])) {
        $conditions[] = 'telefone LIKE "%' . escapeParam($_GET['telefone']) . '%"';
    }

    if (!empty($conditions)) {
        $sql = ' WHERE ' . implode(' AND ', $conditions);
    }

    return $sql;
}

/**
 * Calcula o total de páginas
 * 
 * @param mysqli $conn
 * @return int
 */
function totalPaginas(mysqli $conn): int
{
    return ceil(getTotalRecords($conn) / getQuantidade());
}

/**
 * Retorna o SQL da consulta
 *
 * @param mysqli $conn
 * @return string
 */
function getSqlStatement(mysqli $conn): string
{
    $sql = 'SELECT id, nome, ddi, ddd, telefone, email FROM pessoas';

    $conditions = getConditions();
    if (!empty($conditions)) {
        $sql .= $conditions;
    }

    return $sql . ' LIMIT ' . getPagina($conn) . ', ' . getQuantidade();
}

/**
 * Retorna o total de registros da consulta com base nas condições e filtros informados,
 * 
 * @param mysqli $conn
 * @return int
 */
function getTotalRecords(mysqli $conn): int
{
    $sql = 'SELECT COUNT(id) FROM pessoas';

    $conditions = getConditions();
    if (!empty($conditions)) {
        $sql .= $conditions;
    }
    $result = $conn->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    $conn->close();
    return 12;//
}