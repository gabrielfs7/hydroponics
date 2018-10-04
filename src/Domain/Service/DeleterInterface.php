<?php

namespace GSoares\Hydroponics\Domain\Service;

interface DeleterInterface
{

    /**
     * @param int $id
     * @return object
     */
    public function delete($id);
}
