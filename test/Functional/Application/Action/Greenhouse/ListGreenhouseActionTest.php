<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\GreenhouseMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class ListGreenhouseActionTest extends WebTestCase
{
    /** @var GreenhouseRepository */
    private $greenhouseRepository;

    public function setUp()
    {
        parent::setUp();

        $this->greenhouseRepository = $this->getContainer()
            ->get(GreenhouseRepository::class);
    }

    public function testCanListGreenhouses() : void
    {
        /** @var Greenhouse $entity1 */
        $entity1 = $this->createFixture(Greenhouse::class);

        /** @var Greenhouse $entity2 */
        $entity2 = $this->createFixture(Greenhouse::class);

        $this->runApp(
            'GET',
            '/api/greenhouses'
        );

        $expectedResponse = ResponseMock::getPaginationResponse(
            [
                'meta.totalEntries' => 2,
                'data' => [
                    GreenhouseMock::getPaginationResponseBody($entity1),
                    GreenhouseMock::getPaginationResponseBody($entity2),
                ]
            ]
        );

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody($expectedResponse);
    }
}
