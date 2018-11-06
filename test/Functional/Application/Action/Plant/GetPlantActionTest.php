<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Plant;

use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\PlantMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class GetPlantActionTest extends WebTestCase
{
    /** @var PlantRepository */
    private $plantRepository;

    public function setUp()
    {
        parent::setUp();

        $this->plantRepository = $this->getContainer()
            ->get(PlantRepository::class);
    }

    public function testCanGetPlantWhenProvidingExistentId() : void
    {
        /** @var Plant $entity */
        $entity = $this->createFixture(Plant::class);

        $this->runApp('GET', '/api/plants/1');

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(PlantMock::getResponseBody($entity));
    }

    public function testCannotGetPlantWhenProvidingNoExistentId() : void
    {
        $this->runApp('GET', '/api/plants/2');

        $this->assertResponseHasStatusCode(404);
        $this->assertResponseHasBody(ResponseMock::getErrorResponseBody(404, 'Registry found'));
    }
}
