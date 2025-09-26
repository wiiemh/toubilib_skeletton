<?php

declare(strict_types=1);

namespace toubilib\core\application\usecases;

use toubilib\core\application\dto\InputRendezVousDTO;

interface ServiceRendezVousInterface
{
    public function creerRendezVous(InputRendezVousDTO $dto): void;
    public function annulerRendezVous(string $rdvId, ?string $raison = null): void;

    /**
     * @return array
     */
    public function consulterAgenda(string $praticienId, ?\DateTimeImmutable $from = null, ?\DateTimeImmutable $to = null): array;
}