<?php
namespace toubilib\core\application\dto;

use toubilib\core\domain\entities\praticien\Praticien;

class PraticienDTO
{
    public int $id;
    public string $nom;
    public string $prenom;
    public string $ville;
    public string $email;
    public string $specialite;
    public function __construct(int $id, string $nom, string $prenom, string $ville, string $email, string $specialite)
    {

        $this->id = (int) $this->id;
        $this->nom = (string) $this->nom;
        $this->prenom = (string) $this->prenom;
        $this->ville = (string) $this->ville;
        $this->email = (string) $this->email;
        $this->specialite = (string) $this->specialite;

    }

    public static function fromEntity(Praticien $entity): self
    {
        return new self(
            $entity->getId(),
            $entity->getNom(),
            $entity->getPrenom(),
            $entity->getVille(),
            $entity->getEmail(),
            $entity->getSpecialite()
        );
    }
}