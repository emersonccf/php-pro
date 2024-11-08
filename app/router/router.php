<?php

function routes(): array
{
    return require 'routes.php';
}

function exactMatchUriInArrayRoutes(string $uri, array $routes): array
{
    if (array_key_exists($uri, $routes)) {
       return [];
    }
    return [];
}

function router()
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $routes = routes();
    $matchedUri = exactMatchUriInArrayRoutes($uri, $routes);
    var_dump($matchedUri);
}