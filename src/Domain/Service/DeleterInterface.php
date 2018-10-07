<?php

namespace GSoares\Hydroponics\Domain\Service;

interface DeleterInterface
{
    public function delete(int $id): object;
}
