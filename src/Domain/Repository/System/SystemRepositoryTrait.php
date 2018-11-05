<?php

namespace GSoares\Hydroponics\Domain\Repository\System;

trait SystemRepositoryTrait
{
    /** @var  SystemRepository */
    private $systemRepository;

    public function getSystemRepository(): SystemRepository
    {
        return $this->systemRepository;
    }

    public function setSystemRepository(SystemRepository $systemRepository): self
    {
        $this->systemRepository = $systemRepository;

        return $this;
    }
}
