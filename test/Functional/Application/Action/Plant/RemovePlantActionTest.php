<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Plant;

use DateTimeInterface;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\PlantMock;

class RemovePlantActionTest extends WebTestCase
{
    /** @var PlantRepository */
    private $plantRepository;

    public function setUp()
    {
        parent::setUp();

        $this->plantRepository = $this->getContainer()
            ->get(PlantRepository::class);
    }

    public function testCanRemovePlantWhenProvidingExistentId() : void
    {
        /** @var Plant $entity */
        $entity = $this->createFixture(Plant::class, ['name' => ' ABC ']);

        $this->assertNull($entity->getDeletedAt());

        $this->runApp(
            'DELETE',
            '/api/plants/'. $entity->getId()
        );

        /** @var Plant $entity */
        $entity = $this->plantRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertInstanceOf(DateTimeInterface::class, $entity->getDeletedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(PlantMock::getResponseBody($entity));
    }
}
