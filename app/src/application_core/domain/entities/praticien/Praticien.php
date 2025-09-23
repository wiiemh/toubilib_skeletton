<?php

namespace toubilib\core\domain\entities\praticien;

//entité practicien avec ces informations//
class Praticien
{
    private string $id;
    private string $nom;
    private string $prenom;
    private string $ville;
    private string $email;
    private string $specialite;

    public function __construct(string $id,string $nom, string $prenom, string $ville, string $email, string $specialite)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->ville = $ville;
        $this->email = $email;
        $this->specialite = $specialite;
    }

    //méthode d'accès aux attributs(get)//
    public function getid(): string
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