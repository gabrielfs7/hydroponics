<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Tank;

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
        $entity = $this->createFixture(Tank::class, ['name' => ' ABC ']);

        $entityFound = $this->tankRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertEquals($entity->getId(), $entityFound->getId());
        $this->assertNull($entityFound->getDeletedAt());

        $this->runApp(
            'DELETE',
            sprintf('/api/tanks/%s', $entityFound->getId())
        );

        $entity = $this->tankRepository
            ->addFilter('id', $entityFound->getId())
            ->findOne();

        $this->assertNotNull($entity->getDeletedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(TankMock::getResponseBody($entity));
    }
}
