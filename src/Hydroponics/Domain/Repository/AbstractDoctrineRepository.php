<?php

namespace GSoares\Hydroponics\Domain\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractDoctrineRepository extends EntityRepository implements RepositoryInterface
{

    /**
     * @var array
     */
    private $filters = [];

    /**
     * @var $entityAlias
     */
    private $entityAlias;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;
    
    /**
     * @param string $filter
     * @param string $value
     * @return $this
     */
    public function addFilter($filter, $value)
    {
        $this->filters[$filter] = $value;

        return $this;
    }

    /**
     * @param string $filter
     * @return $this
     */
    public function clearFilter($filter)
    {
        if (array_key_exists($filter, $this->filters)) {
            $this->filters[$filter] = null;

            unset($this->filters[$filter]);
        }
    }

    /**
     * @return $this
     */
    public function clearFilters()
    {
        $this->filters = [];

        return $this;
    }

    /**
     * @param string $entityAlias
     * @return $this
     */
    public function setEntityAlias($entityAlias)
    {
        $this->entityAlias = $entityAlias;
    }
    
    /**
     * @return object
     */
    public function findOne()
    {
        $this->applyFilter();

        return $this->getQueryBuilder()
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $this->applyFilter();

        return $this->getQueryBuilder()
            ->getQuery()
            ->execute();
    }
    
    /**
     * @param object $object
     * @return object
     */
    public function save($object)
    {
        $this->getEntityManager()
            ->persist($object);

        $this->getEntityManager()
            ->flush($object);

        return $object;
    }

    /**
     * @param $filter
     * @return string
     */
    protected function getFilter($filter)
    {
        if (array_key_exists($filter, $this->filters)) {
            return $this->filters[$filter];
        }
    }

    /**
     * @return $this
     */
    protected function applyFilter()
    {
        $this->queryBuilder = $this->createQueryBuilder($this->entityAlias);

        if ($id = $this->getFilter('id')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.id = :id")
                ->setParameter('id', $id);
        }

        if ($name = $this->getFilter('name')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.name LIKE :name")
                ->setParameter('name', "%$name%");
        }

        if ($description = $this->getFilter('description')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.description LIKE :description")
                ->setParameter('description', "%$description%");
        }
        
        if ($createdFrom = $this->getFilter('createdFrom')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.createdAt >= :createdFrom")
                ->setParameter('createdFrom', $createdFrom);
        }

        if ($createdTo = $this->getFilter('createdTo')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.createdAt <= :createdTo")
                ->setParameter('createdTo', $createdTo);
        }

        if ($updatedFrom = $this->getFilter('updatedFrom')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.updatedAt >= :updatedFrom")
                ->setParameter('updatedFrom', $updatedFrom);
        }

        if ($updatedTo = $this->getFilter('updatedTo')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.updatedAt <= :updatedTo")
                ->setParameter('updatedTo', $updatedTo);
        }

        if ($deletedFrom = $this->getFilter('deletedFrom')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.deletedAt >= :deletedFrom")
                ->setParameter('deletedFrom', $deletedFrom);
        }

        if ($deletedTo = $this->getFilter('deletedTo')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.deletedAt <= :deletedTo")
                ->setParameter('deletedTo', $deletedTo);
        }

        return $this;
    }

    /**
     * @return QueryBuilder
     */
    protected function getQueryBuilder()
    {
        return $this->queryBuilder;
    }
}
