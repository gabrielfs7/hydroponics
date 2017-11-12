<?php

namespace GSoares\Hydroponics\Application\Service\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;

class GreenhouseCreator extends AbstractGreenhouseSaver
{

    /**
     * @param string $json
     * @return string
     */
    public function create($json)
    {
        $greenhouseDto = $this->decodeJson($json);

        $greenhouse = $this->greenhouseFactory
            ->make($greenhouseDto->attributes->name);

        /** @var Greenhouse $greenhouse */
        $greenhouse = $this->greenhouseRepository
            ->save($greenhouse);

        $this->fillAttributes($greenhouse, $greenhouseDto);

        return $this->createResponseDto($greenhouse);
    }
}