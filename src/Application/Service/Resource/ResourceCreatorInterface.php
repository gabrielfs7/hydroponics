<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDto;

interface ResourceCreatorInterface
{

    /**
     * @param string $json
     * @return ResponseDto
     */
    public function create($json);
}
