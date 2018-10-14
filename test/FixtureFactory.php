<?php

namespace GSoares\Hydroponics\Test;

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\ORM\EntityManager;

class FixtureFactory
{
    /** @var EntityManager */
    private $entityManager;

    /** @var ORMExecutor */
    private $ormExecutor;

    /** @var Loader */
    private $loader;

    /** @var Fixture */
    private $fixture;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->ormExecutor = new ORMExecutor($this->entityManager, new ORMPurger($this->entityManager));
        $this->ormExecutor->purge();
        $this->loader = new Loader();
        $this->fixture = new Fixture();
    }

    public function create(string $entityName, array $params = []): object
    {
        $this->fixture
            ->add($entityName, $params);

        $this->loader
            ->addFixture($this->fixture);

        $this->ormExecutor
            ->execute($this->loader->getFixtures(), true);

        return $this->fixture
            ->getLastEntity();
    }
}
