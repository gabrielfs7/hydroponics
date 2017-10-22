<?php

namespace GSoares\Hydroponics\Domain\Repository;

interface RepositoryInterface
{
    /**
     * @param array $parameters
     * @return mixed
     */
    public function find(array $parameters);

    /**
     * @param array $parameters
     * @return mixed
     */
    public function findOne(array $parameters);

    /**
     * @param $object
     * @return mixed
     */
    public function save($object);
}