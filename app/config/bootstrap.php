<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use toubilib\core\application\usecases\ServicePraticienInterface;
use toubilib\core\application\usecases\ServicePraticien;
use toubilib\core\domain\entities\praticien\repositories\PraticienRepositoryInterface;
use toubilib\infrastructure\repositories\PDOPraticienRepository;

return static function (ContainerBuilder $builder): void {
    $builder->addDefinitions([
        PraticienRepositoryInterface::class => \DI\autowire(PDOPraticienRepository::class),
        ServicePraticienInterface::class    => \DI\autowire(ServicePraticien::class),
    ]);
};
