<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Plant;

use DateTimeInterface;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\PlantMock;

class UpdatePlantActionTest extends WebTestCase
{
    /** @var PlantRepository */
    private $plantRepository;

    public function setUp()
    {
        parent::setUp();

        $this->plantRepository = $this->getContainer()
            ->get(PlantRepository::class);
    }

    public function testCanUpdatePlantWhenProvidingExistentId() : void
    {
        /** @var Plant $entity */
        $entity = $this->createFixture(Plant::class);

        $this->runApp(
            'PATCH',
            '/api/plants/'. $entity->getId(),
            PlantMock::getPatchRequestBody(
                [
                    'name' => 'Name updated',
                    'species' => 'Species updated',
                ]
            )
        );

        /** @var Plant $entity */
        $entity = $this->plantRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertSame('Name updated', $entity->getName());
        $this->assertSame('Species updated', $entity->getSpecies());
        $this->assertInstanceOf(DateTimeInterface::class, $entity->getUpdatedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(PlantMock::getResponseBody($entity));
    }
}
