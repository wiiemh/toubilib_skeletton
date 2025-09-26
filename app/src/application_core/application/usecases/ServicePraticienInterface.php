<?php
declare(strict_types=1);

namespace toubilib\core\application\usecases;

use toubilib\core\application\dto\PraticienDTO;

interface ServicePraticienInterface
{
    /** @return PraticienDTO[] */
    public function listerPraticiens(): array;
}
