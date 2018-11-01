<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Greenhouse;

use DateTimeInterface;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\GreenhouseMock;

class RemoveGreenhouseActionTest extends WebTestCase
{
    /** @var GreenhouseRepository */
    private $greenhouseRepository;

    public function setUp()
    {
        parent::setUp();

        $this->greenhouseRepository = $this->getContainer()
            ->get(GreenhouseRepository::class);
    }

    public function testCanRemoveGreenhouseWhenProvidingExistentId() : void
    {
        /** @var Greenhouse $entity */
        $entity = $this->createFixture(Greenhouse::class, ['name' => ' ABC ']);

        $this->assertNull($entity->getDeletedAt());

        $this->runApp(
            'DELETE',
            '/api/greenhouses/'. $entity->getId()
        );

        /** @var Greenhouse $entity */
        $entity = $this->greenhouseRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertInstanceOf(DateTimeInterface::class, $entity->getDeletedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(GreenhouseMock::getResponseBody($entity));
    }
}
