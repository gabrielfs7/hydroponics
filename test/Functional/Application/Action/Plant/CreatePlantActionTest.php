<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Plant;

use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\PlantMock;

class CreatePlantActionTest extends WebTestCase
{
    /** @var PlantRepository */
    private $plantRepository;

    public function setUp()
    {
        parent::setUp();

        $this->plantRepository = $this->getContainer()
            ->get(PlantRepository::class);
    }

    public function testCreateAPlantWhenProvidingCorrectRequest() : void
    {
        $this->assertCount(0, $this->plantRepository->findAll());

        $this->runApp(
            'POST',
            '/api/plants',
            PlantMock::getPostRequestBody()
        );

        /** @var Plant $entity */
        $entity = $this->plantRepository
            ->findOne();

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(PlantMock::getResponseBody($entity));
    }
}
