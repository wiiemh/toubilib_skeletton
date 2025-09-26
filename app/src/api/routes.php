<?php
declare(strict_types=1);

use Slim\App;
use toubilib\api\actions\{
    ListerPraticiensAction,
    GetPraticienAction,
    GetCreneauxPraticienAction,
    GetRendezVousAction,
    AnnulerRendezVousAction,
    ConsulterAgendaAction,
};

return function (App $app): void {
    $app->get(
        '/',
        fn($req, $res) =>
        $res->getBody()->write('Bienvenue dans Toubilib API') ? $res : $res
    );

    $app->get('/praticiens', ListerPraticiensAction::class);
    $app->get('/praticiens/{id}', GetPraticienAction::class);
    $app->get('/praticiens/{id}/creneaux', GetCreneauxPraticienAction::class);
    $app->get('/rdv/{id}', GetRendezVousAction::class);
    $app->delete('/annulerrdv/{id}', AnnulerRendezVousAction::class);
    $app->get('/agenda/{id}', ConsulterAgendaAction::class);


};
