<?php

namespace GSoares\Hydroponics\Domain\Service\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\RepositoryInterface;

class GreenhouseCreator
{

    /**
     * @var RepositoryInterface
     */
    private $greenhouseRepository;

    public function __construct(RepositoryInterface $greenhouseRepository)
    {
        $this->greenhouseRepository = $greenhouseRepository;
    }

    /**
     * @param Greenhouse $greenhouse
     * @return Greenhouse
     */
    public function create(Greenhouse $greenhouse)
    {
        $greenhouse = $this->greenhouseRepository
            ->save($greenhouse);

        return $greenhouse;
    }
}
