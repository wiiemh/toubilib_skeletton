<?php
declare(strict_types=1);

namespace toubilib\core\domain\entities\praticien;

class Praticien
{
    public function __construct(
        private int $id,
        private string $nom,
        private string $prenom,
        private string $ville,
        private string $email,
        private string $specialite
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSpecialite(): string
    {
        return $this->specialite;
    }
}
