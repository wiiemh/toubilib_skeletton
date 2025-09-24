<?php
declare(strict_types=1);

namespace toubilib\infrastructure\repositories;

use toubilib\core\domain\entities\praticien\Praticien;

interface PraticienRepositoryInterface
{
    /** @return Praticien[] */
    public function findAll(): array;
}
