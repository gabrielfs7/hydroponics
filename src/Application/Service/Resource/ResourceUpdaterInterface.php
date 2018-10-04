<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

interface ResourceUpdaterInterface
{

    /**
     * @param string $json
     * @param string $id
     * @return \GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface
     */
    public function update($json, $id);
}
