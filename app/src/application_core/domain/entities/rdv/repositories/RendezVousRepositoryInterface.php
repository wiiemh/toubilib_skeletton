<?php
declare(strict_types=1);

namespace toubilib\core\domain\entities\rdv\repositories;

use toubilib\core\domain\entities\rdv\RendezVous;

interface RendezVousRepositoryInterface
{
    public function findById(string $id): ?RendezVous;
    /** @return RendezVous[] */
    public function findBusyForPraticienBetween(string $praticienId, \DateTimeImmutable $from, \DateTimeImmutable $to): array;

    public function save(RendezVous $rdv): void;

    /** @return RendezVous[] */
    public function findForPraticienBetween(string $praticienId, \DateTimeImmutable $from, \DateTimeImmutable $to): array;

}
