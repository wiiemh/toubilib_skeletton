<?php
declare(strict_types=1);

namespace toubilib\core\domain\entities\praticien\repositories;

use toubilib\core\domain\entities\praticien\Praticien;

interface PraticienRepositoryInterface
{
    /** @return Praticien[] */
    public function findAll(): array;
    public function findById(string $id): ?Praticien;
}
