<?php

namespace GSoares\Hydroponics\Domain\Repository;

interface RepositoryInterface
{
    /**
     * @param array $parameters
     * @return array
     */
    public function find(array $parameters);

    /**
     * @param array $parameters
     * @return object
     */
    public function findOne(array $parameters);

    /**
     * @param $object
     * @return object
     */
    public function save($object);
}