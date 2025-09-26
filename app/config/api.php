<?php
declare(strict_types=1);

use Psr\Container\ContainerInterface;
use toubilib\api\actions\{
    ListerPraticiensAction,
    GetPraticienAction,
    GetCreneauxPraticienAction,
    GetRendezVousAction
};
use toubilib\core\application\usecases\{
    ServicePraticienInterface,
    AgendaPraticienInterface
};

return [
    ListerPraticiensAction::class => static fn (ContainerInterface $c)
        => new ListerPraticiensAction(
            $c->get(ServicePraticienInterface::class),
            $c->get(AgendaPraticienInterface::class)
        ),

    GetPraticienAction::class => static fn (ContainerInterface $c)
        => new GetPraticienAction($c->get(ServicePraticienInterface::class)),

    GetCreneauxPraticienAction::class => static fn (ContainerInterface $c)
        => new GetCreneauxPraticienAction($c->get(AgendaPraticienInterface::class)),

    GetRendezVousAction::class => static fn (ContainerInterface $c)
        => new GetRendezVousAction($c->get(AgendaPraticienInterface::class)),
];
