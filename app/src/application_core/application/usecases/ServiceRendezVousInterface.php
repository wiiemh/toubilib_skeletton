<?php

declare(strict_types=1);

namespace toubilib\core\application\usecases;

use toubilib\core\application\dto\InputRendezVousDTO;

interface ServiceRendezVousInterface
{
    public function creerRendezVous(InputRendezVousDTO $dto): void;
}