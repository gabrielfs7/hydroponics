<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

interface ResourceSearcherInterface
{

    /**
     * @param array $parameters
     * @return \GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface
     */
    public function search(array $parameters);

    /**
     * @param int $id
     * @return \GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface
     */
    public function searchById($id);
}
