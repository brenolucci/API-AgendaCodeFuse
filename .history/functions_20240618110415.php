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