<?php

namespace GSoares\Hydroponics\Application\Decoder;

use GSoares\Hydroponics\Application\Dto\Greenhouse\GreenhouseDto;

abstract class AbstractDtoDecoder implements DecoderInterface
{

    abstract protected function getDtoInstance();

    /**
     * @param string $json
     * @return GreenhouseDto
     */
    public function decode($json)
    {
        $stdClass = json_decode($json);
        $dto = $this->getDtoInstance();

        $this->handleData($dto, $stdClass->data);

        return $dto;
    }

    private function handleData(&$dto, $data)
    {
        foreach ($data as $property => $propertyValue) {
            $propertyExists = is_object($dto) && property_exists($dto, $property);
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

                $this->handleData($dto->{$property}, $propertyValue);

                continue;
            }
        }
    }

    /**
     * @param $dto
     * @param $property
     */
    private function getClassByProperty($dto, $property)
    {
        $reflection = new \ReflectionProperty($dto, $property);
        $comment = str_replace(['\\', '@var'], ['_', ''], $reflection->getDocComment());
        $comment = preg_replace("/[^0-9a-zA-Z_]/", '', $comment);
        $comment = str_replace('_', '\\', $comment);

        if (class_exists($comment)) {
            return new $comment;
        }
    }
}