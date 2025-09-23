<?php
namespace toubilib\core\application\usecases;

use toubilib\core\application\dto\PraticienDTO;
use toubilib\core\domain\repositories\PraticienRepositoryInterface;
use toubilib\core\domain\entities\praticien\Praticien;

final class ServicePraticien implements ServicePraticienInterface
{
    public function __construct(private PraticienRepositoryInterface $repo) {}

    public function listerPraticiens(): array
    {
        $entities = $this->repo->findAll();
        $dtos = [];
        $idAuto = 1;
        /** @var Praticien $p */
        foreach ($entities as $p) {
            $dtos[] = new PraticienDTO(
                $p->getid(),              
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
