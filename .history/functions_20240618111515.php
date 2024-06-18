<?php

/**
 * Valida se o statusCode da exception é um http response code válido, senão retorna erro 400
 *
 * @param \Exception $e
 * @return int
 */
function getStatusCode(\Exception $e): int
{
    return (empty($e->getCode()) || !is_numeric($e->getCode()) || $e->getCode() < 100 || $e->getCode() > 599) ? 400 : $e->getCode();
}

/**
 * Aplica funções de escape na variável
 *
 * @param string $param
 * @return string
 */
function escapeParam(string $param): string
{
    return addslashes(htmlspecialchars(trim($param)));
}

/**
 * Valida se a request do usuário é um POST
 * 
 * @param string|array $requestType
 * @throws \Exception
 * @return bool
 */
function validateRequestType(string|array $requestType): bool
{
    if (strtoupper($_SERVER["REQUEST_METHOD"]) !== $requestType) {
        throw new \Exception('Tipo de requisição inválido!', 405);
    }

    return true;
}