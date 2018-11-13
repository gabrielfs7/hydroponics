<?php

namespace GSoares\Hydroponics\Application\Service\Tank;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceAttributesFillerInterface;
use GSoares\Hydroponics\Domain\Entity\NutritionalFormula;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Entity\TankVersion;
use GSoares\Hydroponics\Domain\Repository\NutritionalFormula\NutritionalFormulaRepository;
use GSoares\Hydroponics\Domain\ValueObject\WaterDbo;
use GSoares\Hydroponics\Domain\ValueObject\WaterEc;
use GSoares\Hydroponics\Domain\ValueObject\WaterPh;
use GSoares\Hydroponics\Domain\ValueObject\WaterTemperature;
use GSoares\Hydroponics\Domain\ValueObject\WaterVolume;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class TankAttributesFiller implements ResourceAttributesFillerInterface
{
    /** @var NutritionalFormulaRepository */
    private $nutritionalFormulaRepository;

    /** @var DateTimeProvider */
    private $dateTimeProvider;

    public function __construct(
        DateTimeProvider $dateTimeProvider,
        NutritionalFormulaRepository $nutritionalFormulaRepository
    ) {
        $this->dateTimeProvider = $dateTimeProvider;
        $this->nutritionalFormulaRepository = $nutritionalFormulaRepository;
    }

    public function fillAttributes(object $tank, ResourceDtoInterface $resourceDto): object
    {
        /** @var Tank $tank */
        $tank->changeUpdatedAt($this->dateTimeProvider->current());
        $tank->changeName($resourceDto->getAttributeValue('name'));
        $tank->changeDescription($resourceDto->getAttributeValue('description'));

        if ($nutritionalFormula = $this->getNutritionalFormula($resourceDto)) {
            $tank->changeNutritionalFormula($nutritionalFormula);
        }

        $tankVersion = new TankVersion(
            $tank,
            new WaterVolume(
                $resourceDto->getAttributeValue('currentVolume'),
                $resourceDto->getAttributeValue('minVolume')
            ),
            new WaterPh(
                $resourceDto->getAttributeValue('waterPh'),
                $resourceDto->getAttributeValue('maxWaterPh'),
                $resourceDto->getAttributeValue('minWaterPh')
            ),
            new WaterEc(
                $resourceDto->getAttributeValue('waterEc'),
                $resourceDto->getAttributeValue('maxWaterEc'),
                $resourceDto->getAttributeValue('minWaterEc')
            ),
            new WaterDbo(
                $resourceDto->getAttributeValue('waterDbo'),
                $resourceDto->getAttributeValue('maxWaterDbo'),
                $resourceDto->getAttributeValue('minWaterDbo')
            ),
            new WaterTemperature(
                $resourceDto->getAttributeValue('waterTemperature'),
                $resourceDto->getAttributeValue('maxWaterTemperature'),
                $resourceDto->getAttributeValue('minWaterTemperature')
            )
        );

        $tankVersion->changeCreatedAt($this->dateTimeProvider->current());

        $tank->addVersion($tankVersion);

        return $tank;
    }

    private function getNutritionalFormula(ResourceDtoInterface $resourceDto): ?NutritionalFormula
    {
        $id = $resourceDto->getRelationships()['nutritionalFormula']['data']['id'] ?? 0;

        if ($id) {
            return $this->nutritionalFormulaRepository->find($id);
        }

        return null;
    }
}
