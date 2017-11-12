<?php

namespace GSoares\Hydroponics\Application\Service\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;

class GreenhouseUpdater extends AbstractGreenhouseSaver
{

    /**
     * @param string $json
     * @param $greenhouseId
     * @return \GSoares\Hydroponics\Application\Dto\Response\ResponseDto
     */
    public function update($json, $greenhouseId)
    {
        $greenhouse =  $this->findGreenhouseById($greenhouseId);
        $greenhouseDto = $this->decodeJson($json);

        $this->fillAttributes($greenhouse, $greenhouseDto);

        /** @var Greenhouse $greenhouse */
        $greenhouse = $this->greenhouseRepository
            ->save($greenhouse);

        return $this->createResponseDto($greenhouse);
    }

    /**
     * @param int $greenhouseId
     * @return \GSoares\Hydroponics\Domain\Entity\Greenhouse
     */
    private function findGreenhouseById($greenhouseId)
    {
        return $this->greenhouseRepository
            ->clearFilters()
            ->addFilter('id', $greenhouseId)
            ->findOne();
    }
}