<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;

interface ResourceDeleterInterface
{

    /**
     * @param string $id
     * @return ResponseDtoInterface
     */
    public function delete($id);
}
