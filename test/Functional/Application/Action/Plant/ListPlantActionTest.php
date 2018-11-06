<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Plant;

use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\PlantMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class ListPlantActionTest extends WebTestCase
{
    /** @var PlantRepository */
    private $plantRepository;

    public function setUp()
    {
        parent::setUp();

        $this->plantRepository = $this->getContainer()
            ->get(PlantRepository::class);
    }

    public function testCanListPlants() : void
    {
        /** @var Plant $entity1 */
        $entity1 = $this->createFixture(Plant::class);

        /** @var Plant $entity2 */
        $entity2 = $this->createFixture(Plant::class);

        $this->runApp(
            'GET',
            '/api/plants'
        );

        $expectedResponse = ResponseMock::getPaginationResponse(
            [
                'meta.totalEntries' => 2,
                'data' => [
                    PlantMock::getPaginationResponseBody($entity1),
                    PlantMock::getPaginationResponseBody($entity2),
                ]
            ]
        );

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody($expectedResponse);
    }
}
