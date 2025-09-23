<?php
declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app): App {
    // page d'accueil simple
    $app->get('/', function (Request $request, Response $response): Response {
        $response->getBody()->write('Bienvenue dans Toubilib API');
        return $response;
    });

    return $app;
};
