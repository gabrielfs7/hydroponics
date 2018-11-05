<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Crops;

use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Crops\CropsRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\CropsMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class ListCropsActionTest extends WebTestCase
{
    /** @var CropsRepository */
    private $cropsRepository;

    public function setUp()
    {
        parent::setUp();

        $this->cropsRepository = $this->getContainer()
            ->get(CropsRepository::class);
    }

    public function testCanListCrops() : void
    {
        /** @var System $system */
        $system = $this->createFixture(System::class);

        /** @var Crops $entity1 */
        $entity1 = $this->createFixture(Crops::class, ['system' => $system]);

        /** @var Crops $entity2 */
        $entity2 = $this->createFixture(Crops::class, ['system' => $system]);

        $this->runApp(
            'GET',
            sprintf(
                '/api/greenhouses/%s/systems/%s/crops',
                $system->getGreenhouse()->getId(),
                $system->getId()
            )
        );

        $expectedResponse = ResponseMock::getPaginationResponse(
            [
                'meta.totalEntries' => 2,
                'data' => [
                    CropsMock::getPaginationResponseBody($entity1),
                    CropsMock::getPaginationResponseBody($entity2),
                ]
            ]
        );

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody($expectedResponse);
    }
}
