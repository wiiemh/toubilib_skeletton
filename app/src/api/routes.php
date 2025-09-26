<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use toubilib\core\application\usecases\ServicePraticienInterface;

return function (App $app): void {

    // GET /praticiens -> liste des praticiens en JSON
    $app->get('/praticiens', function (Request $request, Response $response) {
        /** @var ServicePraticienInterface $service */
        $service = $this->get(ServicePraticienInterface::class);

        $dtos = $service->listerPraticiens();
        $payload = array_map(fn($dto) => $dto->toArray(), $dtos);

        $response->getBody()->write(json_encode($payload, JSON_UNESCAPED_UNICODE));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });

};
