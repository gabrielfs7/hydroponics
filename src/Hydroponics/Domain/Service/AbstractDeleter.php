<?php

namespace GSoares\Hydroponics\Domain\Service;

use GSoares\Hydroponics\Domain\Repository\RepositoryInterface;

abstract class AbstractDeleter implements DeleterInterface
{

    /**
     * @var RepositoryInterface
     */
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return object
     */
    public function delete($id)
    {
        $object = $this->repository
            ->clearFilters()
            ->addFilter('id', $id)
            ->findOne();

        $object->changeDeletedAt(new \DateTime());

        return $this->repository
            ->save($object);
    }
}
