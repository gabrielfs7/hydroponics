<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Crop;

use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Crop\CropRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\CropMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class ListCropActionTest extends WebTestCase
{
    /** @var CropRepository */
    private $cropRepository;

    public function setUp()
    {
        parent::setUp();

        $this->cropRepository = $this->getContainer()
            ->get(CropRepository::class);
    }

    public function testCanListCrops() : void
    {
        /** @var System $system */
        $system = $this->createFixture(System::class);

        /** @var Crop $entity1 */
        $entity1 = $this->createFixture(Crop::class, ['system' => $system]);

        /** @var Crop $entity2 */
        $entity2 = $this->createFixture(Crop::class, ['system' => $system]);

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
                    CropMock::getPaginationResponseBody($entity1),
                    CropMock::getPaginationResponseBody($entity2),
                ]
            ]
        );

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody($expectedResponse);
    }
}
