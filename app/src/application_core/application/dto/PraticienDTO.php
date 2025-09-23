<?php
namespace toubilib\core\application\dto;

final class PraticienDTO
{
    public function __construct(
        public int $id,
        public string $nom,
        public string $prenom,
        public string $ville,
        public string $email,
        public string $specialite
    ) {
    }
}