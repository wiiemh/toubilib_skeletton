<?php
declare(strict_types=1);

namespace toubilib\core\application\usecases;

use toubilib\core\application\dto\RendezVousDTO;
use toubilib\core\domain\entities\rdv\repositories\RendezVousRepositoryInterface;

final class AgendaPraticien implements AgendaPraticienInterface
{
    public function __construct(private RendezVousRepositoryInterface $repo) {}

    public function getCreneauxOccupes(string $praticienId, \DateTimeImmutable $from, \DateTimeImmutable $to): array
    {
        return array_map(fn($r) => RendezVousDTO::fromEntity($r),
            $this->repo->findBusyForPraticienBetween($praticienId, $from, $to));
    }

    public function getRendezVous(string $id): ?RendezVousDTO
    {
        $r = $this->repo->findById($id);
        return $r ? RendezVousDTO::fromEntity($r) : null;
    }

    public function getProchainRdv(string $praticienId, \DateTimeImmutable $from, \DateTimeImmutable $to): ?RendezVousDTO
    {
        $rdvs = $this->repo->findBusyForPraticienBetween($praticienId, $from, $to);
        if (!$rdvs) return null;
        usort($rdvs, fn($a, $b) => $a->getDebut() <=> $b->getDebut());
        return RendezVousDTO::fromEntity($rdvs[0]);
    }
}
