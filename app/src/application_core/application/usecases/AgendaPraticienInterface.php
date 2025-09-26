<?php
declare(strict_types=1);

namespace toubilib\core\application\usecases;

use toubilib\core\application\dto\RendezVousDTO;

interface AgendaPraticienInterface
{
    /** @return RendezVousDTO[] */
    public function getCreneauxOccupes(string $praticienId, \DateTimeImmutable $from, \DateTimeImmutable $to): array;
    public function getRendezVous(string $id): ?RendezVousDTO;
    public function getProchainRdv(string $praticienId, \DateTimeImmutable $from, \DateTimeImmutable $to): ?RendezVousDTO;
}
