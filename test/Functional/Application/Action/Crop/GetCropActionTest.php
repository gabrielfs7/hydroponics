<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Crop;

use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Entity\CropVersion;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Crop\CropRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\CropMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class GetCropActionTest extends WebTestCase
{
    /** @var CropRepository */
    private $cropRepository;

    public function setUp()
    {
        parent::setUp();

        $this->cropRepository = $this->getContainer()
            ->get(CropRepository::class);
    }

    public function testCanGetCropWhenProvidingExistentId() : void
    {
        /** @var Crop $entity */
        $entity = $this->createFixture(Crop::class);

        /** @var CropVersion $latestVersion */
        $cropVersion = $entity->getLastVersion();

        $this->runApp(
            'GET',
            sprintf(
                '/api/greenhouses/%s/systems/%s/crops/%s',
                $cropVersion->getSystem()->getGreenhouse()->getId(),
                $cropVersion->getSystem()->getId(),
                $entity->getId()
            )
        );

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(CropMock::getResponseBody($entity));
    }

    public function testCannotGetCropWhenProvidingNoExistentId() : void
    {
        /** @var System $system */
        $system = $this->createFixture(System::class);

        $this->runApp(
            'GET',
            sprintf(
                '/api/greenhouses/%s/systems/%s/crops/%s',
                $system->getGreenhouse()->getId(),
                $system->getId(),
                999
            )
        );

        $this->assertResponseHasStatusCode(404);
        $this->assertResponseHasBody(ResponseMock::getErrorResponseBody(404, 'Registry found'));
    }
}
