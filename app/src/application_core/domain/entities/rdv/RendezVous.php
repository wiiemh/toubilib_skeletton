<?php
declare(strict_types=1);

namespace toubilib\core\domain\entities\rdv;

final class RendezVous
{
    public function __construct(
        private string $id,
        private string $praticienId,
        private \DateTimeImmutable $debut,
        private \DateTimeImmutable $fin,
        private ?string $motif = null,
        private ?string $patientId = null,
        private ?string $patientEmail = null,
    ) {}
    public function getId(): string { return $this->id; }
    public function getPraticienId(): string { return $this->praticienId; }
    public function getDebut(): \DateTimeImmutable { return $this->debut; }
    public function getFin(): \DateTimeImmutable { return $this->fin; }
    public function getMotif(): ?string { return $this->motif; }
    public function getPatientId(): ?string { return $this->patientId; }
    public function getPatientEmail(): ?string { return $this->patientEmail; }
}
