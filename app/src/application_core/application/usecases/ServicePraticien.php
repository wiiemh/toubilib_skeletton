<?php
declare(strict_types=1);

namespace toubilib\core\application\usecases;

use toubilib\core\application\dto\PraticienDTO;
use toubilib\infrastructure\repositories\PraticienRepositoryInterface;

final class ServicePraticien implements ServicePraticienInterface
{
    public function __construct(private PraticienRepositoryInterface $repo) {}

    /** @return PraticienDTO[] */
    public function listerPraticiens(): array
    {
        $entities = $this->repo->findAll();
        $dtos = [];
        foreach ($entities as $p) {
            $dtos[] = new PraticienDTO(
                $p->getId(),
                $p->getNom(),
                $p->getPrenom(),
                $p->getVille(),
                $p->getEmail(),
                $p->getSpecialite()
            );
        }
        return $dtos;
    }
}
