<?php

namespace toubilib\core\domain\entities\praticien;


class Praticien
{
   private string $nom;
   private string $prenom;
   private string $ville;
   private string $email;
   private string $specialite;

    public function __construct(string $nom, string $prenom, string $ville, string $email, string $specialite) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->ville = $ville;
        $this->email = $email;
        $this->specialite = $specialite;
    }

    // Getters
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getVille(): string { return $this->ville; }
    public function getEmail(): string { return $this->email; }
    public function getSpecialite(): string { return $this->specialite; }
}