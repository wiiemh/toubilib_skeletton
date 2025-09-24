<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use toubilib\api\middlewares\Cors;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    'displayErrorDetails' => true
]);
$container = $containerBuilder->build();

AppFactory::setContainer($container);
$app = AppFactory::create();


$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware($container->get('displayErrorDetails'), false, false)
    ->getDefaultErrorHandler()
    ->forceContentType('application/json')
;

$app = (require_once __DIR__ . '/../src/api/routes.php')($app);


return $app;