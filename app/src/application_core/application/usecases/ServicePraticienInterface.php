<?php
namespace toubilib\core\application\usecases;

use toubilib\core\application\dto\PraticienDTO;

interface ServicePraticienInterface
{
    /** @return PraticienDTO[] */
    public function listerPraticiens(): array;
}
