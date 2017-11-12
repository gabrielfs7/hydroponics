<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

interface ResourceDtoInterface
{

    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getType();

    /**
     * @var \GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDtoInterface
     */
    public function getAttributes();

    /**
     * @param string $name
     * @return mixed
     */
    public function getAttributeValue($name);

    /**
     * @var \GSoares\Hydroponics\Application\Dto\Resource\ResourceRelationshipDtoInterface[]
     */
    public function getRelationships();

    /**
     * @var LinksDto
     */
    public function getLinks();

    /**
     * @var array
     */
    public function getMeta();
}