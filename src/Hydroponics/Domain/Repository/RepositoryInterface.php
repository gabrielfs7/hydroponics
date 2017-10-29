<?php

namespace GSoares\Hydroponics\Domain\Repository;

interface RepositoryInterface
{

    /**
     * @param string $filter
     * @param string $value
     * @return $this
     */
    public function addFilter($filter, $value);

    /**
     * @param string $filter
     * @return $this
     */
    public function clearFilter($filter);

    /**
     * @return $this
     */
    public function clearFilters();

    /**
     * @return array
     */
    public function findAll();

    /**
     * @return object
     */
    public function findOne();

    /**
     * @param object $object
     * @return object
     */
    public function save($object);
}
