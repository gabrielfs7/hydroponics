<?php

namespace GSoares\Hydroponics\Application\Decoder;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use stdClass;

abstract class AbstractDtoDecoder implements DecoderInterface
{
    public function decode(string $json): ResourceDtoInterface
    {
        $stdClass = json_decode($json);
        $dto = new ResourceDto(
            '',
            $this->getResourceType(),
            new ResourceAttributesDto(),
            new ResourceLinksDto('', ''),
            [],
            []
        );

        $this->handleData($dto, $stdClass->data);

        return $dto;
    }

    private function handleData(&$dto, $data): void
    {
        foreach ($data as $property => $propertyValue) {
            $propertyExists = is_object($dto);// FIXME @TODO && property_exists($dto, $property);
            $propertyIsArray = is_array($propertyValue);
            $propertyIsObject = is_object($propertyValue);

            if (!$propertyExists) {
                continue;
            }

            if ($propertyExists && !$propertyIsArray && !$propertyIsObject) {
                $dto->{$property} = $propertyValue;

                continue;
            }

            if ($propertyExists && $propertyIsArray) {
                if (!$this->getClassByProperty($dto, $property)) {
                    $dto->{$property} = array_values($propertyValue);

                    continue;
                }

                $related = [];

                foreach ($propertyValue as $value) {
                    $class = $this->getClassByProperty($dto, $property);

                    $this->handleData($class, $value);

                    $related[] = $class;
                }

                $dto->{$property} = $related;

                continue;
            }

            if ($propertyExists && $propertyIsObject) {
                $dto->{$property} = $this->getClassByProperty($dto, $property);

                $this->handleData($dto->{$property}, (array) $propertyValue);

                continue;
            }
        }
    }

    private function getClassByProperty(ResourceDtoInterface $dto, string $property): stdClass
    {
        $reflection = new \ReflectionProperty($dto, $property);
        $comment = str_replace(['\\', '@var'], ['_', ''], $reflection->getDocComment());
        $comment = preg_replace("/[^0-9a-zA-Z_]/", '', $comment);
        $comment = str_replace('_', '\\', $comment);

        if (class_exists($comment)) {
            return new $comment;
        }

        return new stdClass();
    }

    abstract protected function getResourceType(): string;
}
