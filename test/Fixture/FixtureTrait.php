<?php

namespace GSoares\Hydroponics\Test\Fixture;

use Doctrine\ORM\EntityManager;
use GSoares\Hydroponics\Test\Fixture\Factory\FixtureFactory;
use Psr\Container\ContainerInterface;

trait FixtureTrait
{
    /** @var FixtureFactory */
    private $fixtureFactory;

    public function createFixture(string $className, array $params = []): object
    {
        return $this->getFixtureFactory()
            ->create($className, $params);
    }

    abstract protected function getContainer(): ContainerInterface;

    public function getFixtureFactory(): FixtureFactory
    {
        if (!$this->fixtureFactory) {
            $this->fixtureFactory = new FixtureFactory($this->getContainer()->get(EntityManager::class));
        }

        return $this->fixtureFactory;
    }
}
