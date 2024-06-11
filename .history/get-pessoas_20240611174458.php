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
        'error' => false,
        'data' => $data,
        'totalRecords' => getTotalRecords(),
    ]

} catch (\InvalidArgumentException $e) {
    
    $error = true;
    $statusCode = $e->getCode();
    $message = $e->getMessage();

} catch (\Exception $e) {
    $error = true;
    $statusCode = $e->getCode();
    $message = $e->getMessage();
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
 * @return int
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

    return ($pagina - 1) * getQuantidade(); // PQ o MySQL inicia em ZERO
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

    if (isset($_GET['nome'])) {
        $conditions[] = 'nome LIKE "%' . escapeParam($_GET['nome']) . '%"';
    }

    if (!empty($conditions)) {
        $sql = ' WHERE ' . implode(' AND ', $conditions);
    }

    return $sql;
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

/**
 * Retorna o SQL da consulta
 *
 * @return string
 */
function getSqlStatement(): string
{
    $sql = 'SELECT id, nome, ddi, ddd, telefone, email FROM pessoas';

    $conditions = getConditions();
    if (!empty($conditions)) {
        $sql .= $conditions;
    }

    return $sql . ' LIMIT ' . getPagina() . ', ' . getQuantidade();
}

/**
 * Retorna o total de registros da consulta com base nas condições e filtros informados
 *
 * @return int
 */
function getTotalRecords() : int
{
    $sql = 'SELECT COUNT(id) FROM pessoas';

    $conditions = getConditions();
    if (!empty($conditions)) {
        $sql .= $conditions;
    }

    return 12;//
}