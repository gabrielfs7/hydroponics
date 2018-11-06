<?php

namespace GSoares\Hydroponics\Test\Mock;

use GSoares\Hydroponics\Domain\Entity\Tank;

class TankMock
{
    public static function getPostRequestBody(): array
    {
        return [
            'data' => [
                'type' => 'tank',
                'attributes' => self::getDefaultAttributes()
            ]
        ];
    }

    public static function getPatchRequestBody(array $params): array
    {
        $attributes = self::getDefaultAttributes();
        $attributes = array_merge($attributes, $params);

        return [
            'data' => [
                'type' => 'tank',
                'attributes' => $attributes
            ]
        ];
    }

    public static function getResponseBody(Tank $tank): array
    {
        return [
            'links' => [
                'self' => '',
                'related' => '',
            ],
            'data' => self::getPaginationResponseBody($tank)
        ];
    }

    public static function getPaginationResponseBody(Tank $tank): array
    {
        $tankVersion = $tank->getLastVersion();

        return [
            'id' => (string) $tank->getId(),
            'type' => 'tank',
            'attributes' => [
                'name' => $tank->getName(),
                'description' => $tank->getDescription(),
                'volumeCapacity' => $tank->getVolumeCapacity(),
                'currentVolume' => $tankVersion->getWaterVolume()->getCurrentVolume(),
                'minVolume' => $tankVersion->getWaterVolume()->getMinVolume(),
                'waterTemperature' => $tankVersion->getWaterTemperature()->getTemperature(),
                'maxWaterTemperature' => $tankVersion->getWaterTemperature()->getMaxTemperature(),
                'minWaterTemperature' => $tankVersion->getWaterTemperature()->getMinTemperature(),
                'waterPh' => $tankVersion->getWaterPh()->getPh(),
                'maxWaterPh' => $tankVersion->getWaterPh()->getMaxPh(),
                'minWaterPh' => $tankVersion->getWaterPh()->getMinPh(),
                'waterEc' => $tankVersion->getWaterEc()->getEc(),
                'maxWaterEc' => $tankVersion->getWaterEc()->getMaxEc(),
                'minWaterEc' => $tankVersion->getWaterEc()->getMinEc(),
                'waterDbo' => $tankVersion->getWaterDbo()->getDbo(),
                'maxWaterDbo' => $tankVersion->getWaterDbo()->getMaxDbo(),
                'minWaterDbo' => $tankVersion->getWaterDbo()->getMinDbo(),
                'createdAt' => $tank->getCreatedAt()->format(DATE_ATOM),
            ],
            'relationships' => [],
            'links' => [
                'self' => '',
                'related' => '',
            ],
            'meta' => []
        ];
    }

    private static function getDefaultAttributes(): array
    {
        return [
            'name' => 'Name test',
            'description' => 'Description test',
            'volumeCapacity' => 1000,
            'currentVolume' => 999.99,
            'minVolume' => 100.00,
            'waterTemperature' => 23.55,
            'maxWaterTemperature' => 27.77,
            'minWaterTemperature' => 18.64,
            'waterPh' => 6.55,
            'maxWaterPh' => 7.55,
            'minWaterPh' => 5.54,
            'waterEc' => 1.33,
            'maxWaterEc' => 3.44,
            'minWaterEc' => 0.73,
            'waterDbo' => 5.2,
            'maxWaterDbo' => 6.8,
            'minWaterDbo' => 3.67,
        ];
    }
}
