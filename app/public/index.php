<?php
declare(strict_types=1);

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use toubilib\infrastructure\repositories\PDOPraticienRepository;
use toubilib\core\application\usecases\ServicePraticien;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

/**
 * IMPORTANT en Slim 4 : ajouter le routing middleware
 * Sinon => HttpNotFoundException même si les routes existent.
 */
$app->addRoutingMiddleware();

// (optionnel) jolis messages d’erreurs en dev
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// --- Connexion PDO Postgres ---
$host = getenv('DB_HOST') ?: 'toubiprati.db';
$port = getenv('DB_PORT') ?: '5432';
$name = getenv('DB_NAME') ?: 'toubiprat';
$user = getenv('DB_USER') ?: 'toubiprat';
$pass = getenv('DB_PASS') ?: 'toubiprat';

$pdo = new PDO(
    "pgsql:host=$host;port=$port;dbname=$name",
    $user,
    $pass,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// --- Wiring ---
$repo    = new PDOPraticienRepository($pdo);
$service = new ServicePraticien($repo);

// --- Routes de test ---
// Accueil
$app->get('/', function (Request $request, Response $response): Response {
    $response->getBody()->write('Bienvenue dans Toubilib API');
    return $response;
});

// Liste praticiens
$app->get('/praticiens', function (Request $request, Response $response) use ($service): Response {
    $payload = json_encode($service->listerPraticiens(), JSON_UNESCAPED_UNICODE);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
