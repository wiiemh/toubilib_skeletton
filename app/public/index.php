<?php
use Slim\Factory\AppFactory;
use toubilib\core\application\usecases\ServicePraticien;
use toubilib\infrastructure\repositories\PDOPraticienRepository;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// --- Connexion PDO Postgres ---
$host = getenv('DB_HOST') ?: 'toubiprati.db';
$port = getenv('DB_PORT') ?: '5432';
$name = getenv('DB_NAME') ?: 'toubiprat';  // ✅
$user = getenv('DB_USER') ?: 'toubiprat';  // ✅
$pass = getenv('DB_PASS') ?: 'toubiprat';  // ✅

$pdo = new PDO(
    "pgsql:host=$host;port=$port;dbname=$name",
    $user,
    $pass,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// --- Wiring ---
$repo    = new PDOPraticienRepository($pdo);
$service = new ServicePraticien($repo);

// --- Route JSON ---
$app->get('/praticiens', function($request, $response) use ($service) {
    $payload = json_encode($service->listerPraticiens(), JSON_UNESCAPED_UNICODE);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
