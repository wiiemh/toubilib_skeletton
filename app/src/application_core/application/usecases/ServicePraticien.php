<?php
declare(strict_types=1);

namespace toubilib\core\application\usecases;

use toubilib\core\application\dto\PraticienDTO;
use toubilib\core\domain\entities\praticien\repositories\PraticienRepositoryInterface;

final class ServicePraticien implements ServicePraticienInterface
{
    public function __construct(
        private PraticienRepositoryInterface $repo
    ) {}

    public function listerPraticiens(): array
    {
        $entities = $this->repo->findAll();
        return array_map(fn($p) => PraticienDTO::fromEntity($p), $entities);
    }
}
