<?php
declare(strict_types=1);

namespace toubilib\core\application\dto;

use toubilib\core\domain\entities\praticien\Praticien;

final class PraticienDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $nom,
        public readonly string $prenom,
        public readonly string $ville,
        public readonly string $email,
        public readonly string $specialite
    ) {}

    public static function fromEntity(Praticien $p): self
    {
        return new self(
            $p->getId(),
            $p->getNom(),
            $p->getPrenom(),
            $p->getVille(),
            $p->getEmail(),
            $p->getSpecialite()
        );
    }

    public function toArray(): array
    {
        return [
            'id'         => $this->id,
            'nom'        => $this->nom,
            'prenom'     => $this->prenom,
            'ville'      => $this->ville,
            'email'      => $this->email,
            'specialite' => $this->specialite,
        ];
    }
}
