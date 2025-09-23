<?php
namespace toubilib\core\domain\repositories;

use toubilib\core\domain\entities\praticien\Praticien;

interface PraticienRepositoryInterface
{
    /** @return Praticien[] */
    public function findAll(): array;
}
