<?php

namespace GSoares\Hydroponics\Application\Service\Greenhouse;

use GSoares\Hydroponics\Application\Dto\Greenhouse\GreenhouseDto;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;

class GreenhouseAttributesFiller
{

    /**
     * @param Greenhouse $greenhouse
     * @param GreenhouseDto $greenhouseDto
     * @return Greenhouse
     */
    public function fillAttributes(Greenhouse $greenhouse, GreenhouseDto $greenhouseDto)
    {
        $greenhouse->changeName($greenhouseDto->attributes->name);

        return $greenhouse;
    }
}