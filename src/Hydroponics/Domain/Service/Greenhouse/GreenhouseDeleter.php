<?php

namespace GSoares\Hydroponics\Domain\Service\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\RepositoryInterface;

class GreenhouseDeleter
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
     * @param int $greenhouseId
     */
    public function delete($greenhouseId)
    {
        /** @var Greenhouse $greenhouse */
        $greenhouse = $this->greenhouseRepository
            ->clearFilters()
            ->addFilter('id', $greenhouseId)
            ->findOne();

        $greenhouse->changeDeletedAt(new \DateTime());

        $this->greenhouseRepository
            ->save($greenhouse);
    }
}
