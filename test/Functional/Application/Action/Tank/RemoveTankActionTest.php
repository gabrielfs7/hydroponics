<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Tank;

use DateTimeInterface;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Repository\Tank\TankRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\TankMock;

class RemoveTankActionTest extends WebTestCase
{
    /** @var TankRepository */
    private $tankRepository;

    public function setUp()
    {
        parent::setUp();

        $this->tankRepository = $this->getContainer()
            ->get(TankRepository::class);
    }

    public function testCanRemoveTankWhenProvidingExistentId() : void
    {
        /** @var Tank $entity */
        $entity = $this->createFixture(Tank::class);

        $this->assertNull($entity->getDeletedAt());

        $this->runApp(
            'DELETE',
            sprintf('/api/tanks/%s', $entity->getId())
        );

        /** @var Tank $entity */
        $entity = $this->tankRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertInstanceOf(DateTimeInterface::class, $entity->getDeletedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(TankMock::getResponseBody($entity));
    }
}
