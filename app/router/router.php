<?php
// https://regexr.com/

function routes(): array
{
    return require 'routes.php';
}

//função para uri estática
function exactMatchUriInArrayRoutes(string $uri, array $routes): array
{
    if (array_key_exists($uri, $routes)) {
       return [$uri => $routes[$uri]];
    }
    return [];
}

//função para uri dinâmica
function regulaExpressionMatchUriInArrayRoutes(string $uri, array $routes): array
{
    return array_filter($routes, function ($value) use ($uri) {
        $regex = str_replace('/', '\/', ltrim($value, '/'));
        return preg_match("/^$regex$/", ltrim($uri, '/'));
    }, ARRAY_FILTER_USE_KEY
    );
}

//função onde as rotas realmente acontecem
function router()
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $routes = routes();

    //uri estática
    $matchedUri = exactMatchUriInArrayRoutes($uri, $routes);

    //uri dinâmica
    if(empty($matchedUri)) {
        $matchedUri = regulaExpressionMatchUriInArrayRoutes($uri, $routes);
    }

    var_dump($matchedUri);
}